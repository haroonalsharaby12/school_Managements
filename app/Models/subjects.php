<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class subjects extends Model
{
    use HasTranslations;
    use HasFactory;
    public $translatable = ['Name'];
    protected $fillable=['Name'];
}
