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
    public function strand(){
      return $this->belongsTo(Strand::class);
    }

    public function subject(){
      return $this->belongsTo(Subject::class);
    }
}
