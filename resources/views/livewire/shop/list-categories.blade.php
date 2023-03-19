<div>
    <section class="container">
        <div class="card">
            <div class="card-body">
                <input wire:model.debounce.300ms="search" type="text" class="ag-grid-filter form-control " id="filter-text-box" placeholder="Search Categories">
                <ul class="ps-0 chat-user-list mt-3">
                    <!-- Single Chat User -->

                    @foreach($categories as $item)
                        <li class="p-3 chat-unread"><a class="d-flex" href="{{ route('category', $item) }}">
                                <!-- Thumbnail -->
                                <div class="chat-user-thumbnail me-3 shadow">
                                    <img class="img-thumbnail" src="{{ $item ->img }}" alt="">
                                </div>
                                <!-- Info -->
                                <div class="chat-user-info">
                                    <h6 class="text-truncate mb-0">{{ $item -> name }}</h6>
                                    <div class="last-chat">
                                        <p class="mb-0 text-truncate">
                                            <span class="badge rounded-pill bg-primary ms-2">{{ $item ->products -> count() }}</span>
                                            Deals
                                        </p>
                                    </div>
                                </div></a>
                        </li>

                    @endforeach
                </ul>

            </div>
        </div>

    </section>
</div>
