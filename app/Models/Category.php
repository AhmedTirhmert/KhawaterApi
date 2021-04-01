<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

/**
 * Get all of the notes for the category
 *
 */
    protected $fillable=[
        'title',
        'owner'
    ];

    public function Notes()
{
    return $this->hasMany(Note::class);
}
}
