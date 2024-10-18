<?php

namespace App\Http\Controllers\teacher_dashboard;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $information = Teacher::findorFail(auth()->guard('teacher')->user()->id);
        return view('teachers.dashboard.profile', compact('information'));
        
    }
    public function update(Request $request, string $id)
    {
        $information = Teacher::findorFail($id);

        if (!empty($request->password)) {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(trans('messages.Update'));
        return redirect()->back();


    }

}
