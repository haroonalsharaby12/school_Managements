<?php
namespace App\Repository;

use App\Models\Fee;
use App\Models\Fee_invoice;
use App\Models\Grade;
use App\Models\student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class FeeInvoicesRepository implements FeeInvoicesRepositoryInterface {

    public function index()
    {
        
        $Fee_invoices = Fee_invoice::all();
        $Grades = Grade::all();
        return view('Fees_Invoices.index',compact('Fee_invoices','Grades'));
    }

    public function show($id)
    {   
        $student = student::findorfail($id);
        $fees = Fee::where('Classroom_id',$student->Classroom_id)->get();
        return view('Fees_Invoices.add',compact('student','fees'));
    }

    public function store($request)
    {
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = new Fee_invoice();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->Grade_id = $request->Grade_id;
                $Fees->Classroom_id = $request->Classroom_id;;
                $Fees->fee_id = $List_Fee['fee_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = $List_Fee['description'];
                $Fees->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new StudentAccount();
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->type = 'invoice';
                $StudentAccount->fee_invoice_id = $Fees->id;
                $StudentAccount->student_id = $List_Fee['student_id'];
                $StudentAccount->Debit = $List_Fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_Fee['description'];
                $StudentAccount->save();
            }

            DB::commit();
            
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}