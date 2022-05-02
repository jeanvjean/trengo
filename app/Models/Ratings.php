<?php

namespace App\Models;
use App\Models\Posts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'post_id',
        'ip_address'
    ];

    protected $cast = [
        'rate'=>'integer'
    ];

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
