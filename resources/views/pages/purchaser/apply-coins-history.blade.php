@extends('layouts.app_layout')
@section('background', 'https://cdn.nimbusthemes.com/2017/09/09233341/Free-Nature-Backgrounds-Seaport-During-Daytime-by-Pexels.jpeg') {{-- change per page --}}
@section('content')
    <main class="app-main">
        <div class="container mt-5">
        <div class="card card1 bg-dark text-white shadow-lg rounded-4">
            <div class="card-body p-4">
                {{--header--}}
                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-12 d-flex items-baseline justify-content-between">
                            <h4 class="fw-bold">History</h4>
                            <a href="{{ route('dashboard') }}" class="btn btn-md btn-outline-info"> Dashboard</a>
                        </div>
                    </div>
                    <h6 class="fw-bold mt-3">Hello {{ $user->name }}</h6>
                    <p>Here is your history of the videos on which you used your coins.</p>
                </div>
                {{-- search url--}}
                <table class="table table-bordered text-center table-dark">
                    <thead>
                    <tr>
                        <th scope="col" class="align-middle">#</th>
                        <th scope="col" class="align-middle">Video</th>
                        <th scope="col" class="align-middle">Chanel Name</th>
                        <th scope="col" class="align-middle">Apply Coins</th>
                        <th scope="col" class="align-middle">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->videoDetail as $records)
                        @php
                            $parts = explode('/', $records->url);
                            $videoId = end($parts);
                        @endphp
                        <tr>
                            <th scope="row" class="align-middle">{{ $records->id }}</th>
                            <td class="align-middle">
                                <img src="https://img.youtube.com/vi/{{ $videoId }}/0.jpg" alt="Video Poster" width="160">
                            </td>
                            <td class="align-middle">{{ $records->channel_name }}</td>
                            <td class="align-middle">{{ $records->apply_views }}</td>
                            <td class="align-middle">{{ $records->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    </main>
@endsection
