<div>
    <div class="">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="text-center px-4"><img class="login-intro-img" src="img/bg-img/36.png" alt=""></div>
                    <!-- Register Form -->
                    <div class="register-form m-4">
                        <h3 class="mb-5 text-center">Merchant Registration</h3>
                        <hr class="mb-5">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <input type="hidden" name="type" value="merchant" >
                            <input type="hidden" name="plan" value="{{ $plan }}" >

                            <div class="row my-3">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Admin Name') }}" class="pb-2"/>

                                        <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                                     :value="old('name')" required autofocus autocomplete="name" />
                                        <x-jet-input-error for="name"></x-jet-input-error>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Admin Email') }}" class="pb-2"/>

                                        <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                                     :value="old('email')"  />
                                        <x-jet-input-error for="email"></x-jet-input-error>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Admin Phone') }}" class="pb-2"/>

                                        <x-jet-input class="{{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number"
                                                     :value="old('phone_number')"  />
                                        <x-jet-input-error for="phone_number"></x-jet-input-error>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Company Name') }}" class="pb-2"/>

                                        <x-jet-input class="{{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name"
                                                     :value="old('company_name')" required autofocus autocomplete="company_name" />
                                        <x-jet-input-error for="company_name"></x-jet-input-error>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Company Email') }}" class="pb-2"/>

                                        <x-jet-input class="{{ $errors->has('company_email') ? 'is-invalid' : '' }}" type="email" name="company_email"
                                                     :value="old('company_email')"  />
                                        <x-jet-input-error for="company_email"></x-jet-input-error>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Company Phone') }}" class="pb-2"/>

                                        <x-jet-input class="{{ $errors->has('company_phone') ? 'is-invalid' : '' }}" type="text" name="company_phone"
                                                     :value="old('company_phone')"  />
                                        <x-jet-input-error for="company_phone"></x-jet-input-error>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Company Website') }}" class="pb-2"/>

                                        <x-jet-input class="{{ $errors->has('company_website') ? 'is-invalid' : '' }}" type="text" name="company_website"
                                                     :value="old('company_website')"  />
                                        <x-jet-input-error for="company_phone"></x-jet-input-error>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Password') }}" class="pb-2"/>

                                        <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                                     name="password"  autocomplete="new-password" />
                                        <x-jet-input-error for="password"></x-jet-input-error>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Confirm Password') }}" class="pb-2"/>

                                        <x-jet-input class="form-control" type="password" name="password_confirmation"  autocomplete="new-password" />
                                    </div>
                                </div>
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="form-group my-4">
                                    <p class="text-center font-18">
                                        {!! __('By clicking register, You agree to the :terms_of_service, :privacy_policy and  :refund_policy', [
                                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                                        'refund_policy' => '<a target="_blank" href="'.route('refund').'">'.__('Refund Policy').'</a>',
                                                ]) !!}
                                    </p>
                                </div>
                            @endif

                            <div class="mb-0">
                                <div class="d-flex justify-content-center align-items-baseline">
                                    <button type="submit" class="btn btn-warning"> {{ __('Register') }}</button>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Login Meta -->
                    <div class="login-meta-data text-center">
                        <p class="mt-3 mb-0">Already have an account? <a class="stretched-link" href="{{ route('login') }}">Login</a></p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
