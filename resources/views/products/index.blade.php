@extends('products.layout')

@section('content')
<div class="row"> <div class="col-lg-12 margin-tb mt-5"><br> <div class="pull-left">
    <h2>Products</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
        </div>
    </div>
    </div> @if ($message=Session::get('success')) <div class="alert alert-success"> <p>{{ $message }}</p> </div>
    @endif
    <br>
    <table class="table table-bordered" id="table">
        <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Details</th>
        <th>Category</th>
        <th width="280px">Action</th>
        <th>Created at</th>
        <th>Updated at</th>
        </tr>


        @foreach ($products as $product)
        <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $product->pro_name }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->details }}</td>

        <td>
            @php
                $category = \App\Models\Category::all();
            @endphp
                
                {{ $product->category->name }} 
                
        </td>
            <td>

            <form action="{{ route('products.destroy', ['product' => $product->pro_id]) }}" method="POST">
            <a class="btn btn-info" href="{{ route('products.show', ['product' => $product->pro_id]) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('products.edit', ['product' => $product->pro_id]) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            </form>

        </td>
        <td>{{$product->created_at}}</td>
        <td>{{$product->updated_at}}</td>
        </tr>
        @endforeach
    </table>

    
    

    
    
    @endsection