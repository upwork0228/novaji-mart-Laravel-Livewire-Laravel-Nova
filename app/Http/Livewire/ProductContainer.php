<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ProductContainer extends Component
{
    public bool $createForm;
    public bool $editForm;
    public bool $productList;

    protected $listeners = [
        'showProductList'
    ];

    public function showCreateForm (): void {
        $this->createForm   = true;
        $this->editForm     = false;
        $this->productList  = false;
    }

    public function showEditForm (): void {
        $this->editForm     = true;
        $this->createForm   = false;
        $this->productList  = false;
    }

    public function showProductList (): void {
        $this->productList  = true;
        $this->editForm     = false;
        $this->createForm   = false;
    }

    public function mount(): void {
        $this->showProductList();
    }

    public function render()
    {
        return view('livewire.product-container');
    }
}
