@extends('layouts.index')

@section('content')

    <div class="owl-carousel-one owl-carousel">
        <!-- Single Hero Slide -->
        @foreach($slides as $slide)
            <div class="single-hero-slide bg-overlay" style="background-image: url({{ $slide->img }})">
                <div class="slide-content h-100 d-flex align-items-center text-center">
                    <div class="container">
                        <h3 class="text-white mb-1" data-animation="fadeInUp" data-delay="100ms"
                            data-wow-duration="1000ms"> {{ $slide -> title }}</h3>
                        <p class="text-white mb-4" data-animation="fadeInUp" data-delay="400ms"
                           data-wow-duration="1000ms">{{ Str::limit( $slide -> description, 50 , ' ...')  }}</p>
                        <a class="btn btn-creative btn-warning" href="{{ $slide->url }}">Check now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pt-3"></div>
    <livewire:checkin-component/>
    <div class="pt-3"></div>
    <div class="container mb-2">
        <div class="card position-relative shadow-sm" id="map">
            <div id="map-canvas"></div>
        </div>
    </div>
    <livewire:home-component/>
    <div class="pt-3"></div>

@endsection


@push('scripts')
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ config('services.google_maps_key') }}"></script>
    <script>
        $( document ).ready(function() {
                $.ajax({
                    url: '/points',
                    type: 'GET',
                    dataType: 'json',
                    success: function( data ){
                        if (data.length === 0)
                        {
                            navigator.geolocation.getCurrentPosition(showPosition);
                            function showPosition(position) {
                                let lat = position.coords.latitude
                                let lon = position.coords.longitude
                                var options = {
                                    zoom: 8,
                                    center: new google.maps.LatLng( lat, lon ),
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                };
                                new google.maps.Map( document.getElementById('map-canvas' ), options );
                            }


                        }else {
                            var keys = Object.keys(data);
                            var center = data[keys[ keys.length * Math.random() << 0]]

                            var options = {
                                zoom: 8,
                                center: new google.maps.LatLng( center.latitude, center.longitude ),
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            };
                            var map = new google.maps.Map( document.getElementById('map-canvas' ), options );

                            for( var n in data ){
                                var obj = data[ n ];
                                var latlng = new google.maps.LatLng( obj.latitude, obj.longitude );
                                var marker = new google.maps.Marker( { position: latlng, map: map, tooltip: obj.name, url: obj.url  } );

                                // google.maps.event.addListener(marker, 'click', function() {
                                //     window.location.href = marker.url;
                                // });

                                var address = '<a href="' + obj.url +'">' + obj.name + '</a>';
                                var infowindow = new google.maps.InfoWindow({
                                    content: address
                                });
                                marker.addListener('click', function() {
                                    infowindow.open(map, marker);
                                });
                            }
                        }


                    },
                    error: function(e){
                        output.text('There was an error loading the data.');
                    }
                });
            });

    </script>
@endpush

