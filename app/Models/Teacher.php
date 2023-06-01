<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function teacherDesignations(){
      return  $this->hasMany(TeacherDesignation::class);
    }
    public function user(){
      return $this->belongsTo(User::class);
    }

    public function teacherAdvisee(){
    return $this->belongsToMany(TeacherAdvisee::class);
    }

    public function clearanceRequirements(){
      return $this->hasMany(ClearanceRequirement::class);
    }
    
}
