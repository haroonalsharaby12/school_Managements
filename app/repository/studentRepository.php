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
class studentRepository implements StudentRepositoryInterface {
  public function get_all_students(){
//    return student::all();
   $students=student::all();
   return view('students.index',compact('students'));

  }
  public function Getspecialization(){
    
    return subjects::all();
}

public function Create_Student(){

    $data['my_classes'] =  Grade::all();
    $data['parents'] = parents::all();
    $data['Genders'] = Gender::all();
    $data['nationals'] =Nationalities::all();
    $data['bloods'] =Blood::all();
    return view('students.create',$data);

 }



 public function Get_classrooms($id){
    
    $list_classes = classroom::where("Grade_id", $id)->pluck("name", "id");
    return $list_classes;

}

//Get Sections
public function Get_Sections($id){
    // return $list_sections;
}
public function show_Student($id){
    $Student = Student::findorfail($id);
    return view('students.show',compact('Student'));
    // $list_sections =Section::where("Class_id", $id)->pluck("Name_Section", "id");
    // return $list_sections;
}

public function Store_Student($request){
    DB::beginTransaction();
    try {
        
        $students = new student();
        $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $students->email = $request->email;
        $students->password = Hash::make($request->password);
        $students->gender_id = $request->gender_id;
        $students->nationalitie_id = $request->nationalitie_id;
        $students->blood_id = $request->blood_id;
        $students->Date_Birth = $request->Date_Birth;
        $students->Grade_id = $request->Grade_id;
        $students->Classroom_id = $request->Classroom_id;
        $students->section_id = $request->section_id;
        $students->parent_id = $request->parent_id;
        $students->academic_year = $request->academic_year;
        $students->save();
        if($request->hasfile('photos')){
            foreach($request->file('photos') as $file){
                $name =$file->getClientOriginalName();
                $file->storeAs('attachements/students/'.$students->name, $name ,'upload_attachements');
                $image =new Image();
                $image->file_name=$name;
                $image->imageable_id=$students->id;
                $image->imageable_type='App\Models\student';
                $image->save();
            }
        }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
    }
    catch (\Exception $e){
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }}
}