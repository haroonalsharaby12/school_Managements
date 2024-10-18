<?php
// namespace app\repository;
namespace App\Repository;

interface TeacherRepositoryInterface{
 public function get_all_teachers();

 public function Getspecialization();

 public function GetGender();
 
 public function StoreTeachers($request);

 // StoreTeachers
 public function editTeachers($id);

 // UpdateTeachers
 public function UpdateTeachers($request);

 // DeleteTeachers
 public function DeleteTeachers($request);

}