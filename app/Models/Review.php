<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $primaryKey = 'reviewID';  // Change this if your primary key is not 'id'


    public $timestamps = true;

    // Define the inverse of the one-to-many relationship with Book
    protected $fillable = ['userID', 'bookID', 'rating', 'comment'];

    
     // Define the relationship for replies

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'review_id');  // 'review_id' is the foreign key in the replies table
    }


    public function book()
    {
        return $this->belongsTo(Book::class, foreignKey: 'bookID');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'bookID');
    }

}