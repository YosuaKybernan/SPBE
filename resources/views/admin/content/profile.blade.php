@extends('admin.frontend.master')

@section('title', 'Admin SPBE - Bantuan')

@section('page-title')
    Profile
@endsection

@section('breadcrumb-active')
    Profile
@endsection

@section('content-section')
    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="{{ asset('assets/img/operator_picture/' . (Auth::user()->profile_picture ?? 'default.jpg')) }}"
                            alt="Profile" class="rounded-circle"> {{-- Profile Picture --}}
                        <h2>{{ Auth::user()->name }}</h2> {{-- Full Name --}}
                        <h3>{{ Auth::user()->job }}</h3> {{-- Job Position --}}
                        <div class="social-links mt-2">
                            <a href="https://wa.me/{{ Auth::user()->phone }}" class="whatsapp"><i
                                    class="bi bi-whatsapp"></i></a> {{-- WhatsApp --}}
                            <a href="{{ Auth::user()->facebook_url }}" class="facebook"><i class="bi bi-facebook"></i></a>
                            {{-- Facebook --}}
                            <a href="{{ Auth::user()->instagram_url }}" class="instagram"><i
                                    class="bi bi-instagram"></i></a> {{-- Instagram --}}
                            <a href="{{ Auth::user()->linkedin_url }}" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            {{-- LinkedIn --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div> {{-- Full Name --}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">User Name</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->username }}</div> {{-- User Name --}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div> {{-- Email --}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Job</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->job }}</div> {{-- Job Position --}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->address }}</div> {{-- Address --}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->phone }}</div> {{-- Phone Number --}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Facebook</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->facebook_url }}</div>
                                    {{-- Facebook URL --}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Instagram</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->instagram_url }}</div>
                                    {{-- Instagram URL --}}
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">LinkedIn</div>
                                    <div class="col-lg-9 col-md-8">{{ Auth::user()->linkedin_url }}</div>
                                    {{-- LinkedIn URL --}}
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
