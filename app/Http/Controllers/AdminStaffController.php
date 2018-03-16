<?php

namespace App\Http\Controllers;
use App\Role;
use App\Dept;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Photo;
use App\User;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\EditUserRequest;


class AdminStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        //
        $users = User::paginate(15);
        $roles = Role::all();
        $depts = Dept::all();
        
        return view('admin.staff.index', compact('users', 'roles', 'depts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $roles = Role::pluck('name', 'id')->all();
        $dept = Dept::pluck('name', 'id')->all();
        return view('admin.staff.create', compact('roles', 'dept'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        

        $user = Auth::user();

        $input = new User;

        $role = Role::where('id', $request->role_id)->first();


        $input->name = $request->name;
        $input->email = $request->email;
       
        $input->highest_qual = $request->highest_qual;
        $input->dept_id = $request->dept_id;

        if(! trim($request->password == '')){

            $input->password = bcrypt($request->password);
            
        }
        
        
        
        if ($file = $request->file('file_name')){
            
            $name = time() . $file->getClientOriginalName();
            
            $file->move('images', $name);
            
            $photo = Photo::create(['file_name' => $name, 'user_id'=>$user->id]);
            
            $input->photo_id = $photo->id;
            
        }
        
        
        $input->save();
        $input->roles()->attach($role);
        Session::flash('message', 'A new Staff has been added successfully');
        return redirect(url('/admin/staff'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //


        $role = Role::pluck('name', 'id')->all();
        $dept = Dept::pluck('name', 'id')->all();
        $user = User::findOrFail($id);

        return view('admin.staff.edit', compact('user', 'role', 'dept'));
       
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request)
    {      
        
        if($request->ajax()){
            // $input = new \stdClass();
            
            
            $user = User::findOrFail($request->id);
       
            if(is_null($user)){
                return response()->json(['status'=>false,'Description' => 'User could not be found.']);
            }
            // if(($user)){
            //     return response()->json(['status'=>false,'Description' => 'User found.']);
            // }

            $user->name = $request->name;
            $user->email= $request->email;
            $user->highest_qual = $request->highest_qual;
           
            if($request->dept_id){
                $user->dept_id = $request->dept_id;
            }
            
            $user->update();
            if ($request->role_id){
                $role = Role::where('id', $request->role_id)->first();
                $user->roles()->attach($role);
            }
            return response()->json(['status'=>true,'Description' => 'successful']);
            
        }
       
        // $user->update($input);
        // $user->roles()->attach($role);
        
        
        // Session::flash('message', 'Staff information updated successfully');
        // return redirect(url('/admin/staff'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        // 
        if($request->ajax()){
            User::findOrFail($request->id)->delete();
            return response()->json(['success'=>'deleted '.$request->id]);
        }
    }

  
}
