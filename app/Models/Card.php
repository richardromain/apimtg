<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
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

    public static function add($name, $picture, $content = null, $cost = null, $types = null, $colors = null)
    {
        DB::beginTransaction();
        try {
            $cards_storage = Storage::disk('cards');
            if($picture instanceof UploadedFile) {
                $card = Card::create([
                    'name' => $name,
                    'content' => $content,
                    'cost' => $cost,
                    'picture' => str_slug($name).'.'.$picture->getClientOriginalExtension()
                ]);
                $picture->move($cards_storage->getDriver()->getAdapter()->getPathPrefix().$card->id, $card->picture);
            } else {
                $card = Card::create([
                    'name' => $name,
                    'picture' => str_slug($name).'.png'
                ]);
                $cards_storage->makeDirectory($card->id);
                Image::make($picture)->save($cards_storage->getDriver()->getAdapter()->getPathPrefix().$card->id.DIRECTORY_SEPARATOR.$card->picture);
            }
            $card->types()->attach($types);
            $card->colors()->attach($colors);
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

    public static function search($name)
    {
        $card = Card::where('name', ucfirst($name))->first();
        return $card;
    }
}
