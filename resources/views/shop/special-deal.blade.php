@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="card product-details-card mb-3 direction-rtl">
            <div class="card-body">
                <div class="single-product-image">
                    <a class="gallery-img2">
                        <img class="rounded" src="" alt="">
                    </a>
                </div>
                <a class="product-thumbnail d-block mb-3" href="#">
                    <img src="{{ asset('storage/'.$event->image) }}" alt="">
                </a>
                <h3> {{ ucfirst($event -> name) }}</h3>
                <p>{{ $event -> description }}</p>
            </div>
        </div>
        <div class="card product-details-card mb-3 direction-rtl">
            <div class="card-body">
                <p>Please Get the event date</p>
                <form action="{{ route("special-deal") }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="date" class="form-control form-control-clicked" name="event_date"
                               placeholder="Event Date">
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="event" value="{{ $event -> id }}">
                    </div>

                    <div class="form-group">
                        <lable>Name / Alias</lable>
                        <input type="text" class="form-control" name="name" >
                    </div>
                    <div class="form-group">
                        <lable>Email</lable>
                        <input type="email" class="form-control" name="email" >
                    </div>
                    <div class="input-group">
                        <button type="submit" class="btn btn-success btn-block">Save for Special Offers</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
