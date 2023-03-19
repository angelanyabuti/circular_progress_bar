<div>
    <div wire:ignore.self class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center px-4"><img class="login-intro-img" src="img/bg-img/36.png" alt=""></div>
                            <!-- Register Form -->
                            <div class="register-form mt-4">
                                <h6 class="mb-3 text-center">Register to continue to Kouponzetu.</h6>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Name') }}" />

                                        <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                                     :value="old('name')"  autofocus autocomplete="name" />
                                        <x-jet-input-error for="name"></x-jet-input-error>
                                    </div>
                                    <input type="hidden" name="type" value="customer" >

                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Email') }}" />

                                        <x-jet-input  class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                                      :value="old('email')"  />
                                        <x-jet-input-error for="email"></x-jet-input-error>
                                    </div>
                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Phone Number') }}" />

                                        <x-jet-input  class="{{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number"
                                                      :value="old('phone_number')"  />
                                        <x-jet-input-error for="phone_number"></x-jet-input-error>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="basic-icon-default-fullname">Occupation </label>
                                        <select  name="profession" class="form-control" wire:model="profession" >
                                            <option value="professional"> Professional  </option>
                                            <option value="student">Student</option>
                                        </select>
                                        @error('profession') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>

                                    @if($profession == 'student')
                                        <div class="form-group">
                                            <x-jet-label value="{{ __('Expected Graduation year') }}" />

                                            <select  name="graduation_yr" class="form-control">
                                                @for ($i = date('Y'); $i < date('Y') + 7; $i++)
                                                    <option > {{ $i }}  </option>
                                                @endfor

                                            </select>
                                            <x-jet-input-error for="graduation_yr"></x-jet-input-error>
                                        </div>
                                    @endif



                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Password') }}" />

                                        <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                                     name="password"  autocomplete="new-password" />
                                        <x-jet-input-error for="password"></x-jet-input-error>
                                    </div>

                                    <div class="form-group">
                                        <x-jet-label value="{{ __('Confirm Password') }}" />

                                        <x-jet-input class="form-control" type="password" name="password_confirmation"  autocomplete="new-password" />
                                    </div>
                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div class="form-group">
                                            <p>
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

                                            <x-jet-button>
                                                {{ __('Register') }}
                                            </x-jet-button>
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
    </div>
</div>
