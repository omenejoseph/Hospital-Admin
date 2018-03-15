<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\Bed;
use App\Ward;

class AdminController extends Controller
{
    //
    public function index(){
        $staffCount = User::count();
        $patientCount = Patient::count();
        $wardCount = Ward::count();
        $bedCount = Bed::count();
        return view('admin.index', compact('staffCount', 'patientCount', 'wardCount', 'bedCount'));
    }

    public function approve(Request $request){
       
        
        if($request->ajax()){
        $input = User::findOrFail($request->id);
        $input->is_approved = $request->status;
        $input->save();
        
        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }
}
}
