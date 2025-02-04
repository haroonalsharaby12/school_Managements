<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\StudentGraduatedRepositoryInterface;
class GraduatedController extends Controller
{
    protected $Graduated;

    public function __construct(StudentGraduatedRepositoryInterface $Graduated)
    {
        $this->Graduated = $Graduated;
    }

    public function index()
    {
       return $this->Graduated->index();
    }

    public function create()
    {
        return $this->Graduated->create();
    }

    public function store(Request $request)
    {
        return $this->Graduated->SoftDelete($request);
    }

    public function update(Request $request)
    {
        return $this->Graduated->ReturnData($request);
    }

    public function destroy(Request $request)
    {
       return $this->Graduated->destroy($request);
    }
}