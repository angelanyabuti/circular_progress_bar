<x-guest-layout>

    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-3" />

        <div class="card-body">

            <livewire:cashier-dashbaord />
        </div>
    </x-jet-authentication-card>

{{--    <x-slot name="header">--}}
{{--        <h2 class="h4 font-weight-bold">--}}
{{--            {{ __('Cashier') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}




</x-guest-layout>
