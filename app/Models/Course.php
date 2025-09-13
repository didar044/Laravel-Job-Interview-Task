<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [
        'title',
        'feature_video',
        'level',
        'category',
        'price',
        'summary',
        'feature_image',
    ];

  public function modules()
    {
        return $this->hasMany(Module::class);
    }

}

