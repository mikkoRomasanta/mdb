<?php

namespace App\Http\Controllers;

use App\Models\Process;
use App\Models\EmployeeProcess;
use App\Models\Division;
use App\Models\Dept;
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
        $query = Division::with('department')->get();
        $division = [];

        foreach($query as $key => $div){
            $division[$key]['div'] = $div->division_name; //get div name
            $pos = EmployeePosition::with('employee')->where('org_id',$div->id)->where('position','=','GM')->first();
            $name = $pos['employee']['first_name'].' '.$pos['employee']['last_name'];
            $division[$key]['gm'] = $name;
            if(count($div->department)){
                foreach($div->department()->distinct()->get() as $key2 => $dept){
                    $pos = EmployeePosition::with('employee')->where('org_id',$dept['id'])->where('position','=','DH')->first();
                    $name = $pos['employee']['first_name'].' '.$pos['employee']['last_name'];
                    $division[$key]['dept'][$key2]['dept'] = $dept->department_name; //get departments of div
                    $division[$key]['dept'][$key2]['dh'] = $name;
                 }
            }
            else{
                $division[$key]['dept'][0]['dept'] = 'N/A'; } //if div has no dept. ex: president
                $division[$key]['dept'][0]['dh'] = 'N/A';
        }
            // return dd($division);
        $data = [
            'division' => $division
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
