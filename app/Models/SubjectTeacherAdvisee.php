<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTeacherAdvisee extends Model
{
    use HasFactory;
    protected $guarded = [];

     public function students(){
     return $this->hasMany(Student::class,'id');

     }

     public function teachers(){
     return $this->hasMany(Teacher::class,'id');
     }
}
