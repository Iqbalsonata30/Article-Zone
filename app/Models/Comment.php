<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function articles()
    {
        return $this->belongsTo(Article::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
