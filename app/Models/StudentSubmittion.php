<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubmittion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function uploadedRequirements(){
        return $this->hasMany(UploadedRequirement::class);
    }

    public function clearanceRequirement(){
        return $this->belongsTo(ClearanceRequirement::class);
    }
}
