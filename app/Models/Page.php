<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'sequance',
        'published'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class,'page_category');
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('banned', function (Builder $builder) {
            $builder->orderBy('sequance', 'desc');
            if (!Auth::user()) {
                $builder->where('published', true);
                
            }
        });
    }
    public function comments() {
        return $this->hasMany(Comment::class)->where('parent_id',0)->with('child_comments')->with('user');
    }
    
}
