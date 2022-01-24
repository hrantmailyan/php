<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function page() {
        return $this->belongsTo(Page::class);
    }
    public function child_comments() {
        return $this->hasMany(Comment::class,'parent_id');
    }
}
