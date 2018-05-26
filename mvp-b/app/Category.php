<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;

    public $translationModel = CategoryTranslation::class;

    public $translatedAttributes = [
        'name',
    ];

    protected $fillable = [
        'name',
        'image_url',
    ];

    protected $with = ['translations'];

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
