<div>

    <div class="container">
        <div class="card">
            <div class="card-body">

                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-success">Your cart</span>
                        </h4>
                        <ul class="list-group mb-3">
                            @foreach($order -> items as $item)
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">{{ $item -> product -> name }}</h6>
{{--                                        <small class="text-muted">Brief description</small>--}}
                                    </div>
                                    <span class="text-muted">{{ $item -> price }}</span>
                                </li>
                            @endforeach
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0"> Shipping</h6>
                                    </div>
                                    <span class="text-muted">{{ $order-> shipping_cost }}</span>
                                </li>

                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (KSH)</span>
                                <strong>{{ $order -> amount + $order ->shipping_cost }}.00</strong>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        @if($addm == true)
                            <h4 class="mb-3">Billing address</h4>
                            <form>
                                <div class="row g-3">
                                    <div class="col-sm-12">
                                        <label for="firstName" class="form-label">Name</label>
                                        <input wire:model.defer="name" type="text" class="form-control" id="firstName" placeholder="" value="{{ $user ->name }}" required="">
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                                        <input wire:model.defer="email" type="email" class="form-control" id="email" value="{{ $user ->email }}">
                                        <div class="invalid-feedback">
                                            Please enter a valid email address for shipping updates.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="email" class="form-label"> <span class="text-muted">Phone</span></label>
                                        <input wire:model.defer="phone" type="email" class="form-control" id="email" value="{{ $user ->phone }}">
                                        <div class="invalid-feedback">
                                            Please enter a valid Phone address for shipping updates.
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label for="country" class="form-label">County</label>
                                        <select wire:model.defer="county" class="form-select" id="country" required="">
                                            <option value="">Choose...</option>
                                            @foreach($counties as $county)
                                            <option>{{ $county -> name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Search Location</label>
                                        <input wire:model.defer="address" type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Choose Location">
                                    </div>

                                    <div class="form-group" id="latitudeArea">
                                        <input type="text" wire:model.defer="latitude" id="latitude" name="latitude" class="form-control" required hidden>
                                    </div>
                                    <div class="form-group" id="longtitudeArea">
                                        <input type="text" wire:model.defer="longitude" name="longitude" id="longitude" class="form-control" required hidden>
                                    </div>

                                </div>


                                <hr class="my-4">


                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="save-info">
                                    <label class="form-check-label" for="save-info">Save this information for next time</label>
                                </div>

                                <hr class="my-4">
                                <button wire:click.prevent="add()" class="w-100 btn btn-success btn-lg">Continue to Shipping</button>
                            </form>
                        @else
                            <h4 class="mb-3">Select Shipping method</h4>
                            <div class="row">
                                <div class="alert alert-primary" role="alert">
                                    <i class="text-capitalize fs-5 text-danger">100% money-back guarantee</i>. If you're not satisfied, we're not satisfied. <br>
                                    That's why we'll happily refund your money back on purchases made through KouponZetu check-out.
                                </div>

                            </div>
                            <div class="form-check">
                                <input wire:model="method" value="home" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Home and Office Delivery
                                </label>
                                <p>
                                    {{ $order -> address }}
                                </p>

                                <p>
                                    Please ensure you have entered your home or office address so that we can deliver to you successfully. for
                                    <strong class="text-danger">KSH  {{ $distance * 20 }} </strong>
                                </p>
                            </div>
                            <div class="form-check">
                                <input wire:model="method" value="pick" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Pickup Station
                                </label>
                                @forelse($agents as $agent)
                                    <div class="form-check">
                                        <input wire:model="agent" value="{{ $agent['id'] }}" class="form-check-input" type="radio" name="agent" id="agent">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{ $agent['user']['name']}}
                                        </label>
                                        <p>
                                            {{ $agent['bio'] }}
                                        </p>
                                    </div>
                                @empty
                                    <p>
                                            No Agents near you
                                    </p>

                              @endforelse
                            </div>
                            <form action="https://payments.ipayafrica.com/v3/ke" type="post">
                                @foreach($fs  as $key => $value)
                                    <input type="hidden" value="{{ $value }}" name="{{ $key }}">
                                @endforeach
                                <input type="hidden" name="hsh" value="{{ $hash }}">

                                    @if($method)

                                        @if($order -> status == 'pending')
                                            <button type="submit" class="w-100 btn btn-success btn-lg">Continue to Payment</button>
                                        @else
                                            <p>Order already paid</p>
                                            <a href="{{ url('my-orders') }}" class="w-100 btn btn-success btn-lg">Go to your deals</a>
                                        @endif
                                    @endif

                            </form>
                        @endif


                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ config('services.google_maps_key') }}&libraries=places"></script>

    <script>
        $(document).ready(function () {
            $("#latitudeArea").addClass("d-none");
            $("#longtitudeArea").addClass("d-none");
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var input = document.getElementById('autocomplete');

            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();


            @this.set('latitude', place.geometry['location'].lat());
            @this.set('longitude', place.geometry['location'].lng());
            @this.set('address', place.formatted_address);

                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
    </script>
@endpush
