<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDayRequest;
use App\Http\Requests\UpdateDayRequest;
use App\Repositories\DayRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use PDF;
use App\Models\Day;
class DayController extends AppBaseController
{
    /** @var  DayRepository */
    private $dayRepository;

    public function __construct(DayRepository $dayRepo)
    {
        $this->dayRepository = $dayRepo;
    }

    /**
     * Display a listing of the Day.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $days = $this->dayRepository->all();

        $days = Day::where('school_id', auth()->user()->school->id)->get();
        return view('days.index')
            ->with('days', $days);
    }

    /**
     * Show the form for creating a new Day.
     *
     * @return Response
     */
    public function create()
    {
        return view('days.create');
    }

    /**
     * Store a newly created Day in storage.
     *
     * @param CreateDayRequest $request
     *
     * @return Response
     */
    public function store(CreateDayRequest $request)
    {
        $input = $request->all();
            // dd( $input);
            $check_exist = Day::where(['name' => $request->name, 'school_id' => auth()->user()->school_id])->count();

        if ($check_exist > 0) {

            Flash::error('Day name '. $request->name . ' is already exist!.');
            return back();
        }
        $day = $this->dayRepository->create($input);

        Flash::success('Day saved successfully.');

        return redirect(route('days.index'));
    }

    /**
     * Display the specified Day.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $day = $this->dayRepository->find($id);

        if (empty($day)) {
            Flash::error('Day not found');

            return redirect(route('days.index'));
        }

        return view('days.show')->with('day', $day);
    }

    /**
     * Show the form for editing the specified Day.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $day = $this->dayRepository->find($id); 
        $days = Day::where('school_id', auth()->user()->school_id)->get();

        if (empty($day)) {
            Flash::error('Day not found');

            return redirect(route('days.index'));
        }

        return view('days.index')->with('day', $day)->with('days', $days);
    }

    /**
     * Update the specified Day in storage.
     *
     * @param int $id
     * @param UpdateDayRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDayRequest $request)
    {
        $day = $this->dayRepository->find($id);

        if (empty($day)) {
            Flash::error('Day not found');

            return redirect(route('days.index'));
        }

        // $check_exist = Day::where(['name' => $request->name, 'school_id' => auth()->user()->school_id, 'status' => ''])->count();

        $day = $this->dayRepository->update($request->all(), $id);

        Flash::success('Day updated successfully.');

        // if ($check_exist > 0 ) {

        //     Flash::error('Day name '. $request->name . ' is already exist!.');
        //     return back();
        // }

        return redirect(route('days.index'));
    }

    public function updateDayStatus(Request $request)
    {
        $day = Day::findOrFail($request->day_id);
        $day->status = $request->status;
        $day->save();
    
        return response()->json(['message' => 'Day status updated successfully.']);
    }

    /**
     * Remove the specified Day from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $day = $this->dayRepository->find($id);

        if (empty($day)) {
            Flash::error('Day not found');

            return redirect(route('days.index'));
        }

        $this->dayRepository->delete($id);

        Flash::success('Day deleted successfully.');

        return redirect(route('days.index'));
    }

    public function PDFgenerator()
    {
     $days = Day::all();
 
    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT 
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('days.pdf',['days'=> $days]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');
 
         // Output the generated PDF to Browser
         $dompdf->stream();
 
         return $dompdf->download('All-Days.pdf');
    }
}
