<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeInvoiceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\OnlineClassesController;
use App\Http\Controllers\parentontroller;
use App\Http\Controllers\PaymentStudentsController;
use App\Http\Controllers\ProcessingFeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizzeController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ReceiptStudentsController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

require __DIR__.'/student.php';
// routes/web.php



Route::get('/', [HomeController::class ,'index'])->name('selection');

Route::post('/login',[LoginController::class ,'login'])->name('new_login');

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}',[LoginController::class ,'loginForm'])->middleware('guest')->name('login.show');
Route::post('/logins',[LoginController::class ,'login'])->name('login.home');

// Route::get('/logout/{type}', [LoginController::class ,'logout'])->name('logout');
    
    
    
    });

Route::group(
    [ 
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth' ]
    ], function(){ 
        // Route::get('/', function()
        // {
        //     return view('dashboard');
        // })->name('dashboard');
    Route::get('/dashboard', [HomeController::class ,'dashboard'])->name('dashboard');


        // Route::get('/', 'HomeController@index')->name('selection');
        // Route::get('/login/{type}',[LoginController::class ,'loginForm'])->middleware('guest')->name('login.show');

        // Route::post('/login',[LoginController::class ,'login'])->name('login');
        // Route::get('/logout/{type}', [LoginController::class ,'logout'])->name('logout');

        // })->middleware(['auth', 'verified'])->name('dashboard');
        route::get('/grades' ,[GradeController::class , 'index'])->name('grade.index');
        route::post('/grade-store' ,[GradeController::class , 'store'])->name('grade.store');
        route::patch('/grade-update' ,[GradeController::class , 'update'])->name('grade.update');
        route::Delete('/grade-destory' ,[GradeController::class , 'destroy'])->name('grade.destroy');

        route::get('/classroom' ,[ClassroomController::class , 'index'])->name('classroom.index');
        route::post('/classroom-store' ,[ClassroomController::class , 'store'])->name('classroom.store');
        route::patch('/classroom-update' ,[ClassroomController::class , 'update'])->name('classroom.update');
        route::Delete('/classroom-destory' ,[ClassroomController::class , 'destroy'])->name('classroom.destroy');
        route::post('/classroom-delete-all' ,[ClassroomController::class , 'delete_all'])->name('classroom.delete_all');
        route::post('/classroom-filter' ,[ClassroomController::class , 'filter_grade'])->name('classroom.filter_grade');

        // *********************************** Section class ****************
        
        route::get('/sections' ,[SectionController::class , 'index'])->name('section.index');
        route::post('/section-store' ,[SectionController::class , 'store'])->name('section.store');
        route::patch('/section-update' ,[SectionController::class , 'update'])->name('section.update');
        route::Delete('/section-destory' ,[SectionController::class , 'destroy'])->name('section.destroy');
        route::post('/classes' ,[SectionController::class , 'getclasses'])->name('section.getclasses');
        

        // *********************************** Section class ****************
        // *********************************** Teacher class ****************
        
        route::get('/teachers' ,[TeacherController::class , 'index'])->name('teachers.index');
        route::get('/teacher-create' ,[TeacherController::class , 'create'])->name('teachers.create');
        route::get('/teacher-edit' ,[TeacherController::class , 'edit'])->name('teachers.edit');
        route::post('/teachers-store' ,[TeacherController::class , 'store'])->name('teacher.store');
        route::patch('/teachers-update' ,[TeacherController::class , 'update'])->name('teachers.update');
        route::Delete('/teachers-destory' ,[TeacherController::class , 'destroy'])->name('teachers.destroy');
        // route::post('/classes' ,[TeacherController::class , 'getclasses'])->name('teachers.getclasses');
        

        // *********************************** Teacher class ****************
        // *********************************** Parents class ****************
        route::get('/parents' ,[parentontroller::class , 'index'])->name('parents.index');
        
        route::get('/parents-create' ,[parentontroller::class , 'create'])->name('parents.create');
        route::post('/parents-store' ,[parentontroller::class , 'store'])->name('parents.store');
        route::post('/parents-edit' ,[parentontroller::class , 'store'])->name('parents.edit');
        route::post('/parents-delete' ,[parentontroller::class , 'store'])->name('parents.delete');


        // *********************************** Students class ****************

        route::resource('students',StudentController::class);
        Route::get('/Get_classrooms/{id}',[StudentController::class,'Get_classrooms']);
        Route::get('/Get_Sections/{id}',[StudentController::class,'Get_Sections']);
        Route::post('/Upload_attachment',[StudentController::class,'Upload_attachment'])->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class ,'Download_attachment']);
        Route::post('Delete_attachment', [StudentController::class ,'Delete_attachment'])->name('Delete_attachment');
        
        route::resource('Promotion',PromotionController::class);
        
        route::get('/Graduated' ,[GraduatedController::class , 'index'])->name('Graduated.index'); 
        route::get('/Graduated-create' ,[GraduatedController::class , 'create'])->name('Graduated.create');
        route::post('/Graduated-store' ,[GraduatedController::class , 'store'])->name('Graduated.store');
        route::post('/Graduated-edit' ,[GraduatedController::class , 'edit'])->name('Graduated.edit');
        route::post('/Graduated-delete' ,[GraduatedController::class , 'destroy'])->name('Graduated.destroy');
        route::post('/Graduated-update' ,[GraduatedController::class , 'update'])->name('Graduated.update');

        Route::resource('library', LibraryController::class);
        Route::get('download_file/{filename}', [LibraryController::class,'downloadAttachment'])->name('downloadAttachment');


        Route::resource('Fees', FeeController::class);
        Route::resource('Fees_Invoices', FeeInvoiceController::class);
        Route::resource('receipt_students', ReceiptStudentsController::class);
        Route::resource('ProcessingFee', ProcessingFeeController::class);
        Route::resource('Payment_students', PaymentStudentsController::class);
        Route::resource('online_classes', OnlineClassesController::class);
        Route::resource('Attendance', AttendanceController::class);
        // *********************************** End Students class ****************
        Route::get('full-calender', [EventController::class, 'index']);

        Route::post('full-calender/action', [EventController::class, 'action']);
        
    //==============================subjects============================
        Route::resource('subjects', SubjectController::class);

    //==============================Quizzes============================
        Route::resource('Quizzes', QuizzeController::class);

    //==============================questions============================
    Route::resource('questions', QuestionController::class);

    //==============================settings============================

    route::get('/settings' ,[SettingController::class , 'index'])->name('settings.index');
    route::post('/settings-store' ,[SettingController::class , 'store'])->name('settings.store');
    route::patch('/settings-update' ,[SettingController::class , 'update'])->name('settings.update');
    route::Delete('/settings-destory' ,[SettingController::class , 'destroy'])->name('settings.destroy');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
        Route::get('/test', function (){
            return view('test');
        })->name('test');

        Route::get('/add_parent', function (){
            return view('livewire.show_Form');
        })->name('add_parent');
        // Route::view('/add_parent','livewire.show_Form');
        Route::view('counter','livewire.counter');
        // Route::get('counter',Counter::class);
    });
/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/





require __DIR__.'/auth.php';
