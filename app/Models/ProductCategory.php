<?php

namespace App\Models;

use App\Traits\LastMedia;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductCategory extends Model implements HasMedia
{
    use HasFactory, Uuid;
    use HasSlug;
    use InteractsWithMedia;
    use LastMedia;

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

    public function parent()
    {
       return $this->belongsTo(ProductCategory::class)->withDefault([
           'name'=> 'N/A'
       ]);
    }

    public function kids()
    {
        return ProductCategory::where('parent_id', $this->id)->get();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImgAttribute()
    {
        if ($this->image == null)
        {
            return 'https://source.unsplash.com/1600x900/?fashion,fabric';
        }
        return asset('storage/'.$this ->image);
    }
}
