<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //campos para assignar en masa en el CategoriesController
    protected $fillable = ['name'];


    //Relación BBDD Una Categoria tiene Muchos Posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Modifica la clave utilizada por la ruta para cada categoria por la url
    public function getRouteKeyName()
    {
        return 'url';
    }

    //Mutator para generar la url antes de guardar una categoria en la BBDD
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }
}
