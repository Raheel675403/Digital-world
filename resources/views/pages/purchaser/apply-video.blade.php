@extends('layouts.app_layout')
@section('content')
    <div class="container mt-5">
        <div class="card bg-dark text-white shadow-lg rounded-4">
            <div class="card-body p-4">
                    {{--header--}}
                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-12 d-flex items-baseline justify-content-between">
                        <h4 class="fw-bold">Apply Coins</h4>
                        <button class="btn btn-md btn-outline-info"> Purchase View</button>
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
                    {{-- fetch vedio with ajax--}}
                <div id="video-preview" class="row mt-5" style="display: none;">
                    <!-- Video Iframe -->
                    <div class="col-md-4">
                        <div class="ratio mt-4 ratio-16x9 rounded shadow">
                            <iframe id="video-frame" height="100px" src="" allowfullscreen></iframe>
                        </div>
                    </div>

                    <!-- Video Info in Readonly Inputs -->
                    <div class="col-md-4 mb-3">
                        <div class="mb-3">
                            <label class="form-label text-light fw-bold">Channel Name</label>
                            <input type="text" readonly class="form-control bg-secondary text-white border-0" id="channel">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-light fw-bold">Views</label>
                                <input type="text" readonly class="form-control bg-secondary text-white border-0" id="viewer">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label text-light fw-bold"> Likes</label>
                                <input type="text" readonly class="form-control bg-secondary text-white border-0" id="like">
                            </div>
                        </div>
                        <div>
                            <label class="form-label text-light fw-bold">Video Title</label>
                            <textarea type="text" readonly class="form-control bg-secondary text-white border-0" id="title"></textarea>
                        </div>

                    </div>

                    <!-- View Request Form -->
                    <div class="col-md-4">
                        <p class="fw-bold text-white">How many views do you want on this video?</p>
                        <form>
                            <input type="number" class="form-control mb-2" id="num-view" name="views" placeholder="e.g. 5000">
                            <button type="button" id="apply-confirm" class="btn btn-outline-info w-100 mt-3" data-dismiss="modal" aria-label="Close">Apply</button>
                        </form>
                    </div>
                </div>
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
                    <button type="button" class="btn btn-outline-success rounded-pill w-100">
                        Yes &amp; Apply
                    </button>
                    <button type="button" id="cancelconfirmviewmodel" class="btn btn-outline-light rounded-pill w-100 mb-2" data-dismiss="modal">
                        Cancel
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const requestVideoURL = "{{ route('request-video') }}";
    </script>
    <script src="{{ asset('js/purchase.js') }}"></script>
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#request-video-form').on('submit', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                $.ajax({--}}
{{--                    url: "{{ route('request-video') }}",--}}
{{--                    type: 'POST',--}}
{{--                    data: {--}}
{{--                        url: $('#url').val(),--}}
{{--                        _token: "{{ csrf_token() }}"--}}
{{--                    },--}}
{{--                    success: function (response) {--}}
{{--                        if (response.status === 'success') {--}}
{{--                            $('#video-preview').show();--}}
{{--                            $('#video-frame').attr('src' , response.embed_url);--}}
{{--                            $('#title').val((response.title || 'Unknown Title'));--}}
{{--                            $('#channel').val((response.channel || 'Unknown Channel'));--}}
{{--                            $('#like').val((response.like || 'N/A'));--}}
{{--                            $('#viewer').val((response.views || 'N/A'));--}}
{{--                            $('#modal-title-preview').text(" "+(response.title || 'Unknown Title'))--}}
{{--                            $('#modal-channel-preview').text(" " +(response.channel || 'Unknown Channel'));--}}
{{--                        }--}}
{{--                    },--}}
{{--                    error: function (xhr, status, error) {--}}
{{--                        console.log("XHR Status:", status);--}}
{{--                        console.log("AJAX Error:", error);--}}
{{--                        console.log("Server Response:", xhr.responseText); // 👈 Yeh zaroori hai--}}
{{--                        alert("Something went wrong. Check console for details.");--}}
{{--                    }--}}

{{--                });--}}
{{--            });--}}
{{--            $('#apply-confirm').click(function(e){--}}
{{--                e.preventDefault();--}}

{{--                let views = $('#num-view').val().trim();--}}

{{--                if (views === '' || views === null || views === '0') {--}}
{{--                    alert('Please enter a valid number of views.');--}}
{{--                    return; // Don’t open modal--}}
{{--                }--}}

{{--                // If input is valid, open modal--}}
{{--                $('#modal-views-preview').text(views); // Update value inside modal--}}
{{--                $('#applyModal').modal('show');--}}

{{--            });--}}
{{--            $('body').on('click', '#closeconfirmviewmodel, #cancelconfirmviewmodel', function () {--}}
{{--                $('#applyModal').modal('hide');--}}
{{--            });--}}

{{--        });--}}

{{--    </script>--}}

@endsection
