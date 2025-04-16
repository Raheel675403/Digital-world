@extends('layouts.app_layout')

@section('content')
    <main class="app-main">
        <!-- Content Header -->
        <div class="app-content-header bg-dark">
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
                        <div class="card shadow-lg text-white bg-primary" style="border-radius: 15px; height: 250px; background-image: url('path/to/your/views-image.jpg'); background-size: cover;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold">Recent Activity Insights</h5>
                                    <p>Your profile has <strong>150 views</strong> this month. Keep up the momentum!</p>
                                </div>
                                <a href="#" class="btn btn-light btn-sm rounded-pill text-primary fw-bold">Explore Insights <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <!-- Card: Purchase View -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-lg text-white bg-dark" style="border-radius: 15px; height: 250px; background-image: url('path/to/your/purchase-image.jpg'); background-size: cover;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold">Purchase Coins</h5>
                                    <p>Purchase a new coins to your account and increase visibility!</p>
                                </div>
                                <a href="{{route('purchase-coins')}}" class="btn btn-light btn-sm rounded-pill text-dark fw-bold">Go to Purchases <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>


                    <!-- Card 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-lg text-white bg-success" style="border-radius: 15px; height: 250px; background-image: url('path/to/your/apply-view-image.jpg'); background-size: cover;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold">Apply Views</h5>
                                    <p>Click below to apply views and boost engagement.</p>
                                </div>
                                <a href="#" class="btn btn-light btn-sm rounded-pill text-success fw-bold">Apply Now <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-lg text-white bg-info" style="border-radius: 15px; height: 250px; background-image: url('path/to/your/chat-image.jpg'); background-size: cover;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold">Chat with Us</h5>
                                    <p>Need help? Start a chat with our support team now!</p>
                                </div>
                                <a href="#" class="btn btn-light btn-sm rounded-pill text-info fw-bold">Start Chat <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 5 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="card shadow-lg text-white bg-warning" style="border-radius: 15px; height: 250px; background-image: url('path/to/your/notifications-image.jpg'); background-size: cover;">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold">Notifications</h5>
                                    <p>You have <strong>5</strong> unread notifications.</p>
                                </div>
                                <a href="#" class="btn btn-light btn-sm rounded-pill text-warning fw-bold">View Notifications <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 6: Profile -->
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="card shadow-lg bg-secondary text-white w-100" style="border-radius: 15px; background-image: url('path/to/your/profile-background.jpg'); background-size: cover;">
                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <img src="https://i.pravatar.cc/100?img=3" class="rounded-circle mx-auto mb-3" alt="Profile" style="width: 100px; height: 100px; border: 3px solid #fff;">
                                <div>
                                    <h5 class="fw-bold">John Doe</h5>
                                    <p>Software Developer</p>
                                    <small class="text-light">Joined: January 2022</small>
                                </div>
                                <a href="#" class="btn btn-light btn-sm mt-3 rounded-pill text-secondary fw-bold">View Profile <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                </div> <!-- /row -->
            </div> <!-- /container-fluid -->
        </div> <!-- /app-content -->
    </main>
@endsection
