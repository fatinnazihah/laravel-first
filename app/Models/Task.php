<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // This allows Laravel to save these specific fields to the database
    protected $fillable = ['title', 'is_completed'];
}