@extends('layouts.index')

@section('content')
    {{--    <div class="container">--}}
    {{--        <div class="card card-gradient-bg">--}}
    {{--            <div class="card-body p-5 direction-rtl">--}}
    {{--                <h2 class="display-3 mb-4">Get best deals for your special Events</h2>--}}
    {{--                <a class="btn btn-lg btn-light btn-round" href="#">Contact Now</a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="container mt-2">
        <div class="owl-carousel-two-wrapper">
            <div class="owl-carousel-two owl-carousel">
                <!-- Single Hero Slide -->
                <div class="single-hero-slide bg-img bg-overlay" style="background-image: url('img/bg-img/31.jpg')">
                    <div class="slide-content h-100">
                        <h3 class="text-white">We are with you</h3>
                        <p class="text-white">When you go for Ruracio</p>
                        <a class="btn btn-creative btn-warning" href="#">More ..</a>
                    </div>
                </div>
                <!-- Single Hero Slide -->
                <div class="single-hero-slide bg-img bg-overlay"
                     style="        background-image: url('img/bg-img/32.jpg')          ">
                    <div class="slide-content h-100">
                        <h3 class="text-white">We are with you</h3>
                        <p class="text-white">When making that big step </p>
                        <a class="btn btn-creative btn-warning" href="#">More .. </a>
                    </div>
                </div>
                <!-- Single Hero Slide -->
                <div class="single-hero-slide bg-img bg-overlay" style="background-image: url('img/bg-img/33.jpg')">
                    <div class="slide-content h-100">
                        <h3 class="text-white">We are with you</h3>
                        <p class="text-white">When the baby is arriving</p>
                        <a class="btn btn-creative btn-warning" href="#">More ..</a>
                    </div>
                </div>
            </div>
            <!-- Do not remove this ID, this ID counts how many slides there are. -->
            <div id="totalowlDotsCount"></div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <hr>
                @foreach($events as $event)
                    <a href="{{ route('specialDeal', $event) }}">
                        <div class="col-10">
                            <div class="elements-heading d-flex align-items-center mt-4 mb-4">
                                <div class="icon-wrapper">
                                    <img src="{{ asset('storage/'.$event->image) }}">
                                </div>
                                <div class="heading-text">
                                    <h5 class="mb-0">{{ ucwords($event -> name) }}</h5>
                                    <span> {{Str::limit($event->description, 50, $end='.....')}} </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <hr>
                @endforeach
            </div>
        </div>

    </div>

@endsection
