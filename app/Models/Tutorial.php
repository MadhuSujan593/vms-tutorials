<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tutorial extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['category_id', 'title', 'slug', 'content', 'is_published', 'sort_order'];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
