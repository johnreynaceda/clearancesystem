<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadedRequirement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function studentSubmittion(){
        return $this->belongsTo(StudentSubmittion::class);
    }
}
