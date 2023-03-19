<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">My Deals and Products</h4>
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
                                <button  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary ag-grid-export-btn waves-effect waves-float waves-light">New</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Shop</th>
                            <th>Status</th>
                            <th>Expiry Date</th>
                            <th>Instock</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $item)
                        <tr>
                            <td>
                                <img src="{{ $item -> default_image }}" class="mr-75" height="20" width="20" alt="Angular">
                                <span class="font-weight-bold">{{ $item -> name }}</span>
                            </td>
                            <td> {{ $item -> category -> name }}</td>
                            <td> {{ $item -> shop -> name }}</td>

                            <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> status }}</span></td>
                            <td>{{ $item -> end_date }}</td>
                            <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> quantity }}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal" wire:click="edit({{ $item->id }})" >
                                            <i data-feather="edit-2" class="mr-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);" wire:click="setActive({{ $item->id }})" onclick="delPro()">
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

    <div  wire:ignore.self class="modal fade text-left" id="exampleModal" tabindex="-1" aria-labelledby="myModalLabel4"
          style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">Deal/ Product Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Deal Tagline</label>
                                    <input wire:model.defer="name" type="text" class="form-control"/>
                                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Category</label>
                                    <select wire:model="category" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category ->id }}">{{ $category -> name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Type</label>
                                    <select class="form-control" wire:model="type">
                                        <option value="">Select</option>
                                        <option value="online">online Coupon</option>
                                        <option value="instore">In-store Coupon</option>
                                        <option value="product">Physical Product</option>
                                    </select>
                                    @error('type') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Quantity</label>
                                    <input wire:model.defer="quantity" type="number" class="form-control"/>
                                    @error('quantity') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            @if($type == 'product')

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Normal Price</label>
                                    <input wire:model.defer="mock_price"  type="number" class="form-control">
                                    @error('mock_price') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Offer Price</label>
                                    <input  wire:model.defer="price" type="number" class="form-control">
                                    @error('price') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            @endif

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Start Time</label>
                                    <input wire:model.defer="start_date" type="datetime-local" class="form-control"/>
                                    @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">End Time</label>
                                    <input wire:model.defer="end_date" type="datetime-local" class="form-control"/>
                                    @error('end_date') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="message" class="control-label">Deal Description</label>
                                <div wire:ignore>
                                    <textarea rows="10" id="description" class="form-control description {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" wire:model="description" autocomplete="off">{!! $description !!}</textarea>
                                    @error('description') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @if($image)
                                <div class="col-md-2 col-3 profile-latest-img">
                                    <a href="javascript:void(0)">
                                        <img src="{{ $image -> temporaryUrl()}}" class="img-fluid rounded" alt="avatar img">
                                    </a>
                                </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <label class="form-label" for="basic-icon-default-fullname">Deal Image</label>
                            <input wire:model.defer="image" type="file" class="form-control" >
                            @error('image') <span class="error">{{ $message }}</span> @enderror
                        </div>


                    </div>
                    <div class="row">
                        @if($editMode == true)
                            @foreach($active -> images as $image)
                                <div class="col-md-2 col-3 profile-latest-img">
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('storage/'.$image->url)}}" class="img-fluid rounded" alt="avatar img">
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="mt-3">
                        @if($editMode == true)
                            <button wire:click.prevent="update()"
                                    class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Edit
                            </button>
                        @else
                            <button wire:click.prevent="store()"
                                    class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Create
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
    <script>
        $(document).ready(function() {

            $('#description').summernote({

                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen',  'help']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                    @this.set('description', contents);
                    },
                codemirror: {
                    theme: 'monokai'
                }
            });

            // $('#description').on('change', function (e) {
            //     console.log("Changed editor");
            // @this.set('description', e.target.value);
            // });

        });


    </script>

@endpush
