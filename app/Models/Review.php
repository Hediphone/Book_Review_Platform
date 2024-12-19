<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['user_id', 'book_id', 'rating', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'bookID');
    }
}
