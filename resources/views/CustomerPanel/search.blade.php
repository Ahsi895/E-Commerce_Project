
@extends('products.layout')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
          
            }
    </style>
</head>

<body class="antialiased position-relative" style="background-color: aqua">
    @include('header')
    <br>
    <div class="custom-product">
        <div class="col-sm-4">
            <a href="#">Filter</a>
        </div>
        <div class="col-sm-4">
            <div class="d-flex justify-content-center flex-lg-wrap gap-4">
                @foreach($data as $index => $item)
                <div class="searched-item" style="width: 18rem;">
                    <h3>Search result:</h3><br>
                    <a href="detail/{{$item['id']}}">
                    <img style = "width:200px; height: 150px;" src="{{ asset($item->image) }}" class="card-img-top" alt="No image">
                    <div class="card-body">
                      <h2 class="card-title">{{ $item->pro_name }}</h2>
                        <h5> {{ $item->details }} </h5>
                    </div>
                </div>
                </a>
                @endforeach
            </div>
        </div>
        

    </div>
</body>
</html>
