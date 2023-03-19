@extends('layouts.index')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="standard-tab ">
                    <ul class="nav rounded-lg mb-2 p-2 shadow-sm" id="affanTabs1" role="tablist">
                        <li class="nav-item" role="presentation">

                            <button class="btn text-dark active" id="bootstrap-tab" data-bs-toggle="tab" data-bs-target="#bootstrap" type="button" role="tab" aria-controls="bootstrap" aria-selected="true">
                                <i class="bi bi-list-task"></i>
                                List
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">

                            <button class="btn text-dark" id="pwa-tab" data-bs-toggle="tab" data-bs-target="#pwa" type="button" role="tab" aria-controls="pwa" aria-selected="false">
                                <i class="bi bi-exclamation"></i>
                                Type
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">

                            <button class="btn text-dark" id="dark-tab" data-bs-toggle="tab" data-bs-target="#dark" type="button" role="tab" aria-controls="dark" aria-selected="false">
                                <i class="bi bi-pin-map"></i>
                                Map
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content rounded-lg " id="affanTabs1Content">
                        <div class="tab-pane fade show active" id="bootstrap" role="tabpanel" aria-labelledby="bootstrap-tab">
                            <div class="">
                                <div class="card-body">
                                    <div class="standard-tab">
                                        <ul class="nav p-1 mb-3 shadow-sm" id="affanTab3" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="btn text-dark active" id="creative-tab" data-bs-toggle="tab" data-bs-target="#creative" type="button" role="tab" aria-controls="creative" aria-selected="false">Instore</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="btn text-dark " id="modern-tab" data-bs-toggle="tab" data-bs-target="#modern" type="button" role="tab" aria-controls="modern" aria-selected="true">Online</button>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="affanTab3Content">
                                            <div class="tab-pane fade active show" id="creative" role="tabpanel" aria-labelledby="creative-tab">

                                                <livewire:shop.instore-coupons/>

                                            </div>
                                            <div class="tab-pane fade " id="modern" role="tabpanel" aria-labelledby="modern-tab">
                                                <livewire:shop.online-coupons/>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pwa" role="tabpanel" aria-labelledby="pwa-tab">
                            <livewire:shop.list-categories/>
                        </div>
                        <div class="tab-pane fade" id="dark" role="tabpanel" aria-labelledby="dark-tab">

                            <div id="map" style="width: 100%; height: 400px; "></div>
                            <livewire:near-deals-component/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-Level Scripts -->
    <script type='text/javascript' charset="utf-8">
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function () {

                function initMap() {

                    var location = new google.maps.LatLng(-1.3000286, 36.8977003);

                    var mapCanvas = document.getElementById('map');
                    var mapOptions = {
                        center: location,
                        zoom: 16,
                        panControl: false,
                        scrollwheel: false,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    }
                    var map = new google.maps.Map(mapCanvas, mapOptions);

                    var markerImage = 'marker.png';

                    var marker = new google.maps.Marker({
                        position: location,
                        map: map,
                        icon: markerImage
                    });

                    var contentString = '<div class="info-window">' +
                        '<h3>Info Window Content</h3>' +
                        '<div class="info-content">' +
                        '<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>' +
                        '</div>' +
                        '</div>';

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        maxWidth: 400
                    });

                    marker.addListener('click', function () {
                        infowindow.open(map, marker);
                    });


                }

                google.maps.event.addDomListener(window, 'load', initMap);
            });

        });
    </script>

@endsection
