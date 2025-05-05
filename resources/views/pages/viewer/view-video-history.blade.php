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
                        <h6 class="fw-bold mt-3">Hello {{ auth()->user()->name }}</h6>
                        <p>Here is your history of the videos on which you seen.</p>
                    </div>
                    {{-- search url--}}
                    <table class="table table-bordered text-center table-dark">
                        <thead>
                        <tr>
                            <th scope="col" class="align-middle">#</th>
                            <th scope="col" class="align-middle">Video</th>
                            <th scope="col" class="align-middle">Balance</th>
                            <th scope="col" class="align-middle">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($video as $records)
                            @php
                                function extractYouTubeId($url) {
                                    $parts = parse_url($url);
                                    if (isset($parts['query'])) {
                                        parse_str($parts['query'], $query);
                                        if (isset($query['v'])) {
                                            return $query['v'];
                                        }
                                    }
                                    if (isset($parts['path'])) {
                                        $pathSegments = explode('/', trim($parts['path'], '/'));
                                        return end($pathSegments);
                                    }
                                    return null;
                                }

                                $videoId = extractYouTubeId($records->video_url);
                            @endphp
                            <tr>
                                <th scope="row" class="align-middle">{{ $records->id }}</th>
                                <td class="align-middle text-center">
                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/0.jpg" alt="Video Poster" width="160" class="img-fluid mx-auto d-block">
                                </td>
                                <td class="align-middle">{{ $records->balance }}</td>
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
