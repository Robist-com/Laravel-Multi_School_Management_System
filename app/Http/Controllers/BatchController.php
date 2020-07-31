<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBatchRequest;
use App\Http\Requests\UpdateBatchRequest;
use App\Repositories\BatchRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use PDF;
use App\Models\Batch;
class BatchController extends AppBaseController
{
    /** @var  BatchRepository */
    private $batchRepository;

    public function __construct(BatchRepository $batchRepo)
    {
        $this->batchRepository = $batchRepo;
    }

    /**
     * Display a listing of the Batch.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $batches = $this->batchRepository->all();

        return view('batches.index')
            ->with('batches', $batches);
    }

    /**
     * Show the form for creating a new Batch.
     *
     * @return Response
     */
    public function create()
    {
        return view('batches.create');
    }

    /**
     * Store a newly created Batch in storage.
     *
     * @param CreateBatchRequest $request
     *
     * @return Response
     */
    public function store(CreateBatchRequest $request)
    {
        $input = $request->all();

        $batch = $this->batchRepository->create($input);

        Flash::success( $batch,'saved successfully.');

        return redirect(route('batches.index'));
    }

    /**
     * Display the specified Batch.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $batch = $this->batchRepository->find($id);

        if (empty($batch)) {
            Flash::error('Batch not found');

            return redirect(route('batches.index'));
        }

        return view('batches.show')->with('batch', $batch);
    }

    /**
     * Show the form for editing the specified Batch.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $batch = $this->batchRepository->find($id);

        if (empty($batch)) {
            Flash::error('Batch not found');

            return redirect(route('batches.index'));
        }

        return view('batches.edit')->with('batch', $batch);
    }

    /**
     * Update the specified Batch in storage.
     *
     * @param int $id
     * @param UpdateBatchRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBatchRequest $request)
    {
        $batch = $this->batchRepository->find($id);

        if (empty($batch)) {
            Flash::error('Batch not found');

            return redirect(route('batches.index'));
        }

        $batch = $this->batchRepository->update($request->all(), $id);

        Flash::success('Batch updated successfully.');

        return redirect(route('batches.index'));
    }

    public function updateBatchStatus(Request $request)
    {
        $batch = Batch::findOrFail($request->batch_id);
        $batch->is_current_batch = $request->is_current_batch;
        $batch->save();
    
        return response()->json(['message' => 'Batch status updated successfully.']);
    }
    
   

    /**
     * Remove the specified Batch from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $batch = $this->batchRepository->find($id);

        if (empty($batch)) {
            Flash::error('Batch not found');

            return redirect(route('batches.index'));
        }

        $this->batchRepository->delete($id);

        Flash::success('Batch deleted successfully.');

        return redirect(route('batches.index'));
    }

    public function PDFgenerator()
    {
     $batches = Batch::all();
 
    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT 
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('batches.pdf',['batches'=> $batches]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');
 
         // Output the generated PDF to Browser
         $dompdf->stream();
 
         return $dompdf->download('All-Batches.pdf');
    }

    public function print($id)
    {
        $batches = Batch::where('id', $id)->get();
        // $users = User::join('roles', 'roles.id', '=' ,'users.role_id')
        //               ->where('users.id', $id)->get();
            // dd( $faculties); die;
        return view('batches.print',['batches'=> $batches]);
    }

    public function PDFgeneratorSingle($id)
    {
        $batches = Batch::where('id', $id)->get();
            // dd( $admissions); die;
            $dompdf = PDF::loadview('batches.single_pdf',['batches'=> $batches]);
                // (Optional) Setup the paper size and orientation
                // $dompdf->setPaper('A4', 'landscape');
        
                // Output the generated PDF to Browser
                $dompdf->stream();
        
                return $dompdf->download('Batch.pdf');
    }
}
