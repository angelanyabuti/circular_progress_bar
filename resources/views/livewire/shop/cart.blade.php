<div>
    <div class="row mx-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <!--start of changes-->
                            
                   
                            
                            <div class="table-responsive">
                                <table class="table table-borderless table-centered mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th style="width: 50px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>
                                                <p class="m-0 d-inline-block align-middle font-16">
                                                    <a href="#" class="text-body">{{ $item -> product -> name }}</a>
                                                </p>
                                            </td>
                                            <td>
                                              Kes  {{ $item -> price }} 
                                                
                                            </td>
                                            <td>
                                                
                                                {{ $product -> quantity }}
                                            </td>
                                            <td>
                                                {{ $product -> getPriceSum() }}
                                            </td>
                                            <td>
                                                <a wire:click="delete({{$product->id}})" href="#" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->


                            <!-- action buttons-->
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{ url('/') }}" class="btn btn-warning  d-none d-sm-inline-block btn-link fw-semibold">
                                        <i class="mdi mdi-arrow-left"></i> Continue Shopping </a>
                                </div> <!-- end col -->
                                <!--button to add product-->
                                <div class="center">
    
                 <!--checkout-->
                                <div class="col-sm-6">
                                    <div class="text-sm-end">
                                        <a href="{{ route('checkout') }}" class="btn btn-danger">
                                            <i class="mdi mdi-cart-plus me-1"></i> Checkout </a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div>
                        <!-- end col -->


                    </div> <!-- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>

