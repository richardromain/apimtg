<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;
use DB;
use Exception;
use Image;

class Card extends Model
{
    protected $fillable = [
        'name', 'content', 'cost', 'picture'
    ];

    protected $appends = [
        'url_picture'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function getUrlPictureAttribute()
    {
        return Storage::disk('cards')->url($this->id.'/'.$this->picture);
    }

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
            $cards_storage = Storage::disk('cards');
            if ($request->hasFile('picture')) {
                $card = Card::create([
                    'name' => $request->input('name'),
                    'content' => $request->input('content'),
                    'cost' => $request->input('cost'),
                    'picture' => str_slug($request->input('name')).'.'.$request->file('picture')->getClientOriginalExtension()
                ]);
                $request->file('picture')->move($cards_storage->getDriver()->getAdapter()->getPathPrefix().$card->id, $card->picture);
            } else {
                $card = Card::create([
                    'name' => $request->input('name'),
                    'picture' => str_slug($request->input('name')).'.png'
                ]);
                $cards_storage->makeDirectory($card->id);
                Image::make($request->input('urlPicture'))->save($cards_storage->getDriver()->getAdapter()->getPathPrefix().$card->id.DIRECTORY_SEPARATOR.$card->picture);
            }
            $card->types()->attach($request->input('types'));
            $card->colors()->attach($request->input('colors'));
        } catch (Exception $e) {
            dd($e);
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

    public static function search($name)
    {
        $card = Card::where('name', ucfirst($name))->first();
        return $card;
    }
}
