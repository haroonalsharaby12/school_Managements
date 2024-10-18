<?php
// namespace app\repository;
namespace App\Repository;

interface StudentRepositoryInterface{

 
    // Get Add Form Student
    public function get_all_students();
    public function Create_Student();

    // Get classrooms
    public function Get_classrooms($id);
    
    public function show_Student($id);
    //Get Sections
    public function Get_Sections($id);

    //Store_Student
    public function Store_Student($request);


}