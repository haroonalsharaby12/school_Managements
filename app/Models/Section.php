<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
  
    use HasTranslations;
    public $translatable = ['Name_Section'];
    protected $fillable=['Name_Section','Grade_id','Class_id'];
    protected $table = 'sections';
    public $timestamps = true;
    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام
    public function class()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }
    function grade(){
        return $this->belongsTo('App\Models\Grade','Grade_id');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher','teacher_section');
    }
    
}
