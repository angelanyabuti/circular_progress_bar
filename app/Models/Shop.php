<?php

namespace App\Models;

use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallets;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Shop extends Model implements Wallet
{
    use HasFactory, Notifiable;
    use HasWallet, HasWallets;
    use HasSlug;

    protected $appends = ['log'];

    protected $guarded = [];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%')
            ;
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id')->withDefault([
            'name'=>'default',
            'emial'=>'default',
        ]);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class)->withDefault([
            'name' => ''
        ]);
    }

    public function getStatusAttribute()
    {
        if ($this->active ==  false)
        {
            return 'Inactive';
        }
        return 'Active';
    }

    public function getLogAttribute()
    {
        if ($this->logo != null)
        {

            return asset('storage/'.$this ->logo);
        }
        return 'https://source.unsplash.com/random/200*250';
    }
}
