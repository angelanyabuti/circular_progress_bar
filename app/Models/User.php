<?php

namespace App\Models;


use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Interfaces\WalletFloat;

use Bavix\Wallet\Traits\HasWalletFloat;
use Bavix\Wallet\Traits\HasWallets;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Rinvex\Subscriptions\Models\Plan;
use Rinvex\Subscriptions\Models\PlanSubscription;
use App\Services\Period;
use Rinvex\Subscriptions\Traits\HasSubscriptions;

class User extends Authenticatable implements Wallet, WalletFloat, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use HasSubscriptions;
    use HasWalletFloat, HasWallets;

    protected $guarded = [];

    /**
     * Route notifications for the Africas Talking channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForAfricasTalking($notification)
    {

        return '254'.substr($this->phone_number, -9);;
    }

    public function scopeSearch($query, $search) {
        return $query
            ->where('id', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('first_name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhere('phone_number', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%');
    }

    public function scopeDate($query, $search) {
        return $query
            ->whereBetween('created_at', [$search['from'], $search['to']]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'phone_number',
        'dob',
        'email',
        'type',
        'password',
        'company_id',
        'profession',
        'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getNameAttribute($value)
    {
        if ($value == null)
        {
            return $this->first_name . ' '. $this->last_name;
        }
        return $value;

    }

    public function shop()
    {
        return $this->hasMany(Shop::class);
    }

    public function rider()
    {
        return $this->hasOne(Rider::class);
    }

    public function companyRole()
    {
        return $this->belongsTo(CompanyRole::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class)->withDefault([
            'name'=>'default',
            'emial'=>'default',
        ]);
    }

    public function hasAccess($permission)
    {
        $admin = [
            '*'
        ];
        if ($this -> companyRole -> permissions == $admin)
        {
            return true;
        }

        if (in_array($permission,$this -> companyRole -> permissions))
        {
            return true;
        }
        return  false;
    }

    public function newSubscription($subscription, Plan $plan, Carbon $startDate = null): \Illuminate\Database\Eloquent\Model
    {
        $trial = new Period($plan->trial_interval, $plan->trial_period, $startDate ?? now());
        $period = new Period($plan->invoice_interval, $plan->invoice_period, $trial->getEndDate());

        return $this->subscriptions()->create([
            'name' => $subscription,
            'plan_id' => $plan->getKey(),
            'trial_ends_at' => $trial->getEndDate(),
            'starts_at' => $period->getStartDate(),
            'ends_at' => $period->getEndDate(),
        ]);
    }
}
