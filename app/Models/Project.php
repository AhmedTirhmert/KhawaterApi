<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

/**
 * Get all of the notes for the Project
 *
 */



 protected $fillable = [
     'owner',
     'name'
 ];
public function Notes()
{
    return $this->hasMany(Note::class);
}
}
