<div>
    <section class="container">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="bg-white  rounded overflow-hidden">
                        <div class="pt-0 cover px-2" style="background-image: url({{ asset($product -> default_image) }})">
                            <div class="media align-items-end profile-head">
                                <div class="profile mr-3">
                                    <img src="{{ $product-> shop -> log }}" alt="..." width="100" class="rounded mb-2 img-thumbnail">
                                </div>
                                <div class="media-body mb-5 text-white bg-light pt-3 pb-1 px-3">
                                    <h6 class="mt-0 mb-3">
                                        {{ $product-> shop -> name }}
                                    </h6>
                                    <p class="small"> <i class="bi bi-pin-map me-2 mr-2"></i>{{ $product-> shop -> address }}</p>
                                    {{--                                        <p class="small"> <i class="bi bi-clock me-2 mr-2"></i>{{$active['end_date']}}</p>--}}
                                    <p class="small"  id="{{ $product-> id }}"> </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-light d-flex justify-content-end text-center">
                            <ul class="list-inline mb-0">
                                <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
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
                            </ul>
                        </div>
                        <div class="px-4 py-3 mt-5">
                            <h5 class="mb-0"> {{ $product-> name }}</h5>
                            <div class="p-2 rounded">
                                <p class="card-text mb-0">{!! $product-> descripiton !!}</p>
                                @if($product -> type == 'product')
                                    <a href="#" wire:click.prevent="add()" class="btn btn-warning btn-block mt-5">Add to Cart</a>
                                @else
                                    <a href="#" wire:click.prevent="add()" class="btn btn-warning btn-block mt-5">Redeem Now!</a>

                                @endif

                            </div>
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
                        <a href="{{ $product-> shop -> company->website ?? '#' }}" target="_blank">
                            <div class="single-counter-wrap text-center mb-4">
                                <i class="bi bi-link text-success" style="font-size: 32px"></i>

                                <p class="mb-0 text-success"><span class="counter">{{  $product-> shop -> company->website ?? $active['shop']['name'] }}</span></p>
                            </div>
                        </a>

                    </div>
                    <div class="col-4">

                        <a href="tel:{{ $product-> shop -> phone ?? '#' }}" target="_blank">
                            <div class="single-counter-wrap text-center mb-4">
                                <i class="bi bi-phone text-success" style="font-size: 32px"></i>
                                <p class="mb-0 text-success"><span class="counter">{{  $product-> shop -> phone }}</span></p>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>

    </section>

</div>
