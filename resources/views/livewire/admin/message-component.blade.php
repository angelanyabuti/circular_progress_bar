<div>
    <div class="row" id="table-hover-animation">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Messages</h4>
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
                            <th>Title</th>
                            <th>Body</th>
                            <th>Schedule</th>
                            <th>Channel</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{ $item -> title }} </td>
                                <td>{{ $item -> body }}</td>
                                <td>{{ $item -> send_time }}</td>
                                <td>  @foreach($item->channel as $chan)
                                        <span class="px-2 py-1 font-semibold leading-tight  rounded-full">{{ $chan }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal" wire:click="edit({{ $item }})" >
                                                <i data-feather="edit-2" class="mr-50"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" wire:click="send({{ $item }})">
                                                <i data-feather="message" class="mr-50"></i>
                                                <span>Send</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Messages</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname"> Title </label>
                        <input wire:model.defer="title" type="text" class="form-control" />
                        @error('title') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname"> Send Time </label>
                        <input wire:model.defer="send_time" type="datetime-local" class="form-control" />
                        @error('send_time') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname"> Message </label>
                        <textarea class="form-control" wire:model="body"></textarea>
                        @error('body') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname"> Channels </label><br>
                        @foreach($channels as $perm)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" wire:model="channel.{{$perm}}" value="{{ $perm }}">
                                <label class="form-check-label ">{{ $perm }}</label>
                            </div>
                        @endforeach

                    </div>

                    <div class="mt-3">
                        <button wire:click.prevent="save()"  class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Submit</button>
                        <button wire:click.prevet="resetAll()" type="reset" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
