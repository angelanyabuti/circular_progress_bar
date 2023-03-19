<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purchased Deals</h4>
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
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Product Type</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item -> product -> default_image ?? '' }}" class="mr-75" height="20" width="20" alt="Angular">
                                    <span class="font-weight-bold">{{ $item -> product -> name ?? '' }}</span>
                                </td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> product -> type }}</span></td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> order -> customer -> name }}</span></td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> status }}</span></td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> quantity }}</span></td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> sub_total }}</span></td>
                                <td>
                                    @if($item -> product -> type == 'product')

                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow waves-effect waves-float waves-light" data-toggle="dropdown">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#assignRider" wire:click="edit({{ $item->id }})" >
                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                    <span>Assign Rider</span>
                                                </a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#addToBatch"  wire:click="setActive({{ $item->id }})">
                                                    <i data-feather="trash" class="mr-50"></i>
                                                    <span>Add To Batch</span>
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#orderModal" wire:click="edit({{ $item }})" >
                                            <i data-feather="edit-2" class="mr-50"></i>
                                            <span>Validate</span>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div  wire:ignore.self class="modal fade text-left" id="orderModal" tabindex="-1" aria-labelledby="myModalLabel4"
          style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">Order</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Code</label>
                                    <input wire:model="code" class="form-control" name="code">
                                    @error('code') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="mt-3">
                        <button wire:click.prevent="update()"
                                class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Validate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div  wire:ignore.self class="modal fade text-left" id="addToBatch" tabindex="-1" aria-labelledby="myModalLabel4"
          style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">Add To Batch</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Batch</label>
                                    <select wire:model="batch" class="form-control">
                                        <option value="">Select Batch</option>
                                        @foreach($batches as $item)
                                            <option value="{{ $item -> id }}"> {{ $item -> name }}</option>
                                        @endforeach
                                    </select>
                                    @error('code') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="mt-3">
                        <button wire:click.prevent="addToBatch()"
                                class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  wire:ignore.self class="modal fade text-left" id="assignRider" tabindex="-1" aria-labelledby="myModalLabel4"
          style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">Assign Rider</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Assign Rider</label>
                                    <select wire:model="rider" class="form-control">
                                        <option value="">Select Rider</option>
                                        @foreach($riders as $der)
                                            <option value="{{ $der -> id }}"> {{ $der -> user -> name }}</option>
                                        @endforeach
                                    </select>
                                    @error('rider') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div class="mt-3">
                        <button wire:click.prevent="assignRider()"
                                class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Assign
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
