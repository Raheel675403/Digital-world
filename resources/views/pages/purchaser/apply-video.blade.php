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
                            <h4 class="fw-bold">Apply Coins</h4>
                            <a href="{{ route('purchase-coins') }}" class="btn btn-md btn-outline-info"> Purchase coins</a>
                            </div>
                        </div>
                        <h6 class="fw-bold mt-3">Hello Raheel</h6>
                        <p>Please enter your YouTube video link to fetch details:</p>
                    </div>
                        {{-- search url--}}
                    <form id="request-video-form">
                        <div class="input-group">
                            <input
                                type="url"
                                class="form-control"
                                name="url"
                                id="url"
                                placeholder="https://www.youtube.com/watch?v=..."
                                pattern="https://.*" required/>

                            <button type="submit" class="btn btn-outline-info btn-md text-white fw-bold" >
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                    <form action="{{route('save-request-video')}}" id="saveVideoDetailForm" method="POST">
                        @csrf
                        {{-- fetch vedio with ajax--}}
                        <div id="video-preview" class="row mt-5" style="display: none;">
                            <!-- Video Iframe -->
                            <input type="hidden" id="video_src" name="video_url">
                            <div class="col-md-4">
                                <div class="ratio mt-4 ratio-16x9 rounded shadow">
                                    <iframe id="video-frame" height="100px" src="" allowfullscreen></iframe>
                                </div>
                            </div>
                                <!-- Video Info in Readonly Inputs -->
                                <div class="col-md-4 mb-3">
                                    <div class="mb-3">
                                        <label class="form-label text-light fw-bold">Channel Name</label>
                                        <input type="text" readonly name="channel_name" class="form-control bg-secondary text-white border-0" id="channel">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-light fw-bold">Views</label>
                                            <input type="text" readonly name="previous_views" class="form-control bg-secondary text-white border-0" id="viewer">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-light fw-bold"> Likes</label>
                                            <input type="text" readonly name="likes" class="form-control bg-secondary text-white border-0" id="like">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label text-light fw-bold">Video Title</label>
                                        <textarea type="text" readonly name="title" class="form-control bg-secondary text-white border-0" id="title"></textarea>
                                    </div>

                                </div>
                                <!-- View Request Form -->
                                <div class="col-md-4">
                                    <p class="fw-bold text-white">How many views do you want on this video?</p>
                                    <input type="number" class="form-control mb-2" id="num-view" name="apply_views" placeholder="e.g. 5000">
                                    <button type="button" id="apply-confirm" class="btn btn-outline-info w-100 mt-3" data-dismiss="modal" aria-label="Close">Apply</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal conformation -->
        <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content bg-dark text-white rounded-4 shadow-lg border-0">

                <!-- Modal Header -->
                <div class="modal-header border-secondary sticky-top bg-dark d-flex justify-content-between align-items-center">
                    <h5 class="modal-title fw-bold m-0" id="applyModalLabel">Confirm View Request</h5>
                    <button type="button" class="close-modal-btn" id="closeconfirmviewmodel" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" style="max-height: 60vh; overflow-y: auto;">
                    <p class="mb-4">Are you sure you want to apply for views on this video?</p>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><strong>Title :</strong> <span id="modal-title-preview">...</span></li>
                        <li class="mb-2"><strong>Channel :</strong> <span id="modal-channel-preview">...</span></li>
                        <li><strong>Requested Views :</strong> <span id="modal-views-preview">...</span></li>
                    </ul>
                    <div class="mt-4">
                        <p>Are you sure You want to apply views on this video</p>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-secondary sticky-bottom bg-dark flex-column">
                    <button type="button" id="saveVideoDetail" class="btn btn-outline-success rounded-pill w-100">
                        Yes &amp; Apply
                    </button>
                    <button type="button" id="cancelconfirmviewmodel" class="btn btn-outline-light rounded-pill w-100 mb-2" data-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </div>
        </div>
    </div>
    </main>
@endsection
@section('script')
    <script src="{{ asset('js/purchase.js') }}"></script>
    <script>
        const requestVideoURL = "{{ route('request-video') }}";
    </script>
@endsection
