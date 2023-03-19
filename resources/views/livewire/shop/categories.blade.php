<div>
    <div class="container direction-rtl">

        <section class="container">
            <input wire:model.debounce.300ms="search" type="text" class="ag-grid-filter form-control " id="filter-text-box"
                   placeholder="Search by Industry">
            <ul class="ps-0 chat-user-list mt-3">
                <!-- Single Chat User -->

                @foreach($categories as $shop)
                    <li class="p-3 chat-unread"><a class="d-flex" href="{{ route('shop.industry', $shop) }}">
                            <!-- Thumbnail -->
                            <div class="chat-user-thumbnail me-3 shadow">
                                <img class="img-thumbnail" src="{{ $shop ->log }}" alt="">
                            </div>
                            <!-- Info -->
                            <div class="chat-user-info">
                                <h6 class="text-truncate mb-0">{{ $shop -> name }}</h6>
                                <div class="last-chat">
                                    <p class="mb-0 text-truncate">
                                    <span class="badge rounded-pill bg-success ms-2">{{ $shop ->shops -> count() ?? 0 }}</span>
                                        Shops
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

            {{ $categories->links() }}
        </section>
    </div>
</div>
