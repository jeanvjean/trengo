<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Likes;
use App\Models\Ratings;
use App\Models\Categories;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'content',
        'views',
        'average_rating'
    ];

    protected $cast = [
        'rating' => 'integer',
        'views' => 'integer',
    ];

    public function category() {
        return $this->belongsTo(Categories::class);
    }

    public function like() {
        return $this->hasMany(Likes::class);
    }

    public function rate() {
        return $this->hasMany(Ratings::class);
    }
}
