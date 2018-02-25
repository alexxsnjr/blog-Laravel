<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        //devuelve los post que forman parte de la etiqueta pasada por parametro
        $posts = $tag->posts()->paginate();
        $title = "Publicaciones de la etiqueta " . $tag->name;

        return view('pages.home', compact('posts','title'));
    }
}
