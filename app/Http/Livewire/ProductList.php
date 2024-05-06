<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Traits\FileManager;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{

    use WithPagination, FileManager;

    protected $listeners = [
        'showProductList'   => '$refresh'
    ];

    public function mount(){
        $this->getProducts();
    }

    public function getProducts(){
        return Product::orderBy('created_at', 'DESC');
    }

    public function deleteProduct($id): \Livewire\Event
    {
        $product = Product::findOrFail($id);

        // delete product image
        $this->deleteProductImage($product->image);

        $product->delete();


        // Refresh the productList
        $this->emit('showProductList');

        //Notify User
        return $this->emit('alert', ['type' => 'success', 'message' => 'Product deleted']);

    }

    public function render()
    {
        return view('livewire.product-list', [
            'products'  => $this->getProducts()->paginate(6)
        ]);
    }
}
