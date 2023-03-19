<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deals and Products</h4>
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
                            <th>Expiry Date</th>
                            <th>Status</th>
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
                                <td>{{ $item -> end_date }}</td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> status }}</span></td>
                                <td><span class="badge badge-pill badge-light-primary mr-1">{{ $item -> quantity }}</span></td>
                                <td>
                                   <a href="{{ route('single.shop', $item -> shop) }}" class="btn btn-success"> View Shop</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                    {{ $products -> links() }}
                </div>

            </div>
        </div>
    </div>
</div>
