<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function teacherAdvisee(){
        return $this->belongsToMany(TeacherAdvisee::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function studentSubmittion(){
        return $this->hasMany(StudentSubmittion::class);
    }
     public function subjectTeacherAdvisee(){
     return $this->belongsToMany(SubjectTeacherAdvisee::class);
     }

     public function strand(){
        return $this->belongsTo(Strand::class);
     }
     
     public function gradeLevel(){
        return $this->belongsTo(GradeLevel::class);
     }
    
}
