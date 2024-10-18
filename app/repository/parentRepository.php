<?php
namespace App\Repository;

use App\Models\Blood;
use App\Models\classroom;
use App\Models\Nationalities;
use App\Models\parent_file;
use App\Models\parents;
use App\Models\Section;
use App\Models\student;
use App\Models\subjects;
use Illuminate\Support\Facades\Hash;
class parentRepository implements ParentRepositoryInterface {
  public function get_all_parents(){
    $my_parents = parents::all();

    return view('parents.index', compact('my_parents'));
  }
  public function Getspecialization(){
    
    return subjects::all();
}

public function Create_parents(){

    $Nationalities = Nationalities::all();
    $Type_Bloods = Blood::all();
    $Religions = Blood::all();
    return view('parents.create', compact('Nationalities', 'Type_Bloods', 'Religions'));

 }



 public function Get_classrooms($id){
     
     $list_classes = classroom::where("Grade_id", $id)->pluck("name", "id");
     return $list_classes;
     
    }
    public function store_parents($request){
        try{
            
        $data['Email']=$request->Email;
        $data['Password']=$request->Password;
        // return $data;
        $data['Name_Father']=['ar'=>$request->Name_Father,'en'=>$request->Name_Father_en];
        // $data['Name_Father_en']=;
        $data['Job_Father'] =['ar'=>$request->Job_Father,'en'=>$request->Job_Father_en];
        // $request->Job_Father;
        // $data['Job_Father_en'] =$request->Job_Father_en;
        $data['National_ID_Father'] =$request->National_ID_Father;
        $data['Passport_ID_Father'] =$request->Passport_ID_Father;
        $data['Phone_Father'] =$request->Phone_Father;
        $data['Nationality_Father_id'] =$request->Nationality_Father_id;
        $data['Blood_Type_Father_id'] =$request->Blood_Type_Father_id;

        parents::create($data);
        if($request->photos){
            $image =$request->photos;
            $name =$image->getOrginalClientName;
            $last_id =parents::last()->first('id');
            // store($name);
            
            parent_file::create([
                'parent_id'=>$last_id,
                'file_name'=>$image
            ]);
        }
        toastr()->success(trans('messages.success'));
        return redirect()->back()->with(['succeess'=>'تم الاضافة بنجاح']);
        }catch(\Exception $er){
            toastr()->error($er->getMessage());
            return redirect()->back();
        }
    }
    public function update_parents($request){}
    public function edit_parents($id){}
    public function delete_parents($id){}

//Get Sections
public function Get_Sections($id){

    $list_sections =Section::where("Class_id", $id)->pluck("Name_Section", "id");
    return $list_sections;
}

public function Store_Student($request){

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
        toastr()->success(trans('messages.success'));
        return redirect()->route('Students.create');
    }

    catch (\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

}



}