@extends('front.layouts.app')
@section('content')

<div class="container">
    @include('front.users.profile-top')

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Connections Section -->
    <div class="mt-4">
        <h4 class="blue poppins-bold">Connections</h4>
        <div class="row">
            @forelse ($connections as $connection)
                <div class="col-md-6">
                    <div class="whiteBox bg-white p-3 mb-2">
                        <div class="notification-wrapper">
                            <div class="note-img">
                                <img src="{{ $connection->profile_image ?? asset('front-assets/images/default.jpg') }}" alt="">
                            </div>
                            <div class="note-content">
                                <p class="mb-0 fs-7">
                                    <a href='{{ URL::route("user.connection.userprofile", [base64_encode($connection->id)]) }}' class="grey">
                                        <strong>{{ $connection->name }}</strong>
                                    </a>
                                </p>
                                <p class="mb-0 fs-8">{{ $connection->industry ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
              <div class="col-md-6">
                    <div class="whiteBox bg-white p-3 mb-2">
                        <div class="notification-wrapper">
                            <!-- <div class="note-img">
                                <img src="{{ $connection->profile_image ?? asset('front-assets/images/default.jpg') }}" alt="">
                            </div> -->
                            <div class="note-content">
                                <p class="mb-0 fs-7">
                                    <a href="#" class="grey">
                                        <strong></strong>
                                    </a>
                                </p>
                                <p>No connections found.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endforelse
        </div>
    </div>
    </div>
    <div class="col-lg-5 mt-4">
    @include('front.users.suggestions')
    </div>
    <!-- Suggestions Section -->
    <div class="col-lg-5 mt-4 d-none">
        <div class="whiteBox bg-white p-3 mb-3">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="blue poppins-bold mb-0 fs-6">Suggestions</h5>
                <div class="d-flex align-items-center siderbar-search">
                    <div class="al-search d-flex justify-content-end w-100">
                        <button class="border-0 bg-white">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        <input type="text" placeholder="Search">
                    </div>
                </div>
            </div>

            @forelse ($suggestions as $suggestion)
                <div class="notification-wrapper mb-4">
                    <div class="note-img">
                        <img src="{{ $suggestion->profile_image ?? asset('front-assets/images/default.jpg') }}" alt="">
                    </div>
                    <div class="note-content">
                        <p class="mb-0 fs-7">
                            <a href='{{ URL::route("user.connection.userprofile", [base64_encode($suggestion->id)]) }}' class="grey">
                                <strong>{{ $suggestion->name }}</strong>
                            </a>
                        </p>
                        <p class="mb-0 fs-8">{{ $suggestion->industry ?? 'N/A' }}</p>
                    </div>
                    <div class="sr-btn">
                        <form action="{{ route('user.sendConnection') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $suggestion->id }}">
                            <button class="bg-blue btn text-white fs-8" type="submit">Send Request</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>No suggestions available.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
