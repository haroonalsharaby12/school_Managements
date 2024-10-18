<?php

namespace App\Http\Controllers\student_dashboard;

use App\Http\Controllers\Controller;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
   
    public function index()
    {   
        $quizzes = Quizze::where('grade_id', auth()->guard('student')->user()->Grade_id)
        ->where('classroom_id', auth()->guard('student')->user()->Classroom_id)
        ->where('section_id', auth()->guard('student')->user()->section_id)
        ->orderBy('id', 'DESC')
        ->get();
    return view('students.dashboard.exams.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
