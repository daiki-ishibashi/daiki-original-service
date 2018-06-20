<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['image_url','category_id', 'name','content','price'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    
    public function category_masters()
    {
        return $this->hasOne(CategoryMaster::class,'id','category_id');
    }


}