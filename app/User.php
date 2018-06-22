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
        return $this->belongsToMany(Item::class, 'item_favorites', 'user_id' , 'item_id')->withTimestamps();
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
        return $this->favorites()->where('item_id', $userId)->exists();
    }
    
    
    
    public function purchases()
    {
        return $this->belongsToMany(User::class, 'item_purchases', 'item_id', 'purchase_id')->withTimestamps();
    }
    
    public function purchase($purchaseId)
    {
        // confirm if already following
        $exist = $this->is_purchasing($purchaseId);
        // confirming that it is not you
    
        if ($exist) {
            // do nothing if already following
            return false;
        } else {
            // follow if not following
            $this->purchases()->attach($purchaseId);
            return true;
        }
    }
    
    public function unpurchase($purchaseId)
    {
        // confirming if already following
        $exist = $this->is_purchasing($purchaseId);
        // confirming that it is not you
    
        if ($exist) {
            // stop following if following
            $this->purchases()->detach($purchaseId);
            return true;
        } else {
            // do nothing if not following
            return false;
        }
    }
    
    
    public function is_purchasing($purchaseId) {
        return $this->purchases()->where('purchase_id', $purchaseId)->exists();
    }
}
