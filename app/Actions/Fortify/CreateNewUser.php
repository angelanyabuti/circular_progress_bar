<?php

namespace App\Actions\Fortify;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Rules\Password;
use Rinvex\Subscriptions\Models\Plan;

class CreateNewUser implements CreatesNewUsers
{


    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' =>  "required|unique:users",
            'phone_number' => [
                'required',
                'min:10',
                'max:13',
                Rule::unique('users'),
            ],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ])->validate();

        if ($input['type'] === 'customer') {
            Validator::make($input, [
                'profession' => ['required', 'string', 'max:255']
            ])->validate();
        }


        if ($input['type'] === 'merchant') {
            $company = new Company();
            $company->name = $input['company_name'];
            $company->email = $input['company_email'];
            $company->phone =$input['company_phone'];
            $company->website = $input['company_website'];
            $company->save();
        }

        $user =  User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'] ,
            'type' => $input['type'],
            'company_id' => $company->id ?? null,
            'profession' => $input['profession'] ?? 'professional',
            'graduation_yr' => $input['graduation_yr'] ?? null,
            'password' => Hash::make($input['password']),
        ]);

        if ($input['type'] === 'merchant')
        {
            $plan = Plan::find($input['plan']);

            $user->plan_id = $plan->id;
            $user->save();

            if (!$plan->isFree()) {
                $inv = new \App\Models\Invoice();
                $inv->customer_id = $user->id;
                $inv->amount = $plan->price;
                $inv->plan_id = $plan->id;
                $inv ->save();
            } else {
                $user->newSubscription($plan->name . ' - ' . 'Main', $plan);
            }
        }

        return $user;
    }
}
