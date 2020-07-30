<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeesRequest;
use App\Http\Requests\UpdateFeesRequest;
use App\Repositories\FeesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class FeesController extends AppBaseController
{
    /** @var  FeesRepository */
    private $feesRepository;

    public function __construct(FeesRepository $feesRepo)
    {
        $this->feesRepository = $feesRepo;
    }

    /**
     * Display a listing of the Fees.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $fees = $this->feesRepository->all();

        return view('fees.index')
            ->with('fees', $fees);
    }

    /**
     * Show the form for creating a new Fees.
     *
     * @return Response
     */
    public function create()
    {
        return view('fees.create');
    }

    /**
     * Store a newly created Fees in storage.
     *
     * @param CreateFeesRequest $request
     *
     * @return Response
     */
    public function store(CreateFeesRequest $request)
    {
        $input = $request->all();

        $fees = $this->feesRepository->create($input);

        Flash::success('Fees saved successfully.');

        return redirect(route('fees.index'));
    }

    /**
     * Display the specified Fees.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fees = $this->feesRepository->find($id);

        if (empty($fees)) {
            Flash::error('Fees not found');

            return redirect(route('fees.index'));
        }

        return view('fees.show')->with('fees', $fees);
    }

    /**
     * Show the form for editing the specified Fees.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fees = $this->feesRepository->find($id);

        if (empty($fees)) {
            Flash::error('Fees not found');

            return redirect(route('fees.index'));
        }

        return view('fees.edit')->with('fees', $fees);
    }

    /**
     * Update the specified Fees in storage.
     *
     * @param int $id
     * @param UpdateFeesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFeesRequest $request)
    {
        $fees = $this->feesRepository->find($id);

        if (empty($fees)) {
            Flash::error('Fees not found');

            return redirect(route('fees.index'));
        }

        $fees = $this->feesRepository->update($request->all(), $id);

        Flash::success('Fees updated successfully.');

        return redirect(route('fees.index'));
    }

    /**
     * Remove the specified Fees from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fees = $this->feesRepository->find($id);

        if (empty($fees)) {
            Flash::error('Fees not found');

            return redirect(route('fees.index'));
        }

        $this->feesRepository->delete($id);

        Flash::success('Fees deleted successfully.');

        return redirect(route('fees.index'));
    }
}
