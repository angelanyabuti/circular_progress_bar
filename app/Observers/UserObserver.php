<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\AccountCreated;
use App\Notifications\NewMerchant;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
//        if ($user ->type == 'customer')
//        {
//             $user->createWallet([
//                'name' => 'Peck Wallet',
//            ]);
//            $token = app('auth.password.broker')->createToken($user);
//            $url = route('password.reset', $token);
//            $user ->notify( new AccountCreated($url));
//        }elseif ($user ->type == 'merchant')
//        {
//            $token = app('auth.password.broker')->createToken($user);
//            $url = route('password.reset', $token);
//            $user ->notify( new NewMerchant($url));
//        }


    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
