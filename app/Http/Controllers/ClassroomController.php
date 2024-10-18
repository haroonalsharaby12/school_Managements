<?php

namespace App\Http\Controllers;

use App\Http\Requests\classroomRequest;
use App\Models\classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    //
    public function index(){
        $classes =classroom::all();
        $grades=Grade::all();
        return view('classroom.index',compact('classes','grades'));
    }
    //
    public function store(classroomRequest $request){
        try{
            $List_Classes = $request->List_Classes;
            foreach($List_Classes as $list){
                $my_class =new classroom();
                $my_class->name=['en'=>$list['Name_class_en'],'ar'=>$list['Name']];
                $my_class->grade_id=$list['Grade_id'];
                $my_class->save();
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }catch(\Exception $er){
            toastr()->error(trans('messages.Delete').''.$er);
            return redirect()->back();
        }
    }
    public function update(classroomRequest $request){
        try{
                $i=$request->id;
                $my_class =classroom::find($i);
                $my_class->name=['en'=>$request->Name_en,'ar'=>$request->Name];
                $my_class->grade_id=$request->Grade_id;
                $my_class->update(); 
            toastr()->success(trans('messages.Update'));
            return redirect()->back();
        }catch(\Exception $er){
            toastr()->error(trans('messages.update').''.$er);
            return redirect()->back();
        }
    }

    public function destroy(Request $request){
        $id =$request->id;
        // return $id;
        classroom::find($id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }

    public function delete_all(Request $request){
        $list_id =explode(',',$request->delete_all_id);
        // return $list_id;
        classroom::whereIn('id',$list_id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }

    public function filter_grade(Request $request){
        return $request;
        // toastr()->success(trans('messages.Delete'));
        // return redirect()->back();
    }
}
