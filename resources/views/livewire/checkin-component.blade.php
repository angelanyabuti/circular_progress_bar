<div>
    <div class="container">

        <section class="container">
            <a onclick="getLocation()" class="btn btn-creative btn-warning" href="#" role="button">Check-in for nearby deals</a>
            <ul class="ps-0 chat-user-list mt-3">
                <!-- Single Chat User -->

                @if($stores !=null)
                    @foreach($stores as $shop)
                        <li class="p-3 chat-unread"><a class="d-flex" href="{{ route('duka', $shop) }}">
                                <!-- Thumbnail -->
                                <div class="chat-user-thumbnail me-3 shadow">
                                    <img class="img-thumbnail" src="{{ $shop ->log }}" alt="">
                                </div>
                                <!-- Info -->
                                <div class="chat-user-info">
                                    <h6 class="text-truncate mb-0">{{ $shop -> name }}</h6>
                                    <div class="last-chat">
                                        <p class="mb-0 text-truncate">
                                    <span
                                        class="badge rounded-pill bg-primary ms-2">{{ $shop ->products -> count() }}</span>
                                            Deals
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </section>
    </div>



</div>

@push('scripts')
    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            @this.set('lat', position.coords.latitude);
            @this.set('long', position.coords.longitude);
            Livewire.emit('getShops')
        }
    </script>
@endpush
