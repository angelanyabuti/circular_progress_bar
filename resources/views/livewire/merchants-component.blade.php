<div>
    <div class="row" id="table-hover-animation">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Merchants</h4>
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
                                <button  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary ag-grid-export-btn waves-effect waves-float waves-light">New </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr>
                                <td>{{ $item -> name }} </td>
                                <td>{{ $item -> email }}</td>
                                <td>{{ $item -> phone_number }}</td>
                                <td>{{ $item -> type }}</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input  wire:click="toggleActive({{ $item }})" @if($item ->status == 'active') checked @endif type="checkbox" class="custom-control-input" id="{{$item ->id}}">
                                        <label class="custom-control-label" for="{{$item ->id}}">
                                            <span class="switch-text-left">Yes</span>
                                            <span class="switch-text-right">No</span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
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
    <div wire:ignore.self  class="modal fade" id="exampleModal">
        <div class="modal-dialog">
            <form class="add-new-user modal-content pt-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">New Merchant</h5>
                </div>
                <div class="modal-body flex-grow-1">

                    <h5>Company Info</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Company Name</label>
                                <input wire:model.defer="company_name" type="text" class="form-control" />
                                @error('company_name') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Company Email</label>
                                <input wire:model.defer="company_email" type="email" class="form-control" />
                                @error('company_email') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Company Mobile</label>
                                <input wire:model.defer="company_phone" type="text" class="form-control" />
                                @error('company_phone') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Location</label>
                                <input type="text" name="location" id="location" class="form-control  map-input" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="latitudeArea">
                                <label>Latitude</label>
                                <input type="text" wire:model.defer="latitude" id="latitude" name="latitude" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="longtitudeArea">
                                <label>Longitude</label>
                                <input type="text" wire:model.defer="longitude" name="longitude" id="longitude" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <h5>Admin Info</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Name</label>
                                <input wire:model.defer="name" type="text" class="form-control" />
                                @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Email</label>
                                <input wire:model.defer="email" type="text" class="form-control" />
                                @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Phone</label>
                                <input wire:model.defer="phone_number" type="text" class="form-control" />
                                @error('phone_number') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Plan</label>
                                <select class="form-control" wire:model.defer="plan">
                                    <option value="">Select Merchant Plan</option>
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan -> id }}">{{ $plan -> slug }}</option>
                                    @endforeach
                                </select>
                                @error('plan') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Status</label>
                                <select class="form-control" wire:model.defer="status">
                                    <option value="pending">pending</option>
                                    <option value="active">active</option>
                                    <option value="suspended">suspended</option>
                                </select>
                                @error('type') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="basic-icon-default-fullname">Shop Bio</label>
                                <textarea class="form-control" wire:model.defer="shop_description"></textarea>
                                @error('shop_description') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        @if($editMode == true)
                            <button wire:click.prevent="update()"  class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Edit</button>
                        @else
                            <button wire:click.prevent="store()"  class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Create</button>
                        @endif
                        <button type="reset" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
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
            var input = document.getElementById('location');

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
