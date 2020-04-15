<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\EmployeeProcess;
use App\Models\Division;
use App\Models\EmployeePosition;
use App\Models\Employee;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Process::with(['division','department'])->get();

        return view('organization.index')->with('data',$data);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function show(Process $process)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function edit(Process $process)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Process $process)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Process  $process
     * @return \Illuminate\Http\Response
     */
    public function destroy(Process $process)
    {
        //
    }

    public function showEmp($id){
        $data = EmployeeProcess::with('employees')->where('process_id','=',$id)->get();
        
        return $data->toArray();
    }

    public function getAllProcess(){
        $data = Process::get();

        return $data;
    }

    public function chart(){
        $div = Division::get();
        
        $data = [
            'divs' => $div
        ];

        return view('organization.chart')->with($data);
    }

    
    public function getPositions($id){
        $dh = EmployeePosition::with('employee')->where('org_id',$id)->where('position','=','DH')->first();
        $adh = EmployeePosition::with('employee')->where('org_id',$id)->where('position','=','ADH')->first();
        $gmId = Process::select('division_id')->where('department_id',$id)->first();
        $gm = EmployeePosition::with('employee')->where('org_id',$gmId->division_id)->where('position','=','GM')->first();

        $data = [
            'dh' => $dh,
            'adh' => $adh,
            'gm' => $gm
        ];

        return $data;
    }
}
