<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Section extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name', 'slug'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

         static::creating(function ($section) {
            if (!$section->slug) {
                $section->slug = Str::slug($section->name);
            }
        });
    }

     public function page()
    {
        return $this->hasOne(Page::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
