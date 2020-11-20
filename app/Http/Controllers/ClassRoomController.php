<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;
use App\Repositories\ClassRoomRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use PDF;
use App\Models\ClassRoom;
class ClassRoomController extends AppBaseController
{
    /** @var  ClassRoomRepository */
    private $classRoomRepository;

    public function __construct(ClassRoomRepository $classRoomRepo)
    {
        $this->classRoomRepository = $classRoomRepo;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the ClassRoom.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // $classRooms = $this->classRoomRepository->all();

        if (auth()->user()->group == "Owner") {
            $classRooms = ClassRoom::where('school_id', auth()->user()->school->id)->get();

        }else {
            $classRooms = $this->classRoomRepository->all();
        }

        return view('class_rooms.index')
            ->with('classRooms', $classRooms);
    }

    /**
     * Show the form for creating a new ClassRoom.
     *
     * @return Response
     */
    public function create()
    {
        return view('class_rooms.create');
    }

    /**
     * Store a newly created ClassRoom in storage.
     *
     * @param CreateClassRoomRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $classRoom = $this->classRoomRepository->create($input);

        if ($classRoom) {
            Flash::success('Class Room saved successfully.');
        }else {
            Flash::error('Class Room unable to save successfully. Try again!');
        }


        return redirect(route('classRooms.index'));
    }

    /**
     * Display the specified ClassRoom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $classRoom = $this->classRoomRepository->find($id);

        if (empty($classRoom)) {
            Flash::error('Class Room not found');

            return redirect(route('classRooms.index'));
        }

        return view('class_rooms.show')->with('classRoom', $classRoom);
    }

    /**
     * Show the form for editing the specified ClassRoom.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $classRoom = $this->classRoomRepository->find($id);
        $classRooms = ClassRoom::where('school_id', auth()->user()->school->id)->get();

        if (empty($classRoom)) {
            Flash::error('Class Room not found');

            return redirect(route('classRooms.index'));
        }

        return view('class_rooms.index')->with('classRoom', $classRoom)->with('classRooms', $classRooms);
    }

    /**
     * Update the specified ClassRoom in storage.
     *
     * @param int $id
     * @param UpdateClassRoomRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClassRoomRequest $request)
    {
        $classRoom = $this->classRoomRepository->find($id);

        if (empty($classRoom)) {
            Flash::error('Class Room not found');

            return redirect(route('classRooms.index'));
        }

        $classRoom = $this->classRoomRepository->update($request->all(), $id);

        Flash::success('Class Room updated successfully.');

        return redirect(route('classRooms.index'));
    }

    public function updateClassroomStatus(Request $request)
    {
        $classroom = ClassRoom::findOrFail($request->classroom_id);
        $classroom->classroom_status = $request->status;
        $classroom->save();
    
        return response()->json(['message' => 'ClassRoom status updated successfully.']);
    }
  

    /**
     * Remove the specified ClassRoom from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $classRoom = $this->classRoomRepository->find($id);

        if (empty($classRoom)) {
            Flash::error('Class Room not found');

            return redirect(route('classRooms.index'));
        }

        $this->classRoomRepository->delete($id);

        Flash::success('Class Room deleted successfully.');

        return redirect(route('classRooms.index'));
    }

    
    public function PDFgenerator()
    {
     $classrooms = ClassRoom::all();
 
    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT 
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('class_rooms.pdf',['classrooms'=> $classrooms]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');
 
         // Output the generated PDF to Browser
         $dompdf->stream();
 
         return $dompdf->download('All-ClassRooms.pdf');
    }
}
