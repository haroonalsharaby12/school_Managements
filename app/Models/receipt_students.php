<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class receipt_students extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo('App\Models\student', 'student_id');
    }
}
