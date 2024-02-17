<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function shareposts()
    {
        return $this->hasMany(Sharepost::class);
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount(['shareposts', 'followings', 'followers']);
    }
    
     public function getRouteKeyName()
    {
        return 'user';
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function follow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist || $its_me) {
            return false;
        } else {
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        $exist = $this->is_following($userId);
        $its_me = $this->id == $userId;
        
        if ($exist && !$its_me) {
            $this->followings()->detach($userId);
            return true;
        } else {
            return false;
        }
    }
    
     public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
     public function feed_shareposts()
    {
        // このユーザがフォロー中のユーザのidを取得して配列にする
        $userIds = $this->followings()->pluck('users.id')->toArray();
        // このユーザのidもその配列に追加
        $userIds[] = $this->id;
        // それらのユーザが所有する投稿に絞り込む
        return Sharepost::whereIn('user_id', $userIds);
    }
    
    public function goods()
    {
        return $this->belongsToMany(Sharepost::class, 'goods', 'user_id', 'sharepost_id')->withTimestamps();
    }


     public function good($sharepostId)
    {
        $exist = $this->is_goods($sharepostId);
        
        if ($exist ) {
            return false;
        } else {
            $this->goods()->attach($sharepostId);
            return true;
        }
    }
    
     public function ungood($sharepostId)
    {
        $exist = $this->is_goods($sharepostId);
        
        if ($exist ) {
            $this->goods()->detach($sharepostId);
            return true;
        } else {
            return false;
        }
    }
     public function is_goods($sharepostId)
    {
        return $this->goods()->where('sharepost_id', $sharepostId)->exists();
    }
    
     public function profire()
    {
        return $this->hasOne(Profire::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
     
}
        
    

