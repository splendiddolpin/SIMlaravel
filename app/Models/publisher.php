<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    /**
     * Define the relationship between Publisher and Book
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}