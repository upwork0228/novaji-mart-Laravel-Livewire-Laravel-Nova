<?php


namespace App\Traits;


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait FileManager
{
    public function deleteProductImage($filename){
        File::delete(public_path('uploads/'.$filename));
    }

    public function saveProductImage($image, $disk){
        // Process the image
        $img = Image::make($image)->resize(350, 250)->encode('png');
        $name = Str::random(50).'_'.$image->getClientOriginalName();;
        Storage::disk($disk)->put($name, $img);
        return $name;
    }

}
