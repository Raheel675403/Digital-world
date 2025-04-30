@extends('layouts.app_layout')
@section('background', 'https://cdn.nimbusthemes.com/2017/09/09233338/Free-Nature-Backgrounds-Sunset-by-Pixabay.jpg') {{-- change per page --}}
@section('content')
    <main class="app-main">
        <!-- Card: Purchase View -->
        <div class="col-lg-6 offset-sm-3 mt-5 col-sm-6">
        <div class="card card1 shadow-lg text-white bg-dark" style="border-radius: 15px;">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h5 class="mb-4 fw-bold">Purchase Coins</h5>
                    <h6 class="fw-bold">Hello Raheel</h6>
                    <p>Need more coins? Simply enter the amount you wish to purchase and proceed to get started!</p>
                </div>
                <form action="{{ route('save-purchase-coins') }}" method="POST">
                    @csrf
                    <lable for="amount" class="form-label"> Amount</lable>
                    <input type="number" name="amount"  id="amount" class="form form-control rounded-pill mt-3 text-dark fw-bold">
                    <button type="submit" class="btn btn-outline-info btn-md rounded-pill w-100 text-white mt-3 fw-bold">Go to Purchases <i class="bi bi-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>
    </main>

@endsection
