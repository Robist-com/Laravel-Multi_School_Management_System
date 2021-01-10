<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFacultyRequest;
use App\Http\Requests\UpdateFacultyRequest;
use App\Repositories\FacultyRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Department;
use Illuminate\Http\Request;
use Flash;
use App\Models\Faculty;
use Response;
use PDF;
class FacultyController extends AppBaseController
{
    /** @var  FacultyRepository */
    private $facultyRepository;

    public function __construct(FacultyRepository $facultyRepo)
    {
        $this->facultyRepository = $facultyRepo;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the Faculty.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
                $departments = Department::where('school_id', auth()->user()->school->id)->count();
                // dd($department);
        if (auth()->user()->group == "Owner") {

            $faculties = Faculty::where('school_id', auth()->user()->school->id)->get();

        }else {

            $faculties = $this->facultyRepository->all();
        }

       
            // dd($faculties);
        return view('faculties.index', compact('departments'))
            ->with('faculties', $faculties);
    }

    /**
     * Show the form for creating a new Faculty.
     *
     * @return Response
     */
    public function create()
    {
        return view('faculties.create');
    }

    /**
     * Store a newly created Faculty in storage.
     *
     * @param CreateFacultyRequest $request
     *
     * @return Response
     */
    public function store(CreateFacultyRequest $request)
    {
        $input = $request->all();


        // echo "<pre>"; print_r( $input);  die;

        // $faculty = $this->facultyRepository->create($input);

        $faculty = new Faculty;
        $faculty->faculty_name = $request->faculty_name;
        $faculty->faculty_code = $request->faculty_code;
        $faculty->faculty_status = $request->faculty_status;
        $faculty->school_id = $request->school_id;
        $faculty->save();


        Flash::success( $request->faculty_name. " saved successfully");

        return redirect(route('faculties.index'));
    }

    /**
     * Display the specified Faculty.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $faculty = $this->facultyRepository->find($id);

        if (empty($faculty)) {
            Flash::error('Faculty not found');

            return redirect(route('faculties.index'));
        }

        return view('faculties.show')->with('faculty', $faculty);
    }

    /**
     * Show the form for editing the specified Faculty.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $faculty = $this->facultyRepository->find($id);

       if (auth()->user()->group == "Owner") {

            $faculties = Faculty::where('school_id', auth()->user()->school->id)->get();

        }else {
            $faculties = Faculty::all();
        }

        if (empty($faculty)) {
            Flash::error('Faculty not found');

            return redirect(route('faculties.index'));
        }

        return view('faculties.index')->with('faculty', $faculty)->with('faculties', $faculties);
    }

    /**
     * Update the specified Faculty in storage.
     *
     * @param int $id
     * @param UpdateFacultyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFacultyRequest $request)
    {
        $faculty = $this->facultyRepository->find($id);

        if (empty($faculty)) {
            Flash::error('Faculty not found');

            return redirect(route('faculties.index'));
        }

        $faculty = $this->facultyRepository->update($request->all(), $id);

        Flash::success('Faculty updated successfully.');

        return redirect(route('faculties.index'));
    }

    public function updateStatus(Request $request)
{
    $faculty = Faculty::findOrFail($request->faculty_id);
    $faculty->faculty_status = $request->status;
    $faculty->save();

    return response()->json(['message' => 'Faculty status updated successfully.']);
}

    /**
     * Remove the specified Faculty from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $faculty = $this->facultyRepository->find($id);

        if (empty($faculty)) {
            Flash::error('Faculty not found');

            return redirect(route('faculties.index'));
        }

        $this->facultyRepository->delete($id);

        Flash::success('Faculty deleted successfully.');

        return redirect(route('faculties.index'));
    }

    public function PDFgenerator()
    {
     $faculties = Faculty::all();
 
    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT 
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('faculties.pdf',['faculties'=> $faculties]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');
 
         // Output the generated PDF to Browser
         $dompdf->stream();
 
         return $dompdf->download('All-faculties.pdf');
    }

    public function print($id)
    {

        $faculties = Faculty::where('faculty_id', $id)->get();
            // dd( $faculties); die;
        return view('faculties.print',['faculties'=> $faculties]);
    }

    public function PDFgeneratorSingle($id)
    {
        $faculties = Faculty::where('faculty_id', $id)->get();
            // dd( $admissions); die;
            $dompdf = PDF::loadview('faculties.single_pdf',['faculties'=> $faculties]);
                // (Optional) Setup the paper size and orientation
                $dompdf->setPaper('A4', 'landscape');
        
                // Output the generated PDF to Browser
                $dompdf->stream();
        
                return $dompdf->download('Faculty.pdf');
    }
}
