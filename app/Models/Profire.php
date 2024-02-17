<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profire extends Model
{
    protected $fillable = ['user_id','content', 'other_profile_fields'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
