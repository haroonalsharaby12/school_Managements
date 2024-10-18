<?php
// namespace app\repository;
namespace App\Repository;

interface ParentRepositoryInterface{

 
    // Get Add Form Student
    public function get_all_parents();
    public function Create_parents();
    public function store_parents($request);
    public function update_parents($request);
    public function edit_parents($id);
    public function delete_parents($id);

    // Get classrooms
    public function Get_classrooms($id);

    //Get Sections
    public function Get_Sections($id);

    //Store_Student
    public function Store_Student($request);


}