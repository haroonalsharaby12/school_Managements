<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\GradeRequest;
use App\Models\classroom;
use App\Models\Grade;
use Illuminate\Auth\Events\Validated;

class GradeController extends Controller
{
  public function index()
  {  
      $Grades = Grade::all();
    return view('grades.index',compact('Grades'));
  }
  public function store(GradeRequest $request)
  {
      try {
          $validated = $request->validated();
          $attributes =request()->validate([
            'name'=>'required|unique_translation:grades'
          ],[
            'name.unique_translation'=>trans('validation.unique')
          ]);
          $Grade = new Grade();
          $translations = [
              'en' => $request->name_en,
              'ar' => $request->name
          ];
          $Grade->setTranslations('name', $translations);    
          $Grade->name = ['en' => $request->name_en, 'ar' => $request->name];
          $Grade->note = $request->Notes;
          $Grade->save();
          toastr()->success(trans('messages.success'));
          return redirect()->back();
      }
      catch (\Exception $e){
        toastr()->error($e->getMessage());
          return redirect()->back();
      }
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
   public function update(GradeRequest $request)
 {
   try {
       $validated = $request->validated();
       $Grades = Grade::findOrFail($request->id);
       $Grades->update([
         $Grades->name = ['ar' => $request->name, 'en' => $request->name_en],
         $Grades->note = $request->Notes,
       ]);
       toastr()->success(trans('messages.Update'));
       return redirect()->back();
   }
   catch
   (\Exception $e) {
       return redirect()->back()->withErrors(['error' => $e->getMessage()]);
   }
 }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
    $classes= classroom::where('grade_id',$request->id)->first();
    if(empty($classes)){

      $Grades = Grade::findOrFail($request->id)->delete();
      toastr()->success(trans('messages.Delete'));
      return redirect()->back();
    }

      toastr()->error(trans('messages.has_child'));
      return redirect()->back();
    

  }

}
