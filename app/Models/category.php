<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['name'];

    /**
     * Relasi satu ke banyak dengan model Book
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}