<div>
    <div class="row" id="table-hover-animation">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Subscription </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control">
                                <option>15</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="col-md-8 d-flex  justify-content-end">
                            <input wire:model.debounce.300ms="search" type="text" class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0" id="filter-text-box" placeholder="Search....">
{{--                            <div class="btn-export">--}}
{{--                                <button  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary ag-grid-export-btn waves-effect waves-float waves-light">New Role</button>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Merchant</th>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Start</th>
                            <th>End</th>
{{--                            <th>Actions</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscriptions as $item)
{{--                            @dd($item -> subscriber()->name)--}}
                            <tr>
                                <td>{{$item -> subscriber -> email ?? '' }}</td>
                                <td>{{ $item -> plan -> name }}</td>
                                <td>{{ $item -> plan -> price }}</td>
                                <td>{{ $item -> starts_at }}</td>
                                <td>{{ $item -> ends_at }}</td>
{{--                                <td>--}}
{{--                                    <div class="dropdown">--}}
{{--                                        <button type="button" class="btn btn-outline-primary dropdown-toggle waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                            Action--}}
{{--                                        </button>--}}
{{--                                        <div class="dropdown-menu">--}}
{{--                                            <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal" wire:click="edit({{ $item->id }})" >--}}
{{--                                                <i data-feather="edit-2" class="mr-50"></i>--}}
{{--                                                <span>Edit</span>--}}
{{--                                            </a>--}}
{{--                                            <a class="dropdown-item" href="javascript:void(0);" wire:click="setActive({{ $item->id }})" onclick="del()">--}}
{{--                                                <i data-feather="trash" class="mr-50"></i>--}}
{{--                                                <span>Delete</span>--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
