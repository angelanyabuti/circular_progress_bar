<div>
    <section class="padding-bottom-sm">

        <header class="section-heading heading-line">
            <h4 class="title-section text-uppercase">Trending items</h4>
        </header>

        <div class="row row-sm">
            @foreach($products as $product)
            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                <div class="card card-sm card-product-grid">
                    <a href="{{ route('product', $product) }}" class="img-wrap">
                        <img src="{{ $product -> default_image }}">
                    </a>
                    <figcaption class="info-wrap">
                        <a href="{{ route('product', $product) }}" class="title">{{ $product -> name }}</a>
                        <div class="price mt-1">$ {{ $product -> price }}</div> <!-- price-wrap.// -->
                    </figcaption>
                </div>
            </div> <!-- col.// -->
            @endforeach
        </div> <!-- row.// -->
    </section>
</div>
