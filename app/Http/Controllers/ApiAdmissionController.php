<?php

namespace App\Http\Controllers;


use App\Http\Controllers\API\AdmissionController;
use Illuminate\Http\Request;
use App\Models\Admission;
use Response;
use DB;
class ApiAdmissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the Admissions.
     * GET|HEAD /admissions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
       
        // if (request()->ajax()) {
      
            // if (auth()->user()->group == 'Owner') {
    
            $data = Admission::join('departments','departments.department_id', 'admissions.department_id')
                                ->join('faculties','faculties.faculty_id', 'admissions.faculty_id')
                                ->join('rolls','rolls.student_id', 'admissions.id')
                                ->join('batches','batches.id', 'admissions.batch_id')
                                ->join('schools','schools.id', 'admissions.school_id')
                            ->select('admissions.*','departments.*','faculties.*','admissions.id AS student_id',
                                    'batches.*','rolls.username as roll_no','schools.name as school_name',
                                    DB::raw('(CASE 
                                WHEN admissions.gender = "0" THEN "Male" ELSE  "Female" END) AS gender'),
                                DB::raw('CONCAT(admissions.first_name, \' \', admissions.last_name) as full_name')
                                )
                                ->where('admissions.school_id', auth()->user()->school_id)
                                ->get();

            // }else {
    
            //     $data = Admission::join('departments','departments.department_id', 'admissions.department_id')
            //                             ->join('faculties','faculties.faculty_id', 'admissions.faculty_id')
            //                             ->join('rolls','rolls.student_id', 'admissions.id')
            //                             ->join('batches','batches.id', 'admissions.batch_id')
            //                             ->join('schools','schools.id', 'admissions.school_id')
            //                         ->select('admissions.*','departments.*','faculties.*','admissions.id AS student_id',
            //                                 'batches.*','rolls.username as roll_no','schools.name as school_name',
            //                             DB::raw('(CASE 
            //                             WHEN admissions.gender = "0" THEN "Male" ELSE  "Female" END) AS gender'),
            //                             DB::raw('CONCAT(admissions.first_name, \' \', admissions.last_name) as full_name')
            //                             )->get();
    
            // }
    
            return response()->json(['data'=>$data],200);
           
        // }
        // return view('admissions.index');
            // ->toArray(), 'Admissions retrieved successfully');
    }

    /**
     * Store a newly created Admissions in storage.
     * POST /admissions
     *
     * @param CreateAdmissionsAPIRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $admissions = Admissions::create($input);

        return $this->sendResponse($admissions->toArray(), 'Admissions saved successfully');
    }

    /**
     * Display the specified Admissions.
     * GET|HEAD /admissions/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Admission $admissions */
        $admissions = Admission::find($id);

        if (empty($admissions)) {
            return $this->sendError('Admissions not found');
        }

        return $this->sendResponse($admissions->toArray(), 'Admissions retrieved successfully');
    }

    /**
     * Update the specified Admissions in storage.
     * PUT/PATCH /admissions/{id}
     *
     * @param int $id
     * @param UpdateAdmissionsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdmissionsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Admission $admissions */
        $admissions = Admission::find($id);

        if (empty($admissions)) {
            return $this->sendError('Admissions not found');
        }

        $admissions = Admission::update($input, $id);

        return $this->sendResponse($admissions->toArray(), 'Admissions updated successfully');
    }

    /**
     * Remove the specified Admissions from storage.
     * DELETE /admissions/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Admission $admissions */
        $admissions = Admission::find($id);

        if (empty($admissions)) {
            return $this->sendError('Admissions not found');
        }

        $admissions->delete();

        return $this->sendSuccess('Admissions deleted successfully');
    }
}
