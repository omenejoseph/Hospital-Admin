<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ward;
use Illuminate\Support\Facades\Session;
use App\Bed;

class AdminWardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function index()
    {
        //
        // $users = User::all();
        // $roles = Role::all();
        // $depts = Dept::all();
        $wards = Ward::all();
        return view('admin.ward.index', compact('wards'));
    }

    public function create()
    {
        //   
        return view('admin.ward.create');
    }


    public function store(Request $request)
    {
     
        $ward = new Ward;
        $ward->name = $request->name;
        $ward->save();
        Session::flash('message', 'A new ward has been created successfully');
        $wards = Ward::all();
        return view('admin.ward.index', compact('wards'));
    }

    public function destroy($id)
    {
     
        $ward= Ward::findOrFail($id)->delete();
        
        Session::flash('message', 'Ward deleted successfully');
        $wards = Ward::all();
        return view('admin.ward.index', compact('wards'));
    }

    public function show()
    {
     
       
    }

    public function addBed(Request $request)
    {
     
       
    }



}
