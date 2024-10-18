<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ParentRequest;
use App\Http\Requests\Auth\StudentRequest;
use App\Http\Requests\Auth\TeacherRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $type=$request->type;
        if($type=='student'){
            if(auth()->guard('student')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->intended(route('student.dashboard', absolute: false));
            }
            else{
                return redirect()->back()->with('error','هناك خطا في كلمة المرور او الايميل');
            }
        }
        else if($type=='parent'){
            if(auth()->guard('parent')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->intended(route('parents.dashboard', absolute: false));
            }
            else{
                return redirect()->back()->with('error','هناك خطا في كلمة المرور او الايميل');
            }
        }
        else if($type=='teacher'){
            if(auth()->guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password])){
                
                return redirect()->intended(route('teacher.dashboard', absolute: false));
            }
            else{
                return redirect()->back()->with('error','هناك خطا في كلمة المرور او الايميل');
            }
        }
        else{
            if(auth()->guard('web')->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->intended(route('dashboard', absolute: false));
            }
            else{
                return redirect()->back()->with('error','هناك خطا في كلمة المرور او الايميل');
            }
        }
    }



    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {

        if(auth()->guard('student')){
             Auth::guard('web')->logout();
        }
        if(auth()->guard('teacher')){
             Auth::guard('teacher')->logout();
        }
        if(auth()->guard('parent')){
             Auth::guard('parent')->logout();
        }
        else{
             Auth::guard('web')->logout();
        }
        // Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // return 'dd';
        return redirect()->route('selection');
    }
}
