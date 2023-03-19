<div class="mb-3">
    <div class="row">
        @foreach($categories as $category)
        <div class="col-md-4 mb-2">
            <div class="card-banner align-items-end" style="height:250px; background-image: url({{ $category -> image }});">
                <a href="{{ route('category', $category) }}">
                    <article class="caption m-4 w-100">
                        <h3 class="card-title">{{ $category -> name }}</h3>
                        <p>No matter how far along you are in your sophistication as an amateur.</p>
                    </article>
                </a>

            </div>
        </div>
        @endforeach
    </div>
</div>
