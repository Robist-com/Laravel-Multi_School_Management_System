<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use PDF;
use App\Models\Role;
use App\Permission;
class RoleController extends AppBaseController
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;

			$this->middleware('auth');


    }

    /**
     * Display a listing of the Role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = $this->roleRepository->all();
        $permissions = Permission::all();
        return view('roles.index')
            ->with('roles', $roles)
            ->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // return $request->all();

         $roles = new Role;
         $roles->name = ucfirst($request->name);
         $roles->school_id = $request->school_id;
         $roles->save();
        //  return $roles;


        Flash::success('Role saved successfully.');

        return redirect(route('roles.index'));
    }

   

    /**
     * Display the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id);
       
        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        return view('roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $roles = Role::all();
        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        return view('roles.index')->with('role', $role)->with('roles', $roles);
    }

    /**
     * Update the specified Role in storage.
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $role = Role::find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $role = Role::update($request->all(), $id);

        Flash::success('Role updated successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Role $role)
    {

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $role->delete();

        Flash::success('Role deleted successfully.');

        return redirect(route('roles.index'));
    }

    public function PDFgenerator()
    {
     $roles = Role::all();
    //  $users = User::join('roles', 'roles.id', '=' ,'users.role_id')->get();
 
    //  IN THIS ONE WE DONT HAVE JOIN TABLES OKAY.
    // VERY SIMPLE TO IMPLIMENT 
         // instantiate and use the dompdf class
         // $dompdf->();
         // $dompdf = PDF::loadView('class_schedules.pdf',['classSchedule'=> $classSchedule]);
         $dompdf = PDF::loadview('roles.pdf',['roles'=> $roles]);
         // (Optional) Setup the paper size and orientation
        //  $dompdf->setPaper('A4', 'landscape');
 
         // Output the generated PDF to Browser
         $dompdf->stream();
 
         return $dompdf->download('All-Roles.pdf');
    }

    public function print($id)
    {
        $roles = Role::where('id', $id)->get();
        // $users = User::join('roles', 'roles.id', '=' ,'users.role_id')
        //               ->where('users.id', $id)->get();
            // dd( $faculties); die;
        return view('roles.print',['roles'=> $roles]);
    }

    public function PDFgeneratorSingle($id)
    {
        $roles = Role::where('id', $id)->get();
            // dd( $admissions); die;
            $dompdf = PDF::loadview('roles.single_pdf',['roles'=> $roles]);
                // (Optional) Setup the paper size and orientation
                // $dompdf->setPaper('A4', 'landscape');
        
                // Output the generated PDF to Browser
                $dompdf->stream();
        
                return $dompdf->download('Role.pdf');
    }
}
