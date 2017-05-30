<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Exception;

class Set extends Model
{
    protected $fillable = [
        'name', 'url_cards'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function cards()
    {
        return $this->hasMany('App\Models\Card');
    }

    public static function add($name, $url_cards)
    {
        DB::beginTransaction();
        try {
            Set::create([
                'name' => $name,
                'url_cards' => $url_cards
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }
}
