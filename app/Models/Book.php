<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'copies',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
