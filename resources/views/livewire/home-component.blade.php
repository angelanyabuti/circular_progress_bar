<div>
    <div wire:ignore class="container direction-rtl">
        <div class="card mb-3">
            <div class="card-body">
                <div wire:ignore.self class="row my-slider" id="categoryList">
                    @foreach($categories as $category)
                        <div wire:ignore.self wire:click="getKids({{$category}})" onclick="location.href='#kids-list'" class="col-3 categoryList" style="cursor: pointer">
                            <div class="feature-card mx-aut o text-center">
                                <div class="card mx-auto bg-gray">
                                    <img src="{{ $category->img }}" alt="" title="">
                                </div>
                                <p class="mb-0"> {{  $category -> name }} </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @if($kids)
     <div class="container mb-5 card" >

        <div class="element-heading pt-3">
            <h6 class="ps-1">Deals under {{ $active['name'] }} </h6>
        </div>
        <ul class="ps-0 chat-user-list mt-3 mb-3" id="kids-list">
            @forelse ($kids  as $cat)

                <li class="p-3 chat-unread">
                    <a class="d-flex" href="{{ route('category', $cat) }}">
                        <!-- Thumbnail -->
                        <div class="chat-user-thumbnail me-3 shadow">
                            <img class="img-circle" src="{{ $cat -> default_image }}" alt="">
                            <span class="active-status"></span></div>
                        <!-- Info -->
                        <div class="chat-user-info">
                            <h6 class="text-truncate mb-0">{{ ucwords($cat -> name) }}</h6>
                            <div class="last-chat">
                                <p class="mb-0 text-truncate">We've got some deals</p>
                            </div>
                        </div>
                        <!-- Options -->
                        <div class="dropstart chat-options-btn">
                            <i class="bi bi-arrow-bar-right"></i>
                        </div>
                    </a>
                </li>

            @empty

                @forelse ($products  as $product)

                    <li class="p-3 chat-unread">
                        <a class="d-flex" href="{{ route('duka', $product->shop) }}">
                            <!-- Thumbnail -->
                            <div class="chat-user-thumbnail me-3 shadow">
                                <img class="img-circle" src="{{ $product -> default_image }}" alt="">
                                <span class="active-status"></span></div>
                            <!-- Info -->
                            <div class="chat-user-info">
                                <h6 class="text-truncate mb-0">{{ ucwords($product -> name) }}</h6>
                                <div class="last-chat">
                                    <p class="mb-0 text-truncate">
                                        {{ $product -> shop -> name }}
                                    </p>
                                </div>
                            </div>
                            <!-- Options -->
                            <div class="dropstart chat-options-btn">
                                <i class="bi bi-arrow-bar-right"></i>
                            </div>
                        </a>
                    </li>

                @empty
                    <p class="p-2 text-truncate">
                        No Active deals  found.
                    </p>


                @endforelse

            @endforelse

        </ul>
    </div>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
    <script>
        var slider = tns({
            container: '.my-slider',
            items: 3,
            controls: false,
            nav: false,
            autoplayButtonOutput: false,
            autoplayResetOnVisibility: false,
            slideBy: 'page',
            autoplay: true
        });
    </script>
</div>
