<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
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
