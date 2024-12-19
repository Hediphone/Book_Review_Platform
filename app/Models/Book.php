<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    public $primaryKey = 'bookID';

    public $timestamps = true;

    // Define the one-to-many relationship with Review
    public function reviews()
    {
        return $this->hasMany(Review::class, 'bookID');  // The 'bookID' is the foreign key in the 'reviews' table
    }
    
}
