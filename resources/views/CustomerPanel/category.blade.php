@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->name }}</h1>

    <h2>Products in this category:</h2>
    <ul>
        {{-- @php
            print_r($products);
            die;
        @endphp --}}
        <div class="text-left">
            <a href="/" class="btn btn-primary">Back</a><br><br>
        </div>
        <div style="display: flex">
        @foreach($products as $index => $item)
        <div class="card" style="width: 18rem; padding: 25px 25px"><br>
            <img style = "width:200px; height: 150px;" src=" {{ asset($item->image) }}" class="card-img-top" alt="No image">
            <div class="card-body">
              <h5 class="card-title">{{ $item->pro_name }}</h5>
              <p>Price: ${{ $item->price }}</p>
              <a href="{{ route('CustomerPanel.viewProduct', ['id' => $item->pro_id]) }}" class="btn btn-primary" >View more</a>
            </div>
        </div>
        @endforeach
    </div>
    </ul>
</div>
@endsection
