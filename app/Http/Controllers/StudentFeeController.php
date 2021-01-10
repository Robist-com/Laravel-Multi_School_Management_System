<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentFeeRequest;
use App\Http\Requests\UpdateStudentFeeRequest;
use App\Repositories\StudentFeeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class StudentFeeController extends AppBaseController
{
    /** @var  StudentFeeRepository */
    private $studentFeeRepository;

    public function __construct(StudentFeeRepository $studentFeeRepo)
    {
        $this->studentFeeRepository = $studentFeeRepo;

			$this->middleware('auth');


    }

    /**
     * Display a listing of the StudentFee.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $studentFees = $this->studentFeeRepository->all();

        return view('student_fees.index')
            ->with('studentFees', $studentFees);
    }

    /**
     * Show the form for creating a new StudentFee.
     *
     * @return Response
     */
    public function create()
    {
        return view('student_fees.create');
    }

    /**
     * Store a newly created StudentFee in storage.
     *
     * @param CreateStudentFeeRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentFeeRequest $request)
    {
        $input = $request->all();

        $studentFee = $this->studentFeeRepository->create($input);

        Flash::success('Student Fee saved successfully.');

        return redirect(route('studentFees.index'));
    }

    /**
     * Display the specified StudentFee.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $studentFee = $this->studentFeeRepository->find($id);

        if (empty($studentFee)) {
            Flash::error('Student Fee not found');

            return redirect(route('studentFees.index'));
        }

        return view('student_fees.show')->with('studentFee', $studentFee);
    }

    /**
     * Show the form for editing the specified StudentFee.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $studentFee = $this->studentFeeRepository->find($id);

        if (empty($studentFee)) {
            Flash::error('Student Fee not found');

            return redirect(route('studentFees.index'));
        }

        return view('student_fees.edit')->with('studentFee', $studentFee);
    }

    /**
     * Update the specified StudentFee in storage.
     *
     * @param int $id
     * @param UpdateStudentFeeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentFeeRequest $request)
    {
        $studentFee = $this->studentFeeRepository->find($id);

        if (empty($studentFee)) {
            Flash::error('Student Fee not found');

            return redirect(route('studentFees.index'));
        }

        $studentFee = $this->studentFeeRepository->update($request->all(), $id);

        Flash::success('Student Fee updated successfully.');

        return redirect(route('studentFees.index'));
    }

    /**
     * Remove the specified StudentFee from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $studentFee = $this->studentFeeRepository->find($id);

        if (empty($studentFee)) {
            Flash::error('Student Fee not found');

            return redirect(route('studentFees.index'));
        }

        $this->studentFeeRepository->delete($id);

        Flash::success('Student Fee deleted successfully.');

        return redirect(route('studentFees.index'));
    }
}
