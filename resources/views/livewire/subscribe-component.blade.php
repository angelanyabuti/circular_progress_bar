<div>
    <section class="section pb-0 bg-dragula">
        <div class="container bg-white">
            <div class="row align-content-center d-flex justify-content-center">
                <div class="col-lg-12 text-center py-5">
                    <h2 class="section-title">Select Plan</h2>
                </div>

                @foreach($plans as $plan)
                    <div class="col-lg-3 col-sm-6 mb-lg- mb-4 col">
                        <div class="hover-bg-primary text-center position-relative px-4 py-5 rounded-lg ">
                            <img src="{{ $plan->getLastMediaUrl('plans') }}" class="img-fluid" alt="{{ $plan->name }}">
                            <h5 class="pt-5 text-capitalize card-title">{{ $plan -> name }}</h5>
                            <p class=" pb-3 text-capitalize card-title">KSH ({{ $plan -> price }})</p>
                            <p class="mb-4">
                               {{ $plan -> description }}
                            </p>
                            @if(auth()->check())
                                <a class="btn btn-warning" href="{{ route('update.plan', ['plan' => $plan->slug]) }}" data-abc="true">Select Plan</a>
                            @else
                                <a class="btn btn-warning" href="{{ route('auth.merchant', ['plan' => $plan->slug]) }}" data-abc="true">Register</a>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</div>
