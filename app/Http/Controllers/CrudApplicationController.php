<?php

namespace App\Http\Controllers;

use App\Crud_Application;
use DataTables;
use Illuminate\Http\Request;

class CrudApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if ($request->ajax()) {
            $data = Crud_Application::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $actionbtn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm editUser">Edit</a>';
   
                           $actionbtn = $actionbtn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteUser">Delete</a>';
    
                            return $actionbtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Crud_Application::updateOrCreate(['id' => $request->user_id],
                ['first_name' => $request->first_name, 'last_name' => $request->last_name, 'phone' => $request->phone]);        
   
        return response()->json(['success'=>'User saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Crud_Application  $crud_Application
     * @return \Illuminate\Http\Response
     */
    public function show(Crud_Application $crud_Application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Crud_Application  $crud_Application
     * @return \Illuminate\Http\Response
     */
    public function edit(Crud_Application $crud_Application)
    {
        $CrudApplication = Crud_Application::find($crud_Application);
        return response()->json($CrudApplication);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Crud_Application  $crud_Application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crud_Application $crud_Application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Crud_Application  $crud_Application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crud_Application $crud_Application)
    {
        Crud_Application::find($crud_Application)->delete();
     
        return response()->json(['success'=>'User deleted successfully.']);
    }
}
