<figure class="card card-product-grid">
    <div class="img-wrap">
        <span class="badge badge-danger"> NEW </span>
        <img src="{{ $product -> default_image }}">
        <span class="topbar">
            <a href="#" class="float-right font-20"><i class="fa fa-heart"></i></a>
        </span>
        <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
    </div>
    <figcaption class="info-wrap border-top">
        <a href="{{ route('product', $product) }}" class="title">{{ $product -> name }}</a>
        <div class="price mt-2">€ {{ $product -> price }}</div> <!-- price-wrap.// -->
    </figcaption>
</figure>
