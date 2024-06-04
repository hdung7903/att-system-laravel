<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingUserDetails extends Model
{
    use HasFactory;

    protected $table="pending_user_details";

    protected $fillable = [
        'user_id', 'firstname', 'lastname', 'dob', 'gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
