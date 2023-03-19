
@extends('layouts.index')

@section('content')
    <section class="section pb-0 bg-dragula">
        <div class="container bg-white">
            <div class="row align-content-center d-flex justify-content-center">
                <div class="col-lg-12 text-center py-5">
                    <h2 class="section-title">Select Account</h2>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg- mb-4 col" style="border-right: #0a0c0d 1px solid">
                    <div class="hover-bg-primary text-center position-relative px-4 py-5 rounded-lg ">
                        <img src="{{ asset('images/image5.png') }}" class="img-fluid" alt="feature-image">
                        <h5 class="pt-5 text-capitalize card-title">I want Deals</h5>
                        <p class="pb-3 text-capitalize card-title">(Member)</p>
                        <p class="mb-4">
                            Save Money with easy-to-redeem Coupons
                            from a nearby business. <br>
                            Earn Perks to receive rewards, discounts and more.
                        </p>
                        <a class="btn btn-outline-success" href="{{ route('auth.member') }}" data-abc="true">Register</a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 mb-lg- mb-4 col">
                    <div class="hover-bg-primary text-center position-relative px-4 py-5 rounded-lg ">
                        <img src="{{ asset('images/deals.png') }}" class="img-fluid" alt="feature-image" style="max-height: 204px">
                        <h5 class="pt-5 text-capitalize card-title">I have deals</h5>
                        <p class=" pb-3 text-capitalize card-title">(Merchant)</p>
                        <p class="mb-4">
                            Wow Customers <br>
                            Connect Deals <br>
                            Special Offers <br>
                            Reward Brand Loyalty

                        </p>
                        <a class="btn btn-outline-success" href="{{ route('auth.plans') }}" data-abc="true">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
