<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

trait ApiResponse
{
    protected function successResponse($data, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json($data, $code);
    }

    protected function errorResponse($message, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json($message, $code);
    }

//    protected function showAll(Collection $collection, $code = 200){
//        return $this->successResponse([
//            'errorCode' => 'SUCCESS',
//            'results'   => count($collection),
//            'data'      => $collection
//        ], $code);
//    }

    protected function showOne(Model $model, $code = 200){
        return $this->successResponse([
            'errorCode' => 'SUCCESS',
            'data' => $model
        ], $code);
    }

    protected function showMessage($message, $code = 200){
        return $this->successResponse([
            'errorCode' => 'SUCCESS',
            'data' => $message
        ], $code);
    }


    protected function showAll(Collection $collection, $code = 200){
        // Perform a fractal transformation on the collection if not empty
        if ($collection->isEmpty()){
            return $this->successResponse([
                'errorCode' => 'SUCCESS',
                'results'   => count($collection),
                'data' => $collection
            ], $code);
        }

        // The sort must be done before transform data method
        $collection = $this->filterData($collection);
        $collection = $this->sortData($collection);
        $collection = $this->paginate($collection);
//        $collection = $this->transformData($collection, $transformer); //Note: transformData returns an array, not a collection
        $collection = $this->cacheResponse($collection);

        return $this->successResponse([
            'errorCode' => 'SUCCESS',
            'results'   => count($collection['data']),
            'data' => $collection
        ], $code);
    }


    protected function paginate(Collection $collection){
        // Attach pagination validation rules
        $rules = [
            'per_page'  =>  'integer|min:2|max:50'
        ];
        Validator::validate(request()->all(), $rules);


        $page  = LengthAwarePaginator::resolveCurrentPage(); // fetch the current page
        $perPage = 15; // Results expected per page
        if (request()->has('per_page')){
            $perPage = (int) request()->per_page;
        }

        $results = $collection->slice(($page - 1) * $perPage, $perPage)->values(); // Divide the results

        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path'  => LengthAwarePaginator::resolveCurrentPath()
        ]); // returns links to other pages of the collection

        $paginated->appends(request()->all()); // Attach or other request parameters to the links

        return $paginated; // return the paginated data
    }

    protected function filterData(Collection $collection){
        foreach (request()->query() as $query => $value){
            if (isset($query, $value)){
                if ($query != 'sort_by' && $query != 'per_page' && $query != 'page' ){
                    $collection = $collection->where($query, $value);
                }
            }
        }

        return $collection;
    }

    protected function sortData(Collection $collection){
        if (request()->has('sort_by')){
            $attribute  = request()->sort_by;
            $collection = $collection->sortBy->{$attribute};
        }

        return $collection;
    }

    protected function cacheResponse($data){
        $data = $data->toArray();
        $url = request()->url();
        $queryParams = request()->query(); //For returning query params

        // The sort the params
        ksort($queryParams);

        $queryString = http_build_query($queryParams);
        $fillUrl = "{$url}?{$queryString}";

        return Cache::remember($fillUrl, 30/60, function () use($data){
            return $data;
        });
    }

}
