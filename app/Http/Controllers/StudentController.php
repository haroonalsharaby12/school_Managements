<?php

namespace App\Http\Controllers;

use App\Models\Blood;
use App\Models\classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Nationalities;
use App\Models\parents;
use App\Models\Section;
use App\Models\student;
use Illuminate\Http\Request;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{

    protected $student;
    public function __construct(StudentRepositoryInterface $student)
    {
        $this->student = $student;
    }
    public function index()
    {
        //
        return $this->student->get_all_students();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return $this->student->Create_Student();
        // $id=1;
        // $list_classes = classroom::where("grade_id", $id)->pluck("name", "id");
        // // return $list_classes;
        // // dd($list_classes);
        // return $this->student->Create_Student();
        // $Genders =Gender::all();
        // $nationals =Nationalities::all();
        // $bloods =Blood::all();
        // $my_classes =Grade::all();
        // $parents =parents::all();
        // return view('students.create',compact('Genders' ,'nationals','bloods' ,'my_classes' ,'parents'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->student->Store_Student($request);
        // $data['name'] =['ar'=>$request->name_ar,'en'=>$request->name_en];
        // $data['email'] =$request->email;
        // $data['password'] =$request->password;
        // $data['gender_id'] =$request->gender_id;
        // $data['nationalitie_id'] =$request->nationalitie_id;
        // $data['blood_id'] =$request->blood_id;
        // $data['Date_Birth'] =$request->Date_Birth;
        // $data['Grade_id'] =$request->Grade_id;
        // $data['Classroom_id'] =$request->Classroom_id;
        // $data['section_id'] =$request->section_id;
        // $data['parent_id'] =$request->parent_id;
        // $data['academic_year'] =$request->academic_year;
        // $data['created_at'] =date('Y-m-d H:i:s');
        // student::create($data);
        // toastr()->success(trans('messages.success'));
        // return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        return $this->student->show_Student($id);
    }
    public function Get_classrooms($id)
    {
        //
        $list_classes = classroom::where("grade_id", $id)->pluck("name", "id");
        return $list_classes;
        // dd($list_classes);
        // if(is_numeric($id))
        return $this->student->Get_classrooms($id);
    }
    public function Get_Sections($id)
    {
        //

        $list_sections = Section::where("Class_id", $id)->pluck("Name_Section", "id");
        return $list_sections;
        if (is_numeric($id))
            return $this->student->Get_Sections($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function Upload_attachment(Request $request)
    {
        if ($request->hasfile('photos')) {
            foreach ($request->file('photos') as $file) {
                $name = $file->getClientOriginalName();
                $file->storeAs('attachements/students/' . $request->student_name, $name, 'upload_attachements');
                $image = new Image();
                $image->file_name = $name;
                $image->imageable_id = $request->student_id;
                $image->imageable_type = 'App\Models\student';
                $image->save();
                toastr()->success(trans('messages.success'));
                return redirect()->back();
            }
        }
    }
    public function Download_attachment($studentsname, $filename)
    {
        return response()->download(public_path('attachements/students/' . $studentsname . '/' . $filename));
    }

    public function Delete_attachment(Request $request)
    {
        // Delete img in server disk
        Storage::disk('upload_attachements')->delete('attachements/students/' . $request->student_name . '/' . $request->filename);

        // Delete in data
        image::where('id', $request->id)->where('file_name', $request->filename)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }

    public function edit( $id) {
        $data['Grades'] = Grade::all();
        $data['parents'] = parents::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] =Nationalities::all();
        $data['bloods'] =Blood::all();
        $Students =  student::findOrFail($id);
        return view('students.edit',$data,compact('Students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $Edit_Students = Student::findorfail($request->id);
            $Edit_Students->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $Edit_Students->email = $request->email;
            $Edit_Students->password = Hash::make($request->password);
            $Edit_Students->gender_id = $request->gender_id;
            $Edit_Students->nationalitie_id = $request->nationalitie_id;
            $Edit_Students->blood_id = $request->blood_id;
            $Edit_Students->Date_Birth = $request->Date_Birth;
            $Edit_Students->Grade_id = $request->Grade_id;
            $Edit_Students->Classroom_id = $request->Classroom_id;
            $Edit_Students->section_id = $request->section_id;
            $Edit_Students->parent_id = $request->parent_id;
            $Edit_Students->academic_year = $request->academic_year;
            $Edit_Students->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        student::destroy($request->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }
}
