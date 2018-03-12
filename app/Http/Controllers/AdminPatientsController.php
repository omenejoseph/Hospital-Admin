<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;
use App\Http\Requests\patientsAdmissionRequest;
use Illuminate\Support\Facades\Auth;
use App\Bed;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class AdminPatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $patients = Patient::all();
        
        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $beds = Bed::all()->where('is_occupied', 0);
        return view('admin.patients.create', compact('beds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(patientsAdmissionRequest $request)
    {
        //
        $patient = new Patient();

        $patient->name = $request->name;
        $patient->email = $request->email;
        $patient->address = $request->address;
        $patient->history = $request->history;
        $patient->sex = $request->sex;
        $patient->admitted_by = Auth::user()->name;
        $patient->cond = $request->cond;
        $patient->discharged_by = 'null';
        $patient->discharged_at = null;
        $patient->discharge_bill = 0;
        $patient->diag = $request->diag;
        $patient->vitals = $request->vitals;
        $patient->meds = $request->meds;
        $patient->labs = $request->labs;
        $patient->marital_stat = $request->marital_stat;

        if($request->allergies){
            $patient->allergies = $request->allergies;
        } else{
            $patient->allergies = 'None';
        }
        if($request->bed_numbr){
            $patient->bed_numbr = $request->bed_numbr;
            $patient->is_admitted = 1;
            $patient->admitted_at = Carbon::now();

            $patBed = Bed::where('id', $request->bed_numbr)->first();
            
            $patBed->is_occupied = 1;
            $patBed->update();

            
        } else{
            $patient->bed_numbr = 0;
        }
       
        $patient->save();

        if($request->bed_numbr){
            $patBed->patient_id = $patient->id;
            $patBed->update();
        }
        
        Session::flash('message', 'Patient Admitted successfully');
        return redirect(url('/admin/patients/'));
        
       
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
        $patient = Patient::where('id', $id)->first();
        
        return view('admin.patients.show', compact('patient'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $pat = Patient::find($request->id);
        if($request->history){
            $pat->history = $request->Input;
            $pat->save();
            return response()->json(['status'=>true,'Description' => 'successful']);
        }
        
        if($request->cond){
            $pat->cond = $request->Input;
            $pat->save();
            return response()->json(['status'=>true,'Description' => 'successful']);
        }

        if($request->allergy){
            $pat->allergies = $request->Input;
            $pat->save();
            return response()->json(['status'=>true,'Description' => 'successful']);
        }

        if($request->diag){
            $pat->diag = $request->Input;
            $pat->save();
            return response()->json(['status'=>true,'Description' => 'successful']);
        }

        if($request->vitals){
            $pat->vitals = $request->Input;
            $pat->save();
            return response()->json(['status'=>true,'Description' => 'successful']);
        }

        if($request->meds){
            $pat->meds = $request->Input;
            $pat->save();
            return response()->json(['status'=>true,'Description' => 'successful']);
        }

        if($request->labs){
            $pat->labs = $request->Input;
            $pat->save();
            return response()->json(['status'=>true,'Description' => 'successful']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bill($id){
        $patient = Patient::findOrFail($id);
        return view('admin.patients.bill', compact('patient'));
    }

    public function calcBill(Request $request){
        
        $drugs = $request->drugs;
        $consult =$request->consult;
        $labs = $request->labs;
        $anonymous = $request->anonymous;
        $id = $request->id;

       
           
        
        $patient = Patient::findOrFail($id);
        $patient->discharged_at = Carbon::now();
        if($patient->is_admitted == 1){
            $bedPrize = $request->bed;
            $start = Carbon::parse($patient->admitted_at);
            $end = $now = Carbon::now();

            $length = $end->diffInDays($start);

           $est_len = round($length);
       
           $bed_prize = $est_len * $bedPrize;

            
            $patient->is_admitted = 0;
            $patient->discharged_by = Auth::user()->name;
            $bed = Bed::findOrFail($patient->bed_numbr);
            // dd($bed->name);
            $bed->is_occupied = 0;
            $bed->patient_id = 0;
            $bed->save();
            $patient->bed_numbr = 0;


        } else{
            $bed_prize = 0;
        }
            $totalBill = $drugs + $consult + $labs + $anonymous + $bed_prize;
            $patient->discharge_bill = $totalBill;
            
            
            $patient->save();

        return view ('admin.patients.patientBill', compact('drugs','consult', 'labs', 'anonymous', 'totalBill', 'patient', 'bed_prize'));
    }

    public function emailBill(Request $request){
        $bill = [];
        $bill['labs'] = $request ->labs;
        $bill['consults'] = $request->consults;
        $bill['bed_prize'] = $request->bed_prize;
        $bill['drugs'] = $request->drugs;
        $bill['anonymous'] = $request->anonymous;
        $bill['totalBill'] = $request->totalBill;
        $bill['name'] = $request->name;
        $bill['id'] = $request->id;

        Mail::to($request->email)->send(new InvoiceMail($bill));
        flash('Your Message has been Sent!')->success();
        
        return redirect('admin/patients');

        // dd($request ->labs);


    }

    public function payBill($id){

        $patient = Patient::findOrFail($id);

        return view('bill.index', compact('patient'));
    }





}
