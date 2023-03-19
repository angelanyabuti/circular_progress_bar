<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="row py-4">
            <div class="col-md-6 text-center mt-5">
                <h2>
                    Grow Your Brand for Kes 200/Month
                </h2>
                <p>
                    Kouponzetu connect merchants and individuals  to customers with products and services packaged as
                    DEALS, BARGAINS and DISCOUNTS.
                </p>
                <P>
                    We champion brands and bring them  into the spotlight by enhancing repetitive customer traffic and
                    tailored "wow effect".
                </P>
            </div>
            <div class="col-md-6">
                <div class="card-body">

                    <x-jet-validation-errors class="mb-3 rounded-0" />

                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <x-jet-label value="{{ __('Email') }}" />

                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                         name="email" :value="old('email')" required />
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <x-jet-label value="{{ __('Password') }}" />

                            <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                         name="password" required autocomplete="current-password" />
                            <x-jet-input-error for="password"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <x-jet-checkbox id="remember_me" name="remember" />
                                <label class="custom-control-label" for="remember_me">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="mb-2">
                            <div class="d-flex justify-content-end align-items-baseline">
                                <button class="btn btn-success btn-block">{{ __('Log in') }}</button>
                            </div>
                        </div>

                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="text-muted mr-3" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="divider my-2">
                            <div class="divider-text">or</div>
                        </div>
                        <div class="mb-0">
                            <div class="auth-footer-btn d-flex justify-content-center">
                                <a href="{{ route('register') }}" class="btn btn-warning waves-effect waves-float waves-light">
                                    Register
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </x-jet-authentication-card>
</x-guest-layout>


@section('page-script')
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('/js/scripts/pages/page-auth-login.js')) }}"></script>
@endsection
