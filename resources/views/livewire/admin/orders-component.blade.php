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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item -> product -> default_image }}" class="mr-75" height="20" width="20" alt="Angular">
                                    <span class="font-weight-bold">{{ $item -> product -> name }}</span>
                                </td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> product -> type }}</span></td>
                                <td>
                                    {{ $item -> order -> customer -> name }} <br>
                                    {{ $item -> order -> customer -> phone_number }} <br>
                                    {{ $item -> order -> customer -> email }} <br>
                                </td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> status }}</span></td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> quantity }}</span></td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> sub_total }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
