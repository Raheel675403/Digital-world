@extends('layouts.app_layout')
@section('background-color', 'linear-gradient(135deg, #1d2b64, #f8cdda)')
@section('content')
{{--    <video autoplay muted loop id="myVideo">--}}
{{--        <source src="{{asset('background-video/river.mp4')}}" type="video/mp4">--}}
{{--    </video>--}}
    <main class="app-main">
        <!-- Content Header -->
        <div class="app-content-header dashboard-header bg-dark">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="text-white fw-bold mb-1" style="font-size: 2rem; letter-spacing: 1px;">Welcome to Your Dashboard</h3>
                        <p class="text-white" style="font-size: 1.1rem;">Here's a summary of your recent activity and quick links to important sections.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <ol class="breadcrumb text-white float-end mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item text-white active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="app-content py-3">
            <div class="container-fluid">
                <div class="row g-4">
                    <!-- Card 1 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card1 shadow-lg text-white" style="border-radius: 15px; height: 250px; background: linear-gradient(135deg, #1d2b64, #f8cdda); background-size: cover; background-blend-mode: overlay;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="fw-bold mb-1">Account Balance</h5>
                                        <span class="badge bg-light text-dark fw-bold px-3 py-1">Updated</span>
                                    </div>
                                    <h1 class="fw-bolder my-2" style="font-size: 2.5rem;">{{ $data['user']->has_coins }} <small style="font-size: 1.2rem;">Coins</small></h1>
                                    <p class="text-light mb-0" style="opacity: 0.9;">You can use your coins to promote your content, unlock features, and more.</p>
                                </div>
                                <div class="text-end">
                                    <i class="bi bi-wallet2" style="font-size: 2.5rem; opacity: 0.9;"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Card 2: Purchase Coins -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card1 shadow-lg text-white" style="border-radius: 15px; height: 250px; background: linear-gradient(135deg, #020024, #090979 , #0486CC , #02B3EA , #020024);">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold">Purchase Coins</h5>
                                    <p>Purchase new coins to your account and increase visibility!</p>
                                </div>
                                <a href="{{route('purchase-coins')}}" class="btn btn-light btn-sm rounded-pill text-dark fw-bold">
                                    Go to Purchases <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Apply Coins -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card1 shadow-lg text-white" style="border-radius: 15px; height: 250px; background: linear-gradient(135deg, #00c6ff, #0072ff);">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold">Apply Coins</h5>
                                    <p>Click below to apply coins to your video and boost engagement.</p>
                                </div>
                                <a href="{{ route('apply-video') }}" class="btn btn-light btn-sm rounded-pill text-primary fw-bold">
                                    Apply Now <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Chat with Us -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card1 shadow-lg text-white" style="border-radius: 15px; height: 250px; background: linear-gradient(135deg, #fc5c7d, #6a82fb);">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold">Chat with Us</h5>
                                    <p>Need help? Start a chat with our support team now!</p>
                                </div>
                                <a href="#" class="btn btn-light btn-sm rounded-pill text-dark fw-bold">
                                    Start Chat <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5: Notifications -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card1 shadow-lg text-white" style="border-radius: 15px; height: 250px; background: linear-gradient(red, yellow);">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold">Notifications</h5>
                                    <p>You have <strong>5</strong> unread notifications.</p>
                                </div>
                                <a href="#" class="btn btn-light btn-sm rounded-pill text-dark fw-bold">
                                    View Notifications <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Profile -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card card1 shadow-lg text-white text-center" style="border-radius: 15px; height: 250px; background:linear-gradient(white, black);">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <img src="https://i.pravatar.cc/100?img=3" class="rounded-circle mx-auto mb-2"
                                     alt="Profile" style="width: 100px; height: 100px; border: 3px solid #fff;">
                                <div>
                                    <h5 class="fw-bold mb-1">John Doe</h5>
                                    <p class="mb-1">Software Developer</p>
                                    <small class="text-light">Joined: January 2022</small>
                                </div>
                                <a href="#" class="btn btn-light btn-sm mt-2 rounded-pill text-dark fw-bold">
                                    View Profile <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div> <!-- /row -->
            </div> <!-- /container-fluid -->
        </div> <!-- /app-content -->
    </main>
@endsection
