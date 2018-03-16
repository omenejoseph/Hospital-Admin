<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Patient;

class PatientBillController extends Controller
{
    //
    public function payBill($id){

        $patient = Patient::findOrFail($id);

        // dd(round($patient->discharge_bill, 2));

        return view('bill.index', compact('patient'));
    }
}
