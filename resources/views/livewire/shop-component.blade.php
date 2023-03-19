<div>
    <div class="row" id="table-hover-animation">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Shops</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" wire:model="perPage">
                                <option>15</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="col-md-8 d-flex  justify-content-end">
                            <input wire:model.debounce.300ms="search" type="text" class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0" id="filter-text-box" placeholder="Search....">
                            <div class="btn-export">
                                <button  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary ag-grid-export-btn waves-effect waves-float waves-light">New Shop</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Owner Company</th>
                            <th>Contact Email</th>
                            <th>Shop Type</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($shops as $item)
                            <tr>
                                <td>{{ $item -> name}} </td>
                                <td>{{ $item -> company ->name}} </td>
                                <td>{{ $item ->company->email}} </td>
                                <td>{{ $item -> industry ->name}} </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('single.shop', $item) }}" >
                                                <i data-feather="eye" class="mr-50"></i>
                                                <span>View</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal" wire:click="edit({{ $item->id }})" >
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" wire:click="setActive({{ $item->id }})" onclick="del()">
                                                <i data-feather="trash" class="mr-50"></i>
                                                <span>Delete</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--Modal--}}
    <div wire:ignore.self  class="modal modal-slide-in new-user-modal fade" id="exampleModal">
        <div class="modal-dialog">
            <form class="add-new-user modal-content pt-0">
                <button wire:click.prevet="resetAll()" type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Shop Name</label>
                        <input wire:model.defer="name" type="text" class="form-control" />
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Shop Email</label>
                        <input wire:model.defer="email" type="text" class="form-control" />
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Shop Phone</label>
                        <input wire:model.defer="phone" type="text" class="form-control" />
                        @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Shop Type</label>
                        <select wire:model="industry_id" class="form-control">
                            <option value="">Select </option>
                            @foreach($industries  as  $industry)
                            <option value="{{ $industry ->id }}">{{ $industry -> name }}</option>
                            @endforeach
                        </select>
                        @error('industry_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Description</label>
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
                        <label for="address_address"> Address Selection </label>
                        <input type="text" id="location" name="location" class="form-control map-input">
                    </div>

                    <div class="form-group">
                        <label>City </label>
                        <input type="text" id="locality" name="locality" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>County</label>
                        <input type="text" name="state-province" id="administrative_area_level_1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Country </label>
                        <input type="text" name="country" id="country" class="form-control" value="kenya" readonly>
                    </div>

                    <div class="map" id="map"></div>

                    <div class="form-group">
                        <div class="border rounded p-2">
                            <h4 class="mb-1"> Logo</h4>
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

                    @if($editMode == true)
                        <div class="row">
                            <label class="form-label col-12"  for="basic-icon-default-fullname">Existing Image</label>
                            <div class="col-md-4 col-6 profile-latest-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('storage/'.$active ->logo) }}" class="img-fluid rounded" alt="avatar img">
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="mt-3">
                        @if($editMode == true)
                            <button wire:click.prevent="update()"  class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Edit</button>
                        @else
                            <button wire:click.prevent="store()"  class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Create</button>
                        @endif
                        <button wire:click.prevet="resetAll()" type="reset" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div id="map"></div>
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
