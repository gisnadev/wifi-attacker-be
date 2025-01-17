<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
// use DataTables;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     //yajra table
    public function index()
    {
        if (request()->ajax()) {
            $data = User::get();
            return DataTables::of($data)

                ->make(true);
        }
        $user = DB::table('users')->paginate(10);
        return view('users',['user' => $user]);
    }

    public function search (Request $request) {
        $search = $request->search;
        $user = DB::table('users')
        ->where ('name','like',"%".$search."%")
        ->paginate();
        return view('users',['user' => $user]);
    }

    // public function getUserList(Request $request)
    // {
    //     $data = User::get();

    //     return Datatables::of($data)
    //             ->addColumn('roles', function ($data) {
    //                 $roles = $data->getRoleNames()->toArray();
    //                 $badge = '';
    //                 if ($roles) {
    //                     $badge = implode(' , ', $roles);
    //                 }

    //                 return $badge;
    //             })
    //             ->addColumn('permissions', function ($data) {
    //                 $roles = $data->getAllPermissions();
    //                 $badges = '';
    //                 foreach ($roles as $key => $role) {
    //                     $badges .= '<span class="badge badge-dark m-1">'.$role->name.'</span>';
    //                 }

    //                 return $badges;
    //             })
    //             ->addColumn('action', function ($data) {
    //                 if ($data->name == 'Super Admin') {
    //                     return '';
    //                 }
    //                 if (Auth::user()->can('manage_user')) {
    //                     return '<div class="table-actions">
    //                             <a href="'.url('user/'.$data->id).'" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
    //                             <a href="'.url('user/delete/'.$data->id).'"><i class="ik ik-trash-2 f-16 text-red"></i></a>
    //                         </div>';
    //                 } else {
    //                     return '';
    //                 }
    //             })
    //             ->rawColumns(['roles','permissions','action'])
    //             ->make(true);
    // }

    public function create()
    {
        try {
            $roles = Role::pluck('name', 'id');

            return view('create-user', compact('roles'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function detail ($id){
        $user = User::find($id);
        return view('user-detail')->with('user', $user);
    }

    public function store(UserRequest $request)
    {
        try {
            // store user information
            $user = User::create([
                        'name' => $request->name,
                        'email' => $request->email,
                        'telegramid'=>$request->telegram,
                        'password' => Hash::make($request->password),
                    ]);
                    Log::debug("user object",[$user]);


            // assign new role to the user
            $user->syncRoles($request->role);

            if ($user) {
                return redirect('users')->with('success', 'New user has been created!');
            } else {
                return redirect('users')->with('error', 'Failed to create new user! Try again.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($id)
    {
        try {
            $user = User::with('roles', 'permissions')->find($id);

            if ($user) {
                $user_role = $user->roles->first();
                $roles = Role::pluck('name', 'id');

                return view('user-edit', compact('user', 'user_role', 'roles'));
            } else {
                return redirect('404');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }

    public function update(Request $request)
    {

        // update user info
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required | string ',
            'email' => 'required | email',
            'role' => 'required',
        ]);

        // check validation for password match
        if (isset($request->password)) {
            $validator = Validator::make($request->all(), [
                'password' => 'required | confirmed',
            ]);
        }
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }

        try {
            $user = User::find($request->id);

            $update = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'telegramid'=>$request->telegram
            ]);

            // update password if user input a new password
            if (isset($request->password)) {
                $update = $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            // sync user role
            $user->syncRoles($request->role);

            return redirect()->back()->with('success', 'User information updated succesfully!');
        } catch (\Exception $e) {
            $bug = $e->getMessage();

            return redirect()->back()->with('error', $bug);
        }
    }


    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();

            return redirect('users')->with('success', 'User removed!');
        } else {
            return redirect('users')->with('error', 'User not found');
        }
    }
}
