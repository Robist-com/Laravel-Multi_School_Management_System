<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAdmissionsAPIRequest;
use App\Http\Requests\API\UpdateAdmissionsAPIRequest;
use App\Models\Admissions;
use App\Repositories\AdmissionsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AdmissionsController
 * @package App\Http\Controllers\API
 */

class AdmissionsAPIController extends AppBaseController
{
    /** @var  AdmissionsRepository */
    private $admissionsRepository;

    public function __construct(AdmissionsRepository $admissionsRepo)
    {
        $this->admissionsRepository = $admissionsRepo;
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
        $admissions = $this->admissionsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($admissions->toArray(), 'Admissions retrieved successfully');
    }

    /**
     * Store a newly created Admissions in storage.
     * POST /admissions
     *
     * @param CreateAdmissionsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAdmissionsAPIRequest $request)
    {
        $input = $request->all();

        $admissions = $this->admissionsRepository->create($input);

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
        /** @var Admissions $admissions */
        $admissions = $this->admissionsRepository->find($id);

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

        /** @var Admissions $admissions */
        $admissions = $this->admissionsRepository->find($id);

        if (empty($admissions)) {
            return $this->sendError('Admissions not found');
        }

        $admissions = $this->admissionsRepository->update($input, $id);

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
        /** @var Admissions $admissions */
        $admissions = $this->admissionsRepository->find($id);

        if (empty($admissions)) {
            return $this->sendError('Admissions not found');
        }

        $admissions->delete();

        return $this->sendSuccess('Admissions deleted successfully');
    }
}
