<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    //define los campos a asignar en masa en el controlador
    protected $fillable = ['url'];



    public static function boot()
    {
        parent::boot();
        // este metodo se ejecutara con cada vez q el controlador use el metodo delete
        static::deleting(function($photo){

            //borra la foto del sistema
            Storage::disk('public')->delete($photo->url);
        });
    }
}
