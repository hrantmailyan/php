<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sequance'
    ];

    public function pages() {
        return $this->belongsToMany(Page::class,'page_category');
    }
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('banned', function (Builder $builder) {
            $builder->orderBy('sequance', 'desc');

        });
    }
}
