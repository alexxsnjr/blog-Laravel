<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PhotosController extends Controller
{
    public function store(Post $post)
    {
        //validacion photos
        $this->validate(request(), [
            'photo' => 'required|image|max:2048'
        ]);

        //crear enlace simbolico con php artisan storage:link entre la carpeta public y el disco Public
        $post->photos()->create([
            'url'   =>  request()->file('photo')->store('posts','public'),
        ]);


    }

    public function destroy(Photo $photo)
    {
        //borra la foro en la BBDD( cuando se ejecuta tb se ejecutara el metodo Deleting del Modelo)
        $photo->delete();



        return back()->with('flash', 'Foto Eliminada');
    }
}
