<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\ExpenseType;
use App\Income;
use DB;
use Flash;
class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function getExpenses()
    {

        $expenses = Expense::join('expense_types', 'expense_types.id', '=', 'expenses.expense_type_id')
        ->where('expenses.school_id' , auth()->user()->school_id)->select('expense_types.type', 'expenses.*')->get();
        $e_type = DB::table('expense_types')->where('school_id', auth()->user()->school_id)->get();
        $incomes  = Income::all();

        return view('admins.expenses.index', compact('incomes'))->with('expenses', $expenses)->with( 'e_type', $e_type);
    }

    public function saveExpenses(Request $request)
    {
        // dd($request->all());
        $expense_file = $request->file('file_document');

        if (!$expense_file) {
            Flash::error('File is required please provide file!');
            return redirect(route('expenses.index'));
        }else {
            $extension = $expense_file->getClientOriginalExtension();
            $new_image_name = time(). '.' .$extension;
            $expense_file->move(public_path('school_images/expense'), $new_image_name);
        }
        $expense = new Expense;

        $expense->expense_type_id  = $request->expense_type_id;
        $expense->name  = $request->name;
        $expense->amount  = $request->amount;
        $expense->date  = $request->date;
        $expense->invoice_number  = $request->invoice_number;
        $expense->file  = $new_image_name;
        $expense->description  = $request->description;
        $expense->school_id = $request->school_id;
        $expense->save();

        Flash::success('Expense Created Successfully');
        return redirect(route('expenses.index'));
    }

    public function editExpenses($expense_id)
    {
        $expense = Expense::findOrFail($expense_id);
        $expenses = Expense::join('expense_types', 'expense_types.id', '=', 'expenses.expense_type_id')
        ->where('expenses.school_id' , auth()->user()->school_id)->select('expense_types.type', 'expenses.*')->get();
        $e_type = DB::table('expense_types')->where('school_id', auth()->user()->school_id)->get();
        return view('admins.expenses.index')->with('expense', $expense)->with('expenses', $expenses)->with('e_type', $e_type);
    }

    public function updateExpenses(Request $request, $expense_id)
    {
        $file = $request->file('file_document');
        $extension = $file->getClientOriginalExtension();
        $new_image_name = time(). '.' .$extension;
        $file->move(public_path('school_images/expense'), $new_image_name);

        $expenses = array(
        'expense_type_id' => $request->expense_type_id,
        'name' => $request->name,
        'amount' => $request->amount,
        'date' => $request->date,
        'invoice_number' => $request->invoice_number,
        'description' => $request->description,
        'file' => $new_image_name
        );

       // dd($student); die;
        Expense::findOrfail($expense_id)->update($expenses);

        Flash::success('Expense Updated Successfully');
        return redirect(route('expenses.index'));
       
    }

    public function deleteExpenses($expense_id)
    {
        $expenses = Expense::where('school_id' , auth()->user()->school_id)->get();
        return view('admins.expenses.index1')->with('expenses', $expenses);
    }

    public function getExpensesType()
    {
        $expense_type = ExpenseType::where('school_id' , auth()->user()->school_id)->get();
        return view('admins.expenses.table')->with('expense_type', $expense_type);
    }

    public function saveExpensesType (Request $request)
    {

        $expenses_type = new ExpenseType;

        $expenses_type->type = $request->type;
        $expenses_type->school_id = $request->school_id;
        $expenses_type->save();

        Flash::success('Expense Type Created Successfully');
        return redirect(route('expenses.index'));
    }

    public function editExpensesType($expense_id)
    {
        $expen_type = ExpenseType::findOrFail($expense_id);
        $expense_type = ExpenseType::where('school_id' , auth()->user()->school_id)->get();
        return view('admins.expenses.table')->with('expen_type', $expen_type)->with('expense_type', $expense_type);
    }

    public function updateExpensesType($expense_id)
    {
        $expenses = ExpenseType::where('school_id' , auth()->user()->school_id)->get();
        return view('admins.expenses.index')->with('expenses', $expenses);
    }

    public function deleteExpensesType($expense_id)
    {
        $expenses = ExpenseType::where('school_id' , auth()->user()->school_id)->get();
        return view('admins.expenses.index')->with('expenses', $expenses);
    }
}
