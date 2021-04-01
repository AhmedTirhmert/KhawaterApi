<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable=[
        'title',
        'body',
        'public',
        'category_id',
        'project_id',
        'author_id',
    ];
    /**
     * Get the user that owns the Note
     *
     * 
     */
    
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function Project()
    {
        return $this->belongsTo(Project::class);
    }
    public function Author()
    {
        return $this->belongsTo(User::class);
    }
}
