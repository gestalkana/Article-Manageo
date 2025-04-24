<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable = ['titre', 'contenu','author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

}
