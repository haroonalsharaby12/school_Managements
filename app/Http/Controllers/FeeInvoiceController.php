<?php

namespace App\Http\Controllers;

use App\Models\Fee_invoice;
use Illuminate\Http\Request;
use App\Repository\FeeInvoicesRepositoryInterface;

class FeeInvoiceController extends Controller
{
  
    protected $Fees_Invoices;
    public function __construct(FeeInvoicesRepositoryInterface $Fees_Invoices)
    {

        $this->Fees_Invoices = $Fees_Invoices;
    }

    public function index()
    {
        return $this->Fees_Invoices->index();
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->Fees_Invoices->store($request);
    }


    public function show($id)
    {
        return $this->Fees_Invoices->show($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}