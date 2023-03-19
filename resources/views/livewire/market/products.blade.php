<div>
    <div class="row">
        <div class="col-md-12">
            <h5 class="text-bold-700" style="font-size: 24px">TRENDING PRODUCTS</h5>
       </div>
    </div>
    <div class="row">
        @foreach($products as $item)
            <div class="col-md-6 col-lg-3">

                <!-- Simple card -->
                <div class="card d-block">
                    <img class="card-img-top" src="{{ $item -> default_image }}" alt="Card image cap">
                    <div class="card-body">
                        <a href="{{ route('product', $item) }}" class="text-decoration-none">
                            <h5 class="card-title">{{ $item -> name }} <strong class="text-right float-right">{{ $item -> price }}</strong></h5>
                        </a>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div>
            @if ($loop ->iteration == 8)
                @break
            @endif
        @endforeach
    </div>
</div>
