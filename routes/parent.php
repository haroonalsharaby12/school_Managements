<?php

use App\Http\Controllers\parent_dashboard\ChildrenController;
use App\Http\Controllers\student_dashboard\ExamController;
use App\Http\Controllers\student_dashboard\ProfileController;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
// Route::get('/student/dashboard', function () {
//     return view('Students.dashboard');
// });
Route::group(
 [
     'prefix' => LaravelLocalization::setLocale(),
     'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
 ], function () {

 //==============================dashboard============================
 Route::get('/parent/dashboard', function () {
     $sons = student::where('parent_id',auth()->guard('parent')->user()->id)->get();
     return view('parents.dashboard',compact('sons'));
 })->name('dashboard.parents');

 Route::group(['namespace' => 'Parents\dashboard'], function () {
     Route::get('children', [ChildrenController::class,'index'])->name('sons.index');
     Route::get('results/{id}', [ChildrenController::class,'results'])->name('sons.results');
     Route::get('attendances', [ChildrenController::class,'attendances'])->name('sons.attendances');
     Route::post('attendances',[ChildrenController::class ,'attendanceSearc'])->name('sons.attendance.search');
     Route::get('fees', [ChildrenController::class,'fees'])->name('sons.fees');
     Route::get('receipt/{id}', [ChildrenController::class ,'receiptStudent'])->name('sons.receipt');
 });

});