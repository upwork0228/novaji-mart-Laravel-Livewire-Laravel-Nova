<div class="row">

    @if($products)
        @foreach($products as $product)
            <div class="col-md-4 mb-2">
                <div class="product-card">
                    <img src="{{$product->Picture}}" alt="Product 1" class="img-fluid">
                    <h4>{{$product->name}}</h4>
                    <p class="text-muted">{{$product->description}}</p>
                    <h5 class="text-center text-primary">${{$product->price}}</h5>
                    <a href="#" class="btn primary-butt" style="">Edit</a>
                    <a href="#" wire:click="deleteProduct({{$product->id}})"  class="btn btn-danger">Delete</a>
                </div>
            </div>
        @endforeach
            {{ $products->links('components.general.pagination-links') /* For pagination links */}}
    @endif

</div>
