<div>
    <section class="container">
        <input wire:model.debounce.300ms="search" type="text" class="ag-grid-filter form-control " id="filter-text-box"
               placeholder="Search businesses">
        <ul class="ps-0 chat-user-list mt-3">
            <!-- Single Chat User -->

            @forelse($shops as $shop)
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
                                    <span class="badge rounded-pill bg-success ms-2">{{ $shop ->products -> count() ?? 0 }}</span>
                                    Deals
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li>
                    <p> No shop in this category with active deals at the moment</p>
                    <p> Check again later</p>
                </li>
            @endforelse
        </ul>
    </section>
</div>
