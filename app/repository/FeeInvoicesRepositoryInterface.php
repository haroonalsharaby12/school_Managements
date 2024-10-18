<?php
// namespace app\repository;
namespace App\Repository;

interface FeeInvoicesRepositoryInterface{

 public function index();

 public function show($id);

 public function store($request);


}