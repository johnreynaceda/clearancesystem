<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherDesignation extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    public function teacher(){
      return  $this->belongsTo(Teacher::class);
    }
}
