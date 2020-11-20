<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShiftRequest;
use App\Http\Requests\UpdateShiftRequest;
use App\Repositories\ShiftRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use PDF;
use App\Models\Shift;

class ShiftController extends AppBaseController
{
    /** @var  ShiftRepository */
    private $shiftRepository;

    public function __construct(ShiftRepository $shiftRepo)
    {
        $this->shiftRepository = $shiftRepo;

			$this->middleware('auth');


    }

    /**
     * Display a listing of the Shift.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $shifts = $this->shiftRepository->all();
        $shifts = Shift::where('school_id', auth()->user()->school->id)->get();

        return view('shifts.index')
            ->with('shifts', $shifts);
    }

    /**
     * Show the form for creating a new Shift.
     *
     * @return Response
     */
    public function create()
    {
        return view('shifts.create');
    }

    /**
     * Store a newly created Shift in storage.
     *
     * @param CreateShiftRequest $request
     *
     * @return Response
     */
    public function store(CreateShiftRequest $request)
    {
        $input = $request->all();

        $shift = $this->shiftRepository->create($input);

        Flash::success('Shift saved successfully.');

        return redirect(route('shifts.index'));
    }

    /**
     * Display the specified Shift.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $shift = $this->shiftRepository->find($id);

        if (empty($shift)) {
            Flash::error('Shift not found');

            return redirect(route('shifts.index'));
        }

        return view('shifts.show')->with('shift', $shift);
    }

    /**
     * Show the form for editing the specified Shift.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $shift = $this->shiftRepository->find($id);
        $shifts = Shift::where('school_id', auth()->user()->school_id)->get();

        if (empty($shift)) {
            Flash::error('Shift not found');

            return redirect(route('shifts.index'));
        }

        return view('shifts.index')->with('shift', $shift)->with('shifts', $shifts);
    }

    /**
     * Update the specified Shift in storage.
     *
     * @param int $id
     * @param UpdateShiftRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateShiftRequest $request)
    {
        $shift = $this->shiftRepository->find($id);

        if (empty($shift)) {
            Flash::error('Shift not found');

            return redirect(route('shifts.index'));
        }

        $shift = $this->shiftRepository->update($request->all(), $id);

        Flash::success('Shift updated successfully.');

        return redirect(route('shifts.index'));
    }

    public function updateShiftStatus(Request $request)
    {
        $shift = Shift::findOrFail($request->shift_id);
        $shift->status = $request->status;
        $shift->save();
    
        return response()->json(['message' => 'Shift status updated successfully.']);
    }
  

    /**
     * Remove the specified Shift from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $shift = $this->shiftRepository->find($id);

        if (empty($shift)) {
            Flash::error('Shift not found');

            return redirect(route('shifts.index'));
        }

        $this->shiftRepository->delete($id);

        Flash::success('Shift deleted successfully.');

        return redirect(route('shifts.index'));
    }

    public function PDFgenerator()
    {
     $shifts = Shift::all();
 
    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT 
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('shifts.pdf',['shifts'=> $shifts]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');
 
         // Output the generated PDF to Browser
         $dompdf->stream();
 
         return $dompdf->download('All-Shifts.pdf');
    }
}
