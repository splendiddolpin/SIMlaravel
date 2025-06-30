<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    // This assumes that the column for the penalty is named 'denda'
    protected $fillable = ['return_days', 'denda']; // Add any other columns you want to be fillable

    // Optionally, if you want to specify the table name (if it's not 'settings')
    protected $table = 'settings';  
}