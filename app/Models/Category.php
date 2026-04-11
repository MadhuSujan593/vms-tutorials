<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['name', 'slug', 'description', 'icon', 'is_blog'];

    protected $casts = [
        'is_blog' => 'boolean',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function tutorials()
    {
        return $this->hasMany(Tutorial::class)->orderBy('sort_order');
    }

    public function relatedCategories()
    {
        return $this->belongsToMany(Category::class, 'related_categories', 'category_id', 'related_id');
    }
}
