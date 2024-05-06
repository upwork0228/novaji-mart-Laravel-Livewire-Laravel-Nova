<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Traits\FileManager;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddProductForm extends Component
{
    use WithFileUploads, FileManager;

    public string $name;
    public $photo;
    public string $price;
    public string $description;

    protected array $rules = [
        'name'          =>  'required|string|max:255',
        'photo'         =>  'required|image|max:3000',
        'description'   =>  'required|string|max:500',
        'price'         => 'required|numeric|gt:0'
    ];

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($field){
        $this->validateOnly($field, $this->rules);
    }

    public function add(): \Livewire\Event
    {
        $this->validate($this->rules);

        // save the image
        $product_image_name = $this->saveProductImage($this->photo, 'products');

        //Create the product
        Product::create([
           'name'           =>  $this->name,
           'image'          => $product_image_name,
           'description'    => $this->description,
           'price'          => $this->price
        ]);

        // Refresh the productList
        $this->emit('showProductList');

        //Notify User
        return $this->emit('alert', ['type' => 'success', 'message' => 'Product Added']);
    }

    public function render()
    {
        return view('livewire.add-product-form');
    }
}
