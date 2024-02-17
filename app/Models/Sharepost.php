<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sharepost extends Model
{
    use HasFactory;
    
    protected $fillable = [
                 'title',
                 'comment',
                 'img_path',
                 ];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function good_users()
    {
        return $this->belongsToMany(User::class, 'goods', 'sharepost_id', 'user_id')->withTimestamps();
    }
}
