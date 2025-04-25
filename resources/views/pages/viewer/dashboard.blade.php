@extends('layouts.app_layout')
@section('background-color', 'linear-gradient(135deg, #1d2b64, #f8cdda)') {{-- change per page  color/img--}}
@section('content')
    <!-- Content Area -->
    <main class="flex-1 p-6">
        <!-- Example Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-indigo-100 p-4 rounded shadow text-center">
                <p class="text-lg font-semibold">Total Orders</p>
                <p class="text-2xl text-indigo-700">25</p>
            </div>
            <div class="bg-purple-100 p-4 rounded shadow text-center">
                <p class="text-lg font-semibold">Messages</p>
                <p class="text-2xl text-purple-700">10</p>
            </div>
            <div class="bg-green-100 p-4 rounded shadow text-center">
                <p class="text-lg font-semibold">Status</p>
                <p class="text-2xl text-green-700">Active</p>
            </div>
        </div>
    </main>
@endsection
