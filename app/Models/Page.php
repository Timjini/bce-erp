<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name', 'category_id', 'title', 'slug', 'content', 'full_slug'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
    
        public function getFullSlugAttribute(): string
    {
        $sectionSlug  = $this->category?->section?->slug ?? '';
        $categorySlug = $this->category?->slug ?? '';
        $pageSlug     = $this->slug ?? '';

        // Build path dynamically
        if ($sectionSlug && $categorySlug && $pageSlug) {
            return "/{$sectionSlug}/{$categorySlug}/{$pageSlug}";
        }

        if ($categorySlug && $pageSlug) {
            return "/{$categorySlug}/{$pageSlug}";
        }

        return "/{$pageSlug}";
    }

     public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
