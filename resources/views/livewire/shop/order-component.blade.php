<div class="container card">

    <div class="col-lg-12 card-body">
        <h4 class="mt-2">Get The deal</h4>

        <form>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="billing-first-name" class="form-label">First Name</label>
                        <input wire:model.defer="first_name" class="form-control" type="text" placeholder="Enter your first name" id="billing-first-name">
                        @error('first_name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="billing-last-name" class="form-label">Last Name</label>
                        <input wire:model.defer="last_name"  class="form-control" type="text" placeholder="Enter your last name" id="billing-last-name">
                        @error('last_name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div> <!-- end row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="billing-email-address" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input wire:model.defer="email"  class="form-control" type="email" placeholder="Enter your email" id="billing-email-address">
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="billing-phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input wire:model.defer="phone"  class="form-control" type="text" placeholder="(xx) xxx xxxx xxx" id="billing-phone">
                        @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div> <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="billing-address" class="form-label">Address</label>
                        <input wire:model.defer="address"  class="form-control" type="text" placeholder="Enter full address" id="billing-address">
                        @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div> <!-- end row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="billing-town-city" class="form-label">Town / City</label>
                        <input wire:model.defer="city"  class="form-control" type="text" placeholder="Enter your city name" id="billing-town-city">
                        @error('city') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div> <!-- end row -->


            <div class="row mt-4 mb-3">

                <div class="col-sm-6">
                    <div class="text-sm-end">
                        <a wire:click.prevent="order()"  href="#" class="btn btn-danger">
                            <i class="mdi mdi-truck-fast me-1"></i> Proceed to Pay </a>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </form>
    </div>

    <div wire:ignore.self class="modal fade" id="payModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pay Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Mpesa Number</label>
                            <input wire:model.lazy="mpesa_number" type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Number used for Mpesa Push.</div>
                            @error('mpesa_number') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <button wire:click.prevent="pay()" type="submit" class="btn btn-primary">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
