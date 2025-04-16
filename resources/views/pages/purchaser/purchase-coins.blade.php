@extends('layouts.app_layout')
@section('content')
    <!-- Card: Purchase View -->
    <div class="col-lg-6 offset-sm-3 mt-5 col-sm-6">
        <div class="card shadow-lg text-white bg-dark" style="border-radius: 15px;">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h5 class="mb-4 fw-bold">Purchase Coins</h5>
                    <h6 class="fw-bold">Hello Raheel</h6>
                    <p>Need more coins? Simply enter the amount you wish to purchase and proceed to get started!</p>
                </div>
                <lable for="amount" class="form-label"> Amount</lable>
                <input type="number" class="form form-control rounded-pill text-dark fw-bold" id="amount" name="amount">
                <a href="#" class="btn btn-light btn-sm rounded-pill text-dark mt-3 fw-bold">Go to Purchases <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>

@endsection
