<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    public $primaryKey = 'id';

    public $timestamps = true;

    // Define the inverse of the one-to-many relationship with Book
    public function book()
    {
        return $this->belongsTo(Book::class, 'bookID');
    }
}