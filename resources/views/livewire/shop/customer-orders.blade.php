<div class="container">
    <div class="direction-rtl">

        @if ($message = Session::get('success'))

            <div class="alert alert-info alert-block">

                <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ $message }}</strong>

            </div>

        @endif
        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3">
{{--                    <div class="col-4">--}}
{{--                        <div class="feature-card mx-auto text-center">--}}
{{--                            <div class="card mx-auto bg-gray">{{ $pw->balance }}</div>--}}
{{--                            <p class="mb-0">eWallet balance</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-4">
                        <div class="feature-card mx-auto text-center">
                            <div class="card mx-auto bg-gray">{{ $pw->balance }}</div>
                            <p class="mb-0">Earned Perks</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="feature-card mx-auto text-center">
                            <div class="card mx-auto bg-gray">
                               0
                            </div>
                            <p class="mb-0">Saved Amount</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">My Deals</h4>
        </div>
        <div class="card-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>EXP Date</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Code</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ $item -> product -> default_image  }}" class="mr-75" height="20" width="20" alt="Angular">
                                            <span class="font-weight-bold">{{ $item -> product -> name }}</span>
                                        </td>
                                        <td>{{ $item ->product -> exp }}</td>
                                        <td>{{ $item -> status }}</td>
                                        <td>{{ $item -> quantity }}</td>
                                        <td>{{ $item -> sub_total }}</td>
                                        <td>
                                            {{ $item -> code }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title">My Perks</h4>
        </div>
        <div class="card-body">
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Perks</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions -> reverse() as $item)
                                    <tr>
                                        <td>{{ $item -> amount  }}</td>
                                        <td>{{ $item -> type }}</td>
                                        <td>{{ $item -> created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
