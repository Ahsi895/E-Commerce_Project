@extends('products.layout')

@section('content')
<div class="container">
    <div class="text-left">
        <a href="/admin" class="btn btn-primary">Back</a><br><br>
    </div>
    <h1 class="text-center my-4">Admin Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card" style="padding: 20px 20px;">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    
                    <p class="card-text">213</p>
                    <a href="#" class="btn btn-primary">View Orders</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="padding: 20px 20px;">
                <div class="card-body">
                    <h5 class="card-title">Total Revenue</h5>
                    <p class="card-text">$10,000</p>
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
                    <h5 class="card-title">Orders</h5>
                    <p class="card-text">Product A, Product B, Product C</p>
                    <a href="#" class="btn btn-primary">View Products</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
