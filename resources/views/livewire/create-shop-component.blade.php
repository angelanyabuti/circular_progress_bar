<div>
    <div class="container">
        <div class="row mt-lg-1">
            <div class="col-12">
                <div class="modal-header mb-1">
                    <h1 class="modal-title" id="exampleModalLabel">Create your Shop</h1>
                </div>
                <form class="add-new-user modal-content pt-0">
                    <div class="modal-body flex-grow-1">
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Shop Name</label>
                            <input wire:model.defer="name" type="text" class="form-control" />
                            @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Store Email</label>
                            <input wire:model.defer="email" type="text" class="form-control" />
                            @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Store Phone</label>
                            <input wire:model.defer="phone" type="text" class="form-control" />
                            @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Shop Industry</label>
                            <select wire:model="industry_id" class="form-control">
                                <option value="">Select Industry </option>
                                @foreach($industries as $industry)
                                <option value="{{ $industry ->id }}">{{ $industry ->name }}</option>
                                @endforeach
                            </select>
                            @error('type') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Business Bio</label>
                            <textarea wire:model.defer="description" type="text" class="form-control"> </textarea>
                            @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <label>Location/City/Address</label>
                            <input type="text" name="autocomplete" id="autocomplete" class="form-control" placeholder="Choose Location">
                        </div>

                        <div class="form-group" id="latitudeArea">
                            <input type="text" wire:model="latitude" id="latitude" name="latitude" class="form-control" required hidden>
                        </div>
                        <div class="form-group" id="longtitudeArea">
                            <input type="text" wire:model="longitude" name="longitude" id="longitude" class="form-control" required hidden>
                        </div>

                        <div class="form-group">
                            <label for="address_address"> Street Address </label>
                            <input type="text" id="location" name="location" class="form-control map-input">
                        </div>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" id="locality" name="locality" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>County</label>
                            <input type="text" name="state-province" id="administrative_area_level_1" class="form-control">
                        </div>


                        <div class="map" id="map"></div>

                        <div class="form-group">
                            <div class="border rounded p-2">
                                <h4 class="mb-1"> Image</h4>
                                <div class="media flex-column">
                                    @if($logo != null)
                                        <img src="{{ $logo -> temporaryUrl()}}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Blog Featured Image">
                                    @endif
                                    <div class="media-body">
                                        <small class="text-muted">Required image resolution 800x400, image size 10mb.</small>
                                        <div class="d-inline-block">
                                            <div class="form-group mb-0">
                                                <div class="custom-file">
                                                    <input wire:model="logo" type="file" class="custom-file-input" id="blogCustomFile" accept="image/*">
                                                    <label class="custom-file-label" for="blogCustomFile">Choose Image</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('logo') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="mt-3">

                            <button wire:click.prevent="store()"  class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Create</button>

                            <button wire:click.prevet="resetAll()" type="reset" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                        </div>

                    </div>
                </form>
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

                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
    </script>
@endpush
