<?php

use App\Http\Controllers\teacher_dashboard\ProfileController;
use App\Http\Controllers\teacher_dashboard\QuestionController;
use App\Http\Controllers\teacher_dashboard\QuizzController;
use App\Http\Controllers\teacher_dashboard\StudentController;
// use App\Http\Controllers\teacher_dashboard\StudentController;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



//==============================Translate all pages============================
Route::group(
 [
     'prefix' => LaravelLocalization::setLocale(),
     'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
 ], function () {

 //==============================dashboard============================
 Route::get('/teacher/dashboard', function () {
    
     $ids = Teacher::findorFail(auth()->guard('teacher')->user()->id)->Sections()->pluck('section_id');
     $data['count_sections']= $ids->count();
     $data['count_students']= \App\Models\student::whereIn('section_id',$ids)->count();

//        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
//        $count_sections =  $ids->count();
//        $count_students = DB::table('students')->whereIn('section_id',$ids)->count();
     return view('teachers.dashboard.dashboard',$data);
 })->name('teacher.dashboard');
 Route::get('sections',[StudentController::class,'sections'])->name('teacher_sections');
 Route::get('profile', [ProfileController::class,'index'])->name('profile.showsssssssss');

     //==============================students============================
  Route::get('student',[App\Http\Controllers\teacher_dashboard\StudentController::class,'index'])->name('student.index');
  Route::post('attendance',[App\Http\Controllers\teacher_dashboard\StudentController::class,'attendance'])->name('attendance');
  Route::post('edit_attendance',[App\Http\Controllers\teacher_dashboard\StudentController::class,'editAttendance'])->name('attendance.edit');
  Route::get('attendance_report',[App\Http\Controllers\teacher_dashboard\StudentController::class,'attendanceReport'])->name('attendance.report');
  Route::post('attendance_report',[App\Http\Controllers\teacher_dashboard\StudentController::class,'attendanceSearch'])->name('attendance.search');
  Route::resource('quizzes', QuizzController::class);
  Route::resource('questions', QuestionController::class);
// Route::get('profile_teacher', function(){
//     return 'dd';
//   })->name('profile.showsssssssss');
//   Route::get('profiles', [ProfileController::class,'index'])->name('sections');
  Route::post('profile/{id}', [ProfileController::class ,'update'])->name('profile.update');
  Route::get('student_quizze/{id}',[QuizzController::class ,'student_quizze'])->name('student.quizze');
  Route::post('repeat_quizze', [QuizzController::class ,'repeat_quizze'])->name('repeat.quizze');
  
  // Route::resource('online_zoom_classes', OnlineZoomClassesController::class);
  // Route::get('/indirect', OnlineZoomClassesController::class,'indirectCreate')->name('indirect.teacher.create');
  // Route::post('/indirect', OnlineZoomClassesController::class ,'storeIndirect')->name('indirect.teacher.store');


});
