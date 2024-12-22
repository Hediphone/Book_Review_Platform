<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    // Define the table name (optional if you follow Laravel's conventions)
    protected $table = 'replies';

    // Mass assignable attributes
    protected $fillable = [
        'review_id',  // Foreign key to the review
        'user_id',    // Foreign key to the user
        'comment',    // Reply content
    ];


    // A reply belongs to a review
   
    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }

    // A reply belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
