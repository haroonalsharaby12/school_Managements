<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Grade extends Model 
{
    use HasTranslations;
    protected $table = 'grades';
    public $timestamps = true;
    public $translatable = ['name'];
    protected $fillable =
    ['note','created_at' ,'updated_at'];

    public function Sections(){
        return $this->hasMany('App\Models\Section', 'Grade_id');
        
    }

}