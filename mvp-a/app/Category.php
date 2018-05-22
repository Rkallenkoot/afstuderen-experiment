<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    protected $translatable = [
        'name',
    ];

    protected $fillable = [
        'name',
        'image_url',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function scopeChildCategories($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function isParent()
    {
        return $this->parent_id !== null;
    }

}
