<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {

            if ($notifiable -> type == 'merchant')
            {
                return (new MailMessage)
                    ->line('We are excited to have you get started.
                                First, you need to confirm your Merchant Validating Account,
                                just click the link below.')
                    ->action('Confirm Link', $url)
                    ->line('*********************************')
                    ->line('On successful Signup, save the KouponZetu App on your
                                homepage for ease of access by clicking on the three buttons
                                at the right-hand corner, then select Add to Home Screen')
                    ->line('If you have any questions, just reply to this email – we’re always happy to help out.')
                    ->line('For support related matters; support@kouponzetu.com or +254 719 600875.')
                    ->line('Cheers')
                    ->line('The Feel the Deals Team');
            }elseif ($notifiable -> type == 'customer')
            {
                return (new MailMessage)
                    ->line('We all love good deals! We are Happy you decided to
                            join the KouponZetu Family. KouponZetu was built
                            to create a trustworthy home for you to
                            find all the deals you need, and a platform for
                            Individuals, Businesses and Professional Service Providers

                            to connect and reward their customers.
                            Good things are coming your way;
                            special offers, cash backs and more.
                            Are you ready to Feel the Deals?')
                    ->action('Confirm Link', $url)
                    ->line('Cheers')
                    ->line('The Feel the Deals Team');
            }

        });
    }
}
