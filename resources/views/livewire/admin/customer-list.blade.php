<div>
    <div class="row" id="table-hover-animation">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users Table</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <select class="form-control" wire:model="perPage">
                                <option>15</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input wire:model="range" type="text" class="form-control datepicker">
                        </div>
                        <div class="col-md-6 d-flex  justify-content-end">
                            <input wire:model.debounce.300ms="search" type="text" class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0" id="filter-text-box" placeholder="Search....">
                            <div class="btn-export">
                                <button  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary ag-grid-export-btn waves-effect waves-float waves-light">New User</button>
                                <button  wire:click.prevent="export()" class="btn btn-primary ag-grid-export-btn waves-effect waves-float waves-light">Export</button>
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
                            <th>Profession</th>
                            <th>Active</th>
                            <th>DOR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr>
                                <td>{{ $item -> name }} </td>
                                <td>{{ $item -> email }}</td>
                                <td>{{ $item -> phone_number }}</td>
                                <td>{{ $item -> type }}</td>
                                <td>{{ $item -> profession }}</td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input wire:click="toggleActive({{ $item }})" @if($item ->status == 'active') checked @endif type="checkbox" class="custom-control-input" id="{{$item ->id}}">
                                        <label class="custom-control-label" for="{{$item ->id}}">
                                            <span class="switch-text-left">Yes</span>
                                            <span class="switch-text-right">No</span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $item -> created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $users -> links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script>

        $('.datepicker').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
        @this.set('from',  start.format('YYYY-MM-DD'));
        @this.set('to',  end.format('YYYY-MM-DD'));

        });

        $('.datepicker').on('change', function (e) {
        @this.set('range', e.target.value);
        });

    </script>
@endpush
