<?php
namespace App\Repository;

use App\Models\Blood;
use App\Models\classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Nationalities;
use App\Models\parents;
use App\Models\Section;
use App\Models\student;
use App\Models\subjects;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class studentGraduatedRepository implements StudentGraduatedRepositoryInterface {

    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('students.Graduated.index',compact('students'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('students.Graduated.create',compact('Grades'));
    }

    public function SoftDelete($request)
    {
        $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        }

        foreach ($students as $student){
            $ids = explode(',',$student->id);
            student::whereIn('id', $ids)->Delete();
        }

        toastr()->success(trans('messages.success'));
        return redirect()->route('Graduated.index');
    }

    public function ReturnData($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->restore();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function destroy($request)
    {
        student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }


}