<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $guarded = ['orders', 'restaurant_id', 'image'];
    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return $this->image = asset("storage/{$this->image}");
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

}
