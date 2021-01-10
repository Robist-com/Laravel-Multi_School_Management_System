<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeeStructureRequest;
use App\Http\Requests\UpdateFeeStructureRequest;
use App\Repositories\FeeStructureRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Semester;
use App\Models\Course;
use App\Models\FeeStructure;
use App\Models\Level;

class HomeFeeStructureController extends AppBaseController
{
    /** @var  FeeStructureRepository */
    private $feeStructureRepository;

    public function __construct(FeeStructureRepository $feeStructureRepo)
    {
        $this->feeStructureRepository = $feeStructureRepo;

			$this->middleware('auth');


    }

    /**
     * Display a listing of the FeeStructure.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $semesters = Semester::all();
        $courses = Course::all();
        $levels = Level::all();
        $feeStructures = $this->feeStructureRepository->all();

        $feeStructures = FeeStructure::join('courses', 'courses.id', '=', 'fee_structures.course_id')
                                     ->join('levels', 'levels.level_id', '=', 'fee_structures.level_id')
                                     ->join('semesters', 'semesters.semester_id', '=', 'fee_structures.semester_id')
                                     ->orderBy('semesters.semester_id')->paginate(10);
        return view('fee_structures.index', compact('semesters','courses','levels'))
            ->with('feeStructures', $feeStructures);
    }

    public function DynamicLevels(Request $request){

        if ($request->ajax()) {
            return response(Level::where('course_id', $request->course_id)->get());
        }

}

    /**
     * Show the form for creating a new FeeStructure.
     *
     * @return Response
     */
    public function create()
    {
        return view('fee_structures.create');
    }

    /**
     * Store a newly created FeeStructure in storage.
     *
     * @param CreateFeeStructureRequest $request
     *
     * @return Response
     */
    public function store(CreateFeeStructureRequest $request)
    {
        $input = $request->all();

        $feeStructure = $this->feeStructureRepository->create($input);

        Flash::success('Fee Structure saved successfully.');

        return redirect(route('feeStructures.index'));
    }

    /**
     * Display the specified FeeStructure.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $feeStructure = $this->feeStructureRepository->find($id);

        if (empty($feeStructure)) {
            Flash::error('Fee Structure not found');

            return redirect(route('feeStructures.index'));
        }

        return view('fee_structures.show')->with('feeStructure', $feeStructure);
    }

    /**
     * Show the form for editing the specified FeeStructure.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $feeStructure = $this->feeStructureRepository->find($id);

        if (empty($feeStructure)) {
            Flash::error('Fee Structure not found');

            return redirect(route('feeStructures.index'));
        }

        return view('fee_structures.edit')->with('feeStructure', $feeStructure);
    }

    /**
     * Update the specified FeeStructure in storage.
     *
     * @param int $id
     * @param UpdateFeeStructureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeeStructureRequest $request)
    {
        $feeStructure = $this->feeStructureRepository->find($id);

        if (empty($feeStructure)) {
            Flash::error('Fee Structure not found');

            return redirect(route('feeStructures.index'));
        }

        $feeStructure = $this->feeStructureRepository->update($request->all(), $id);

        Flash::success('Fee Structure updated successfully.');

        return redirect(route('feeStructures.index'));
    }

    /**
     * Remove the specified FeeStructure from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $feeStructure = $this->feeStructureRepository->find($id);

        if (empty($feeStructure)) {
            Flash::error('Fee Structure not found');

            return redirect(route('feeStructures.index'));
        }

        $this->feeStructureRepository->delete($id);

        Flash::success('Fee Structure deleted successfully.');

        return redirect(route('feeStructures.index'));
    }
}
