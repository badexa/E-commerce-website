@extends('layouts.app')

@section('title', 'update')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@section('contents')
<div class="main-panel">
    <div class="content-wrapper">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="div_center p-6 bg-white shadow-md rounded-lg">
            <h1 class="text-2xl font-bold mb-4">Update Page</h1>

            <form action="{{ route('update_product', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Product Title</label>
                    <input type="text" name="title" value="{{ $product->title }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Product Description</label>
                    <input type="text" name="description" placeholder="Write a description" value="{{ $product->description }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Current Image</label>
                    <img src="/product/{{ $product->image }}" class="h-20 w-20">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Change Image</label>
                    <input type="file" name="image" placeholder="Image" class="mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="{{ $product->category }}" selected>Choose Category</option>
                        @foreach($catagory as $cat)
                        <option>{{ $cat->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Product Price</label>
                    <input type="number" name="price" placeholder="The price" value="{{ $product->price }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Product Quantity</label>
                    <input type="number" name="quantity" placeholder="The quantity" value="{{ $product->quantity }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Discount Price</label>
                    <input type="number" name="dis_price" placeholder="The discount" value="{{ $product->discount_price }}" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <input type="submit" value="UPDATE" class="w-full mt-2 bg-blue-500 text-white px-3 py-2 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
