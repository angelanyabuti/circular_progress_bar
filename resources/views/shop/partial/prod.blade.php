<div class="top-produc ts-area">
    <div class="row g-3">
        @forelse($products as $item)
            <div class="col-6 col-sm-4 col-lg-3">
                <div class="card single-product-card">
                    <div class="card-body p-2">
                        <a class="product-thumbnail d-block" href="#" wire:click="show({{ $item }})"
                           data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <img src="{{ $item -> default_image }}"  width="100%" height="250" style="max-height: 250px !important;">
                            @if($item -> type == 'product')
                            <span class="badge bg-warning">Kes {{ $item -> price }}</span>
                            @else
                                <span class="badge bg-warning">Quick Grab</span>
                            @endif
                        </a>
                        <a class="product-title d-block text-truncate p-1" href="#"> {{ $item  -> name }} </a>

                        @if($item -> type == 'product')
                            <p class="sale-price">Ksh {{ $item -> price }}<span> Ksh{{ $item -> mock_price }}</span></p>
                        @endif

                        <a class="btn btn-success btn-sm p-2 btn-block" href="#" wire:click="show({{ $item }})"
                           data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-6">
                <div class="card-body">
                    <p>NO Items for Now. Keep Checking</p>
                </div>
            </div>
        @endforelse
    </div>
</div>




<div wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @if($active)
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">

                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="" >
                            <div class="img-bg">
                                <div class="media align-items-end profile-head">
                                    <div class="profile mr-3">
                                        <a href="{{ route('duka', $active['shop']['slug']) }}">
                                            <img src="{{ $active['shop']['log'] }}" alt="..." width="100" class="rounded mb-2 img-thumbnail">
                                        </a>
                                        <div class="media-body mb-5 text-white  pt-3 pb-1 px-3">
                                            <h6 class="mt-0 mb-3">
                                                {{ $active['shop']['name'] }}
                                            </h6>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row px-4 py-3 mt-5">
                        <div class="col-md-12">
                            <h3 class="mb-1"> {{ $active['name'] }}</h3>
                            <p class="mt-2 mb-2 text-danger"  id="{{ $active['id'] }}"> </p>
                            <p class="card-text mb-0">{!! $active['description'] !!}</p>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6 col">
                            @if($active['type'] == 'product')
                                <a href="#" wire:click.prevent="add()" class="btn btn-warning btn-block mt-2">Add to Cart</a>
                            @else
                                <a href="#" wire:click.prevent="add()" class="btn btn-warning btn-block mt-2">Redeem Now!</a>

                            @endif
                        </div>
                        <div class="col-md-6 col justify-content-end">
                            <div class="dropdown justify-content-end">
                                <button class="btn btn-success dropdown-toggle mt-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Share
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    @foreach($links as $value => $link)
                                        <li>
                                            <a class="dropdown-item" href="{{ $link }}">
                                                <i class="fa fa-{{ $value }}"></i>
                                                {{ $value }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>

                    <hr>


                    <div class="row">
                        <div class="col-4">
                            <!-- Single Counter -->
                            <div class="single-counter-wrap text-center mb-4">
                                <i class="bi bi-pin-map text-success" style="font-size: 32px"></i>
                                <p class="mb-0 text-success"><span class="counter">Nairobi</span></p>
                            </div>
                        </div>
                        <div class="col-4">
                            <!-- Single Counter -->
                            <a href="http://{{ $active['shop']['company']['website'] ?? '#' }}" target="_blank">
                                <div class="single-counter-wrap text-center mb-4">
                                    <i class="bi bi-link text-success" style="font-size: 32px"></i>

                                    <p class="mb-0 text-success"><span class="counter">{{ $active['shop']['company']['website'] ?? $active['shop']['name'] }}</span></p>
                                </div>
                            </a>

                        </div>
                        <div class="col-4">

                            <a href="tel:{{ $active['shop']['phone'] ?? '#' }}" target="_blank">
                                <div class="single-counter-wrap text-center mb-4">
                                    <i class="bi bi-phone text-success" style="font-size: 32px"></i>
                                    <p class="mb-0 text-success"><span class="counter">{{ $active['shop']['phone'] }}</span></p>
                                </div>
                            </a>

                        </div>
                    </div>
                </div>


            @endif

        </div>
    </div>
</div>

@if($active)
    <style>
        .img-bg {
            background-color: #0a0c0d;
            background-image: url({{ asset($active['default_image']) }});
            object-fit: scale-down;
            background-position: center;
            background-size: contain;
            /*background-repeat: no-repeat;*/


        }


    </style>
    <script>


    </script>
@endif
