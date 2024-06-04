<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'dob',
        'gender',
        'telephone',
    ];

    protected function casts(): array
    {
        return [
            'dob' => 'datetime',
        ];
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function group(){
        return $this->belongsToMany(Student::class,'group_student','student_id','group_id');
    }
}
