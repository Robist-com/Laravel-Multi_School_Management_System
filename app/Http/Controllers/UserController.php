<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Role;
use PDF;
use App\Models\User;
class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all();
        $roles = Role::all();
        return view('users.index', compact('roles'))
            ->with('users', $users );
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();

        $user = $this->userRepository->create($input);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $user = $this->userRepository->update($request->all(), $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Update the specified Admission in storage.
     *
     * @param tinyint $request
     * @param UpdateAdmission  $request
     *
     * @return Response
     */

    public function updateRole1(Request $request)
    {
        $userroles = User::findOrFail($request->role_id);
        $userroles->role_id = $request->role_id;
        dd($userroles);
        $userroles->save();
    
        return response()->json(['message' => 'User role updated successfully.']);
    }

    public function updateUserStatus(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->status = $request->status;
        // dd($userroles);
        $user->save();
    
        return response()->json(['message' => 'User status updated successfully.']);
    }


    public function updateRole(Request $request)
{
        $role_id = $request->role_id;
        $userid = $request->user_id;

       $updateRole = User::where('id',$userid)->update([
                'role_id' => $role_id
       ]);
    //    return redirect(route('users.index'));
       return response()->json(['message' => 'User Role updated successfully.']);
}
    



    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    public function PDFgenerator()
    {
     $users = User::all();
    //  $users = User::join('roles', 'roles.id', '=' ,'users.role_id')->get();
 
    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT 
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('users.pdf',['users'=> $users]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');
 
         // Output the generated PDF to Browser
         $dompdf->stream();
 
         return $dompdf->download('All-Users.pdf');
    }

    public function print($id)
    {
        $users = User::where('id', $id)->get();
        // $users = User::join('roles', 'roles.id', '=' ,'users.role_id')
        //               ->where('users.id', $id)->get();
            // dd( $faculties); die;
        return view('users.print',['users'=> $users]);
    }

    public function PDFgeneratorSingle($id)
    {
        $users = User::where('id', $id)->get();
            // dd( $admissions); die;
            $dompdf = PDF::loadview('users.single_pdf',['users'=> $users]);
                // (Optional) Setup the paper size and orientation
                // $dompdf->setPaper('A4', 'landscape');
        
                // Output the generated PDF to Browser
                $dompdf->stream();
        
                return $dompdf->download('Users.pdf');
    }
}
