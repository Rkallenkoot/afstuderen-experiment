<?php

namespace App;

use App\Category;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use Translatable;

    public $translationModel = BookTranslation::class;

    public $translatedAttributes = [
        'title',
        'description',
    ];

    protected $fillable = [
        'isbn',
        'eISBN',
        'publisher_id',
    ];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
