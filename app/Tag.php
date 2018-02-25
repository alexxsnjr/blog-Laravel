<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //campos para asignación masiva en el TagsController
    protected $fillable = ['name'];

    //Modifica la clave de la routa utilizada para seleccionar cada Tag
    public function getRouteKeyName()
    {
        return 'url';
    }

    //RelacionBBDD Los post y Tags es una relacion de N a N por eso se utiliza BelogsToMany en ambos
    //Un post pertenece a muchas etiquetas y una etiqueta pertenece a muchos posts
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    //Mutator para generar la url antes de almacenar en la BBDD
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['url'] = str_slug($name);
    }
}
