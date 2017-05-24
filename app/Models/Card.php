<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;
use DB;
use Exception;

class Card extends Model
{
    protected $fillable = [
        'name', 'content', 'cost', 'picture'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function types()
    {
        return $this->belongsToMany('App\Models\Type');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Models\Color');
    }

    public static function add($request)
    {
        DB::beginTransaction();
        try {
            $card = Card::create([
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'cost' => $request->input('cost'),
                'picture' => str_slug($request->input('name')).'.'.$request->file('picture')->getClientOriginalExtension()
            ]);
            $card->types()->attach($request->input('types'));
            $cards_storage = Storage::disk('cards');
            $request->file('picture')->move($cards_storage->getDriver()->getAdapter()->getPathPrefix().$card->id, $card->picture);
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;

    }

    public function trash()
    {
        DB::beginTransaction();
        try {
            $this->delete();
            $cards_storage = Storage::disk('cards');
            $cards_storage->deleteDirectory($this->id);
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
        DB::commit();
        return true;
    }
}
