<?php


namespace App\Repository;

use App\Models\fund_accounts;
use App\Models\FundAccount;
use App\Models\PaymentStudents;
use App\Models\PaymentStudentss;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function index()
    {
     
        $payment_students = PaymentStudents::all();
        return view('Payment.index',compact('payment_students'));
    }

    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('Payment.add',compact('student'));
    }

    public function edit($id)
    {
        $payment_student = PaymentStudents::findorfail($id);
        return view('Payment.edit',compact('payment_student'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            // حفظ البيانات في جدول سندات الصرف
            $payment_students = new PaymentStudents();
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->Debit;
            $payment_students->description = $request->description;
            $payment_students->save();


            // حفظ البيانات في جدول الصندوق
            $fund_accounts = new fund_accounts();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $payment_students->id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = new StudentAccount();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Payment_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {

            // تعديل البيانات في جدول سندات الصرف
            $payment_students = PaymentStudents::findorfail($request->id);
            $payment_students->date = date('Y-m-d');
            $payment_students->student_id = $request->student_id;
            $payment_students->amount = $request->Debit;
            $payment_students->description = $request->description;
            $payment_students->save();


            // حفظ البيانات في جدول الصندوق
            $fund_accounts = fund_accounts::where('payment_id',$request->id)->first();
            $fund_accounts->date = date('Y-m-d');
            $fund_accounts->payment_id = $payment_students->id;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->credit = $request->Debit;
            $fund_accounts->description = $request->description;
            $fund_accounts->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = StudentAccount::where('payment_id',$request->id)->first();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $payment_students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Payment_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            PaymentStudents::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}