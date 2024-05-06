@extends('layouts.app')


@section('content')
    <div class="container">
        <h2 class="text-center mt-2 mb-2">Products</h2>

        @livewire("product-container")

    </div>

@endsection
