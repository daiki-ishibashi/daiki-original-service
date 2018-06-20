<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    
    public function feed_items()
    {
        $user_ids = $this->pluck('users.id');
        $user_ids[] = $this->id;
        return Item::whereIn('user_id', $user_ids);
    }
    
    public function favorites()
    {
        return $this->belongsToMany(Item::class, 'item_favorite', 'item_id', 'favorite_id')->withTimestamps();
    }
    
    public function favorite($userId)
{
    // 既にフォローしているかの確認
    $exist = $this->is_favoriting($userId);
    // 自分自身ではないかの確認
    

    if ($exist) {
        // 既にフォローしていれば何もしない
        return false;
    } else {
        // 未フォローであればフォローする
        $this->favorites()->attach($userId);
        return true;
    }
}

public function unfavorite($userId)
{
    // 既にフォローしているかの確認
    $exist = $this->is_favoriting($userId);
    // 自分自身ではないかの確認
    

    if ($exist) {
        // 既にフォローしていればフォローを外す
        $this->favorites()->detach($userId);
        return true;
    } else {
        // 未フォローであれば何もしない
        return false;
    }
}

public function is_favoriting($userId) {
    return $this->favorites()->where('favorite_id', $userId)->exists();
}
}
