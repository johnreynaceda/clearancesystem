<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Strand extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function students(){
        return $this->hasMany(Student::class);
    }

    public function teacherDesignation(){
        return $this->hasMany(TeacherDesignation::class);
    }   
}
