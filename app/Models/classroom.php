<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
// use app\Models\Grade;
class classroom extends Model
{
    use HasTranslations;
    use HasFactory;
    public $translatable=['name'];
    protected $table ='classrooms';
    protected $fillable =['grade_id','name','created_at' ,'updated_at'];

    public function grades(){
        
        return $this->belongsTo('app\Models\Grade','grade_id');
    }
}
