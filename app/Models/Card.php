<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'name', 'content', 'cost', 'picture'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public static function add($request)
    {
        $card = Card::create([
            'name' => $request->input('name'),
            'content' => $request->input('content'),
            'cost' => $request->input('cost'),
            'picture' => str_slug($request->input('name')).'.'.$request->file('picture')->getClientOriginalExtension()
        ]);

        $request->file('picture')->move(base_path().'/public/pictures/cards/', $card->picture);
    }
}
