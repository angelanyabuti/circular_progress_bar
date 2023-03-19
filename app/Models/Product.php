<?php

namespace App\Models;


use App\Traits\LastMedia;
use App\Traits\Reviewable;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model implements HasMedia
{
    use HasFactory, Reviewable;

    use HasSlug;
    use InteractsWithMedia;
    use LastMedia;
    protected $guarded = [];

//    protected static function boot()
//    {
//        parent::boot();
//        return static::addGlobalScope(new ActiveProduct());

//    }

    public function scopeActive($query) {
        return $query ->whereDate('start_date', '<=', now())->whereDate('end_date','>=', now());
    }

    protected $appends = ['default_image','large_image'];
    protected $casts = [
        'end_date' => 'datetime:Y-m-d H:00',
        'start_date' => 'datetime:Y-m-d H:00',
    ];


    public function getExpAttribute()
    {
        $diff = now()->diffInSeconds($this->end_date);
        if ($this -> end_date > now())
        {
            return $this->seconds2human($diff);
//            return $this->tim($diff);
        }
      return  'Expired';
    }

    function seconds2human($ss) {
        $s = $ss%60;
        $m = floor(($ss%3600)/60);
        $h = floor(($ss%86400)/3600);
        $d = floor(($ss%2592000)/86400);
        $M = floor($ss/2592000);

//        return "$M m, $d d, $h h, $m m, $s s";
        return " $d d, $h h, $m m";
    }

//    public function tim($ss)
//    {
//        $uptime = gmdate("y m d H:i:s", $ss); $uptimeDetail = explode(" ",$uptime); echo (string)($uptimeDetail[0]-70).' year(s) '.(string)($uptimeDetail[1]-1).' month(s) '.(string)($uptimeDetail[2]-1).' day(s) '.(string)$uptimeDetail[3];
//
//        return $uptime;
//    }


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
                ->orWhere('description', 'like', '%'.$search.'%')
            ;
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function getStatusAttribute()
    {
        $exp = $this->end_date;
        if ($exp >= now())
        {
            return 'Active';
        }
        return  'Expired';
    }

    public function getDefaultImageAttribute()
    {
        $url = $this->getLastMediaUrl('product');
        if ($url != null)
        {
            return $url;
        }
        return asset('default.jpeg');
    }
    public function getLargeImageAttribute()
    {
        $url = $this->getFirstMediaUrl('product');
        if ($url != null)
        {
            return $url;
        }
        return asset('default.jpeg');

    }

    public function company()
    {
        return $this->shop()->company;
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class,'product_id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id')->withDefault([
            'name'=>''
        ]);
    }
}
