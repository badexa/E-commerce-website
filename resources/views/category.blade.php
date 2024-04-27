@extends('layouts.app')

@section('title', 'Category')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@section('contents')
    <hr />
    <div class="main-panel">
        <div class="content-wrapper">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="div_center">
                <h2>ADD CATEGORY</h2>
                <form action="{{ url('/add_category') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="text" name="category" placeholder="Write the category" class="border-2 border-gray-300 p-2 rounded-md">
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br />
    <br />
    <table class="border-collapse border border-gray-400 mx-auto">
        <tr class="border-b border-gray-400">
            <th class="p-2">Category Name</th>
            <th class="p-2"></th>
        </tr>
        @foreach ($data as $category)
            <tr class="border-b border-gray-400">
                <td class="p-2">{{ $category->category_name }}</td>
                <td class="p-2">
                    <a href="{{ url('delete_catagory', $category->id) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
