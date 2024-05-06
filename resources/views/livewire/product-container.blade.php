<div>
    @if($productList)
        <button type="button" class="btn btn-primary mb-2" wire:click="showCreateForm">
            <span wire:loading wire:target="showCreateForm" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span wire:loading.remove wire:target="showCreateForm"> Add new item</span>
        </button>

        @livewire("product-list")
    @endif

    @if($createForm || $editForm)
       <button type="button" class="btn btn-primary mb-2" wire:click="showProductList">
           <span wire:loading wire:target="showProductList" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
           <span wire:loading.remove wire:target="showProductList">Products</span>
       </button>

      @if($createForm)
            @livewire("add-product-form")
      @endif

      @if($editForm)
           @livewire("edit-product-form")
      @endif
    @endif





</div>
