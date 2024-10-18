<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Grades = Grade::all();
        return view('students.promotion.index',compact('Grades'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $promotions = promotion::all();
        return view('students.promotion.management',compact('promotions'));
  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();

            if($students->count() < 1){
                // return 'error';
                // toastr()->error(trans('messages.has_child'));
                return redirect()->back()->with('error', 'tis empty');
                // ->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }
            
            // update in table student
            foreach ($students as $student){
                $ids = explode(',',$student->id);
                return $ids .'  '.$student->id; 
                student::whereIn('id', $ids)
                    ->update([
                        'Grade_id'=>$request->Grade_id_new,
                        'Classroom_id'=>$request->Classroom_id_new,
                        'section_id'=>$request->section_id_new,
                        'academic_year'=>$request->academic_year_new,
                    ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_Classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_Classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                ]);

            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();

        try {

            // التراجع عن الكل
            if($request->page_id ==1){

             $Promotions = Promotion::all();
             foreach ($Promotions as $Promotion){

                 //التحديث في جدول الطلاب
                 $ids = explode(',',$Promotion->student_id);
                 student::whereIn('id', $ids)
                 ->update([
                 'Grade_id'=>$Promotion->from_grade,
                 'Classroom_id'=>$Promotion->from_Classroom,
                 'section_id'=> $Promotion->from_section,
                 'academic_year'=>$Promotion->academic_year,
               ]);

                 //حذف جدول الترقيات
                 Promotion::truncate();

             }
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            }

            else{

                $Promotion = Promotion::findorfail($request->id);
                student::where('id', $Promotion->student_id)
                    ->update([
                        'Grade_id'=>$Promotion->from_grade,
                        'Classroom_id'=>$Promotion->from_Classroom,
                        'section_id'=> $Promotion->from_section,
                        'academic_year'=>$Promotion->academic_year,
                    ]);


                Promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            }

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
