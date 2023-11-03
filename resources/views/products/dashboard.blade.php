@extends('products.layout')

@section('content')
<div class="container">
    <div class="text-left"><br>
        <a href="/admin" class="btn btn-primary">Back</a><br><br>
    </div>
    <h1 class="text-center my-4">Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card" style="padding: 20px 20px;">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text">{{ $totalOrders ?? 'No values' }}</p>
                    <a href="{{ route('viewOrders') }}" class="btn btn-primary">View Orders</a>
                </div>
            </div>            
        </div>
        <div class="col-md-4">
            <div class="card" style="padding: 20px 20px;">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">$ {{ $totalRevenue ?? 'No values' }}</p>
                    <a href="#" class="btn btn-primary">View Revenue</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="padding: 20px 20px;">
                <div class="card-body">
                    <h5 class="card-title">Best Selling Products</h5>
                    <p class="card-text">Product A, Product B, Product C</p>
                    <a href="#" class="btn btn-primary">View Products</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card" style="padding: 20px 20px;">
                <div class="card-body">
                    <h5 class="card-title">All Products</h5>
                    <p class="card-text">See All Products</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">View Products</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="padding: 20px 20px;">
                <div class="card-body">
                    <h5 class="card-title">Abandoned Cart Products</h5>
                    <p class="card-text"> {{ $totalAbandonedCart ?? 'No value '}} </p>
                    <a href="{{ route('showabandonedCart') }}" class="btn btn-primary">View Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
