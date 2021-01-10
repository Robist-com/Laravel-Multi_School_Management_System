<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Income;
use App\IncomeType;
use DB;
use Flash;
class IncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getIncome()
    {

        $incomes = Income::join('income_types', 'income_types.id', '=', 'incomes.income_type_id')
        ->where('incomes.school_id' , auth()->user()->school_id)->select('Income_types.type', 'incomes.*')->get();
        $inc_type = DB::table('Income_types')->where('school_id', auth()->user()->school_id)->get();

        return view('admins.incomes.index')->with('incomes', $incomes)->with( 'inc_type', $inc_type);
    }

    public function saveIncome(Request $request)
    {
        // dd($request->all());
        $expense_file = $request->file('file_document');

        if (!$expense_file) {
            Flash::error('File is required please provide file!');
            return redirect(route('incomes.index'));
        }else {
            $extension = $expense_file->getClientOriginalExtension();
            $new_image_name = time(). '.' .$extension;
            $expense_file->move(public_path('school_images/Income'), $new_image_name);
        }
        $income = new Income;

        $income->income_type_id  = $request->income_type_id;
        $income->name  = $request->name;
        $income->amount  = $request->amount;
        $income->date  = $request->date;
        $income->invoice_number  = $request->invoice_number;
        $income->file  = $new_image_name;
        $income->description  = $request->description;
        $income->school_id = $request->school_id;
        $income->save();

        Flash::success('Income Created Successfully');
        return redirect(route('income.index'));
    }

    public function editIncome($expense_id)
    {
        $income = Income::findOrFail($expense_id);
        $incomes = Income::where('school_id' , auth()->user()->school_id)->get();
        $inc_type = IncomeType::where('school_id', auth()->user()->school_id)->get();
        return view('admins.incomes.index')->with('income', $income)->with('incomes', $incomes)->with('inc_type', $inc_type);
    }

    public function updateIncome(Request $request, $expense_id)
    {
        $file = $request->file('file_document');
        $extension = $file->getClientOriginalExtension();
        $new_image_name = time(). '.' .$extension;
        $file->move(public_path('school_images/income'), $new_image_name);

        $incomes = array(
        'income_type_id' => $request->income_type_id,
        'name' => $request->name,
        'amount' => $request->amount,
        'date' => $request->date,
        'invoice_number' => $request->invoice_number,
        'description' => $request->description,
        'file' => $new_image_name
        );

       // dd($student); die;
        Income::findOrfail($expense_id)->update($incomes);

        Flash::success('Income Updated Successfully');
        return redirect(route('income.index'));
       
    }

    public function deleteIncome($expense_id)
    {
        $incomes = Income::where('school_id' , auth()->user()->school_id)->get();
        return view('admins.incomes.index1')->with('incomes', $incomes);
    }

    public function getIncomeType ()
    {
        $incomes_type = IncomeType::where('school_id' , auth()->user()->school_id)->get();
        return view('admins.incomes.table')->with('incomes_type', $incomes_type);
    }

    public function saveIncomeType (Request $request)
    {

        $expenses_type = new IncomeType;

        $expenses_type->type = $request->type;
        $expenses_type->school_id = $request->school_id;
        $expenses_type->save();

        Flash::success('Income Type Created Successfully');
        return redirect(route('income.index'));
    }

    public function editIncomeType($income_id)
    {
        $income_type = IncomeType::findOrFail($income_id);
        $incomes_type = IncomeType::where('school_id' , auth()->user()->school_id)->get();
        return view('admins.incomes.table')->with('income_type', $income_type)->with('incomes_type', $incomes_type);
    }

    public function updateIncomeType(Request $request, $income_id)
    {
        $incomes = array(
            'type' => $request->type,
            );
    
        //    dd($incomes); die;
           IncomeType::findOrfail($income_id)->update($incomes);
    
            Flash::success('Income Type Updated Successfully');
            return redirect(url('get/incometype'));
    }

    public function deleteIncomeType($income_id)
    {
        $incomes = IncomeType::where('school_id' , auth()->user()->school_id)->get();
        return view('admins.incomes.index')->with('incomes', $incomes);
    }
}
