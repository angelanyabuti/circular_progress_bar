<div>
    <div class="row" id="table-hover-animation">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product/Deal Types</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control" wire:model="perPage">
                                <option>10</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="col-md-8 d-flex  justify-content-end">
                            <input wire:model.debounce.300ms="search" type="text" class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0" id="filter-text-box" placeholder="Search....">
                            <div class="btn-export">
                                <button  data-toggle="modal" data-target="#dealModal" class="btn btn-primary ag-grid-export-btn waves-effect waves-float waves-light">New Category</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Category Image</th>
                            <th>Category Name</th>
                            <th>Parent</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item->img }}" class="mr-75" height="20" width="20" alt="{{ $item -> name }}">
                                </td>
                                <td>{{ $item -> name}} </td>
                                <td>{{ $item -> parent -> name}} </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#dealModal" wire:click="edit({{ $item->id }})" >
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
    <div wire:ignore.self  class="modal modal-slide-in new-user-modal fade" id="dealModal">
        <div class="modal-dialog">
            <form class="add-new-user modal-content pt-0">
                <button wire:click.prevet="resetAll()" type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Category Form</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Name</label>
                        <input wire:model.defer="name" type="text" class="form-control" />
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Parent (if a sub category)</label>
                        <select wire:model.defer="parent" class="form-control">
                            <option value="{{ null }}">select Parent Category </option>
                            @foreach($categories as $parent)
                                <option value="{{ $parent -> id }}">{{ $parent -> name }}</option>
                            @endforeach
                        </select>
                        @error('parent') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Description</label>
                        <textarea wire:model.defer="description" type="text" class="form-control"> </textarea>
                        @error('description') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <div class="border rounded p-2">
                            <h4 class="mb-1">Category Image</h4>
                            <div class="media flex-column">
                                @if($image != null)
                                    <img src="{{ $image -> temporaryUrl()}}" id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0" width="170" height="110" alt="Blog Featured Image">
                                @endif
                                <div class="media-body">
                                    <small class="text-muted">Required image resolution 800x400, image size 10mb.</small>
                                    <div class="d-inline-block">
                                        <div class="form-group mb-0">
                                            <div class="custom-file">
                                                <input wire:model="image" type="file" class="custom-file-input" id="blogCustomFile" accept="image/*">
                                                <label class="custom-file-label" for="blogCustomFile">Choose Image</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('image') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    @if($editMode == true)
                        <div class="row">
                            <label class="form-label" for="basic-icon-default-fullname">Existing Images</label>
                            <div class="col-md-4 col-6 profile-latest-img">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('storage/'.$active ->img) }}" class="img-fluid rounded" alt="avatar img">
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
</div>
