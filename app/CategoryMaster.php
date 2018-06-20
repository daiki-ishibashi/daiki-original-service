<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryMaster extends Model
{
    protected $fillable = ['category_id'];

    public function items()
    {
        return $this->belongsTo(Item::class,'id','category_id');
    }

}
