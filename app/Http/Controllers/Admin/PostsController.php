<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\StorePostRequest;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::allowed()->get();

        return view('admin.posts.index', compact('posts'));
    }

    //almacenar Posts
    public function store(Request $request)
    {

        $this->validate($request, ['title' => 'required|min:3']);

        $post = Post::create($request->all());

        return redirect()->route('admin.posts.edit', $post);
    }

    //obtiene categorias etiquetas y edita el post
    public function edit(Post $post)
    {
        //definicio en PostPolicy

        $this->authorize('update', $post);

        return view('admin.posts.edit',[
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ]);
    }


    public function update(StorePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->all());
        $post->syncTags($request->tags);
        return redirect()->route('admin.posts.edit', $post)->with('flash', 'La publicación ha sido guardada');
    }

    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);
        //se ejecutara el metodo Boot del modelo para borrar las dependencias

        $post->delete();
        return redirect()->route('admin.posts.index')
            ->with('flash', 'La publicación ha sido eliminada');
    }
}
