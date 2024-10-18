<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Models\Teacher;
use Illuminate\Http\Request;
// use App\repository\teacherRepositoryInterface;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Support\Facades\Hash;

// use app\repository\teacherRepository
class TeacherController extends Controller
{
    //
    protected $teacher ;
    public function __construct(TeacherRepositoryInterface $teacher){
        $this->teacher =$teacher;
    }
    public function index()
    {
        // $Teachers = $this->teacher->getAllTeachers();
        $Teachers = Teacher::all();
        
        return view('teachers.index',compact('Teachers'));
    }

    public function create()
    {
         $specializations = $this->teacher->Getspecialization();
         $genders = $this->teacher->GetGender();
         return view('teachers.create',compact('specializations','genders'));
    }


    public function store(Request $request)
    {
        return $this->teacher->StoreTeachers($request);
    }

    public function show($id)
    {

    }


    public function edit($id)
    {
        $Teachers = $this->teacher->editTeachers($id);
        $specializations = $this->teacher->Getspecialization();
        $genders = $this->teacher->GetGender();
        return view('teachers.edit',compact('Teachers','specializations','genders'));
    }


    public function update(Request $request)
    {
        return $this->teacher->UpdateTeachers($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->teacher->DeleteTeachers($request);
    }

}