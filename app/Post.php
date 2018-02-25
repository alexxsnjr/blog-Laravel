<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    //especificamos los campos para la asignacion en masa en el contolador
    protected $fillable = ['title', 'body', 'iframe', 'excerpt', 'published_at', 'category_id', 'user_id'];

    protected $dates = ['published_at'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($post){

            //borramos la relacion de etiquetas con el posts
            $post->tags()->detach();

            //$post->photo es una coleccion por lo q por cada foto la vamos borrando
            //Se borra tanto del sistema como de la BBDD por el metodo Boot del Modelo Photo.
            $post->photos->each->delete();
        });
    }

    //relacion BBDD un Post pertenece a  una unica categoria
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //relacion BBDD un Post pertenece a  muchas etiquetas
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    //relacion BBDD un Post tiene muchas fotos
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    //modificamos el metodo create para poder pasarle solo el user_id y titulo
    public static function  create(array $attributes = [])
    {
        $attributes['user_id'] = auth()->id();
        $post = static::query()->create($attributes);
        $post->generateSlug();
        return $post;
    }

    public function isPublished()
    {
        return ! is_null($this->published_at) && $this->published_at < today();
    }
    //generamos el slug
    public function generateSlug()
    {
        $slug =  str_slug($this->title);

        if ($this->whereSlug( $slug)->exists()){
            $slug.='-' . $this->id;
        }

        $this->slug = $slug;
        $this->save();
    }

    //Mutator para dar formato a la fecha
    public function setPublishedAtAttribute($published_at)
    {
        $this->attributes['published_at'] = $published_at ? Carbon::parse($published_at) : null;
    }

    // Mutator para crear una categoria si esta no existe
    public function setCategoryIdAttribute($category_id)
    {
        $this->attributes['category_id'] = Category::find($cat = $category_id)
                                    ? $cat
                                    : Category::create(['name' => $cat])->id;
    }

    //Crea y relaciona nuevas etiquetas utilizando colecciones
    public function syncTags($tags)
    {
        $tagIds = collect($tags)->map(function ($tag){
            return Tag::find($tag) ? $tag : Tag::create(['name' => $tag])->id;
        });

        return $this->tags()->sync($tagIds);
    }

    //condicion de la consulta para no devolver los post con fecha menor a la actual y lo devuelve con orden de mas actual a menos
    public function scopePublished($query)
    {
        $query->whereNotNull('published_at')
            ->where('published_at','<=',Carbon::now())
            ->latest('published_at');
    }

    public function scopeAllowed($query)
    {

        if(auth()->user()->can('view', $this)){
            return  $query;
        }else{
            //obtiene todos los posts de la bbdd cuando el usuario es el dueño
            return $query->where('user_id', auth()->id());
        }

    }
    //modifica el id utilizado en la routa para cada post por su slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    //Gestiona las vista de post
    public function viewType($view = '')
    {
        if ($this->photos->count() === 1) {
            return 'posts.photo';
        }elseif ($this->photos->count() > 1) {
            return 'posts.carousel' . $view;
        }elseif ($this->iframe){
            return 'posts.iframe';
        }else{

            return 'posts.text';
        }

    }
}
