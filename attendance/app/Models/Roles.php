<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function user(){
        return $this->belongsToMany(User::class,'user_roles','role_id','user_id');
    }
}
