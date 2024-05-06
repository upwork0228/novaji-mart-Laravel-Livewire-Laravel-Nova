<div class="row">
    <div class="text-center mb-2">
        <h1 class="mb-1">Edit Item</h1>
        <p>Update Item Information.</p>

        <div class="col-md-6" style="margin: auto;">
            <form class="row gy-1 pt-75" wire:submit.prevent="update">
                <div class="col-12 col-md-6">
                    <label class="form-label" for="basic-icon-default-fullname">Name*</label>
                    <input type="text" wire:model.lazy="name" class="form-control dt-full-name  {{$errors->has('name')? 'is-invalid' : '' }}"  placeholder="Item name"/>
                    @error('name') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label" for="basic-icon-default-email">Price*</label>
                    <input type="text" wire:model.lazy="price"  class="form-control dt-email  {{$errors->has('price')? 'is-invalid' : '' }}" placeholder="Price">
                    @error('price') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <label class="form-label" for="basic-icon-default-company">Description*</label>
                    <textarea class="form-control" placeholder="description" wire:model.lazy="description"></textarea>
                    @error('description') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                </div>
                <div class="col-12">
                    <div class="form-group" wire:ignore>
                        <label>Image <sup>max 3MB</sup></label><br>
                        <small wire:loading wire:target="photo" class="form-text text-muted"><i class="fa fa-spin"><i class="fa fa-spinner"></i></i>&nbsp;&nbsp; Loading preview...</small>
                        <input  class="form-control {{$errors->has('photo')? 'is-invalid' : '' }}" type="file" wire:model="photo" >
                        @error('photo') <span style="color: crimson; font-size: 10px;">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if($photo)
                    <div class="col-12 text-center mt-2 pt-50">
                        <a target="_blank" href="{{ $photo->temporaryUrl() }}" >
                            <img src="{{ $photo->temporaryUrl() }}" style="margin-bottom: 5px; border: 1px solid white; max-width: 30%">
                        </a>
                    </div>
                @endif

                <div class="col-12 text-center mt-2 pt-50"  wire:loading.remove wire:target="images">
                    <button type="submit"  wire:loading.remove wire:target="update"  class="btn btn-primary me-1">Add item</button>
                    <button type="submit"  wire:loading wire:target="update"  class="btn btn-primary me-1"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span></button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                        Cancel
                    </button>
                </div>



            </form>
        </div>
    </div>


</div>
