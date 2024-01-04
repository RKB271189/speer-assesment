<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'note_user', 'note_id', 'user_id');
    }
}
