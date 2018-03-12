<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bed;
use App\Ward;

class AdminBedsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      
        $beds = Bed::all();
        return view('admin.beds.index', compact('beds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $bed = new Bed();
        $ward = Ward::findOrFail($request->ward_id);
        $bed->name =  $ward->name . time();
        $bed->ward_id = $request->ward_id;
        $bed->save();

        $wards = Ward::pluck('name', 'id')->all();
        $beds = Bed::all();
        
        return view('admin.beds.index', compact('wards', 'beds'));
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
        $beds = Bed::all()->where('ward_id', $id);
        $wardName = Ward::where('id', $id)->first()->name;
        return view('admin.beds.show', compact('beds', 'wardName'));
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
        Bed::findOrFail($id)->delete();
        
        $wards = Ward::pluck('name', 'id')->all();
        $beds = Bed::all();
        
        // return view('admin.beds.index', compact('wards', 'beds'));
        return redirect()->back()->with(['wards'=>'wards', 'beds'=>'beds']);
    }
}
