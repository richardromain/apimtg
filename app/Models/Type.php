<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $attributes = [
        'name'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function cards()
    {
        return $this->belongsToMany('App\Models\Card');
    }
}
