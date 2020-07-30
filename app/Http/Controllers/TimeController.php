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
use App\models\Time;
use App\models\Shift;

class TimeController extends AppBaseController
{
    /** @var  TimeRepository */
    private $timeRepository;

    public function __construct(TimeRepository $timeRepo)
    {
        $this->timeRepository = $timeRepo;
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
        $shifts = Shift::all();
        // return $shifts;
        $times = Time::join('shifts', 'shifts.shift_id', '=', 'times.shift_id')->get();
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
    public function store(CreateTimeRequest $request)
    {
        $input = $request->all();

        $time = $this->timeRepository->create($input);

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
        $time = $this->timeRepository->find($id);

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
        $time = $this->timeRepository->find($id);
        $shifts = Shift::all();
        if (empty($time)) {
            Flash::error('Time not found');

            return redirect(route('times.index'));
        }

        return view('times.edit', compact('shifts'))->with('time', $time);
    }

    /**
     * Update the specified Time in storage.
     *
     * @param int $id
     * @param UpdateTimeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTimeRequest $request)
    {
        $time = $this->timeRepository->find($id);

        if (empty($time)) {
            Flash::error('Time not found');

            return redirect(route('times.index'));
        }

        $time = $this->timeRepository->update($request->all(), $id);

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
