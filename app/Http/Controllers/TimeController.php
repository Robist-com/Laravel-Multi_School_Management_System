<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTimeRequest;
use App\Http\Requests\UpdateTimeRequest;
use App\Repositories\TimeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use PDF;
use App\Models\Time;
use App\Models\Shift;

class TimeController extends AppBaseController
{
    /** @var  TimeRepository */
    private $timeRepository;

    public function __construct(TimeRepository $timeRepo)
    {
        $this->timeRepository = $timeRepo;

			$this->middleware('auth');

    }

    /**
     * Display a listing of the Time.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->group == "Owner") {
                $shifts = Shift::where('school_id', auth()->user()->school->id)->get();
                $times = Time::join('shifts', 'shifts.shift_id', '=', 'times.shift_id')
                ->select('times.*', 'shifts.shift')
                ->where('shifts.school_id', auth()->user()->school->id)->get();
        }else {
            $shifts = Shift::all();
                $times = Time::join('shifts', 'shifts.shift_id', '=', 'times.shift_id')
                ->select('times.*', 'shifts.shift')
                ->get();
        }
        return view('times.index',compact('shifts'))
            ->with('times', $times, 'shifts', $shifts);
    }

    /**
     * Show the form for creating a new Time.
     *
     * @return Response
     */
    public function create()
    {
        return view('times.create');
    }

    /**
     * Store a newly created Time in storage.
     *
     * @param CreateTimeRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // dd($input);

        $shift_exist = Time::where(['school_id' => auth()->user()->school_id, 'shift_id' => $request->shift_id, 'time' => $request->time, 'end_time' => $request->end_time])->count();

        if ($shift_exist > 0) {

            Flash::Error('Time with ' .$request->shift_id. ' already exist!.');

            return redirect(route('times.index'));
        }
        $time = Time::create($input);

        Flash::success('Time saved successfully.');

        return redirect(route('times.index'));
    }

    /**
     * Display the specified Time.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $time = Time::find($id);

        if (empty($time)) {
            Flash::error('Time not found');

            return redirect(route('times.index'));
        }

        return view('times.show')->with('time', $time);
    }

    /**
     * Show the form for editing the specified Time.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $time = Time::find($id);
        $shifts = Shift::where('school_id', auth()->user()->school_id)->get();
        // return $shifts;
        $times = Time::join('shifts', 'shifts.shift_id', '=', 'times.shift_id')
                    ->select('times.*', 'shifts.shift')
                    ->where('shifts.school_id', auth()->user()->school->id)->get();
        if (empty($time)) {
            Flash::error('Time not found');

            return redirect(route('times.index'));
        }

        return view('times.index', compact('shifts','times'))->with('time', $time);
    }

    /**
     * Update the specified Time in storage.
     *
     * @param int $id
     * @param UpdateTimeRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $time = Time::find($id);

        if (empty($time)) {
            Flash::error('Time not found');

            return redirect(route('times.index'));
        }

        // dd($time);
        $time->update($request->all());

        Flash::success('Time updated successfully.');

        return redirect(route('times.index'));
    }


    public function updateTimeStatus(Request $request)
    {
        $time = Time::findOrFail($request->time_id);
        $time->status = $request->status;
        // dd($time);
        $time->save();

        return response()->json(['message' => 'Time status updated successfully.']);
    }
    /**
     * Remove the specified Time from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $time = $this->timeRepository->find($id);

        if (empty($time)) {
            Flash::error('Time not found');

            return redirect(route('times.index'));
        }

        $this->timeRepository->delete($id);

        Flash::success('Time deleted successfully.');

        return redirect(route('times.index'));
    }

    public function PDFgenerator()
    {
     $times = Time::join('shifts','shifts.shift_id', '=', 'times.shift_id')->get();

    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('times.pdf',['times'=> $times]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');

         // Output the generated PDF to Browser
         $dompdf->stream();

         return $dompdf->download('All-Times.pdf');
    }
}
