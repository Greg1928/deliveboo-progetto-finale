<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = ['dishes', 'types', 'user_id', 'image'];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return $this->image = asset("storage/{$this->image}");
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function dishes()
    {
        return $this->hasMany('App\Dish');
    }    

    public function types()
    {
        return $this->belongsToMany('App\Type');
    }
}
