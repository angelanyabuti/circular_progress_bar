<div>
    <div class="row">
        <div class="col-xl-4 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-info p-50 mb-1">
                        <div class="avatar-content">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye font-medium-5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder">{{ Auth::user()->balanceFloat }}</h2>
                    <p class="card-text">Balance</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar bg-light-info p-50 mb-1">
                        <div class="avatar-content">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye font-medium-5"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </div>
                    </div>
                    <h2 class="font-weight-bolder">{{ Auth::user()->balanceFloat }}</h2>
                    <p class="card-text">Accessible Balance</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="table-hover-animation">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Transactions</h4>
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
{{--                            <input wire:model.debounce.300ms="search" type="text" class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0" id="filter-text-box" placeholder="Search....">--}}
{{--                            <div class="btn-export">--}}
{{--                                <button  data-toggle="modal" data-target="#depositModal" class="btn btn-primary ag-grid-export-btn waves-effect waves-float waves-light mr-1">Deposit</button>--}}
{{--                            </div>--}}
                            <div class="btn-export">
                                <button  data-toggle="modal" data-target="#withdrawModal" class="btn btn-primary ag-grid-export-btn waves-effect waves-float waves-light">Withdraw</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Auth::user()-> transactions -> reverse() as $item)
                            <tr>
                                <td>{{ $item -> amount /100}} </td>
                                <td>{{ $item -> type }}</td>
                                <td>{{ $item -> confirmed ? 'Success': 'Pending' }}</td>
                                <td>{{ $item -> created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div  wire:ignore.self class="modal fade text-left" id="depositModal" tabindex="-1" aria-labelledby="myModalLabel4"
          style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-8 mx-auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Amount</label>
                                    <input wire:model.defer="amount" type="text" class="form-control"/>
                                    @error('amount') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="mt-3">
                        <button wire:click.prevent="deposit()"  data-dismiss="modal"
                                class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">Deposit
                        </button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div  wire:ignore.self class="modal fade text-left" id="withdrawModal" tabindex="-1" aria-labelledby="myModalLabel4"
          style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-8 mx-auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="basic-icon-default-fullname">Amount</label>
                                    <input wire:model="amount" type="text" class="form-control"/>
                                    @error('amount') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <div class="mt-3">
                        <button wire:click.prevent="withdraw()"  data-dismiss="modal"
                                class="btn btn-primary mr-1 data-submit waves-effect waves-float waves-light">WIthdraw
                        </button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
