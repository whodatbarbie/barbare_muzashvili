<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'answers', 'image', 'correct_answer', 'quiz_id', 'position'];
    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}
