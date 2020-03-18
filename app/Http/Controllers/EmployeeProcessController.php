<?php

namespace App\Http\Controllers;

use App\Models\EmployeeProcess;
use Illuminate\Http\Request;

class EmployeeProcessController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $id = $request->input('user_id'); //get input from post
        $process_id = $request->input('process_id');

        $record = EmployeeProcess::where('user_id','=',$id)->where('process_id','=',$process_id)->get(); //check if record already exists

        if($record->count() == 0){ //check if record already exists. if not then create record
            $emp =  new EmployeeProcess();
            $emp->user_id = $id;
            $emp->process_id = $process_id;
            $emp->save();
        }

    }

    public function show(ModelsEmployeeProcess $modelsEmployeeProcess)
    {
        //
    }

    public function edit(ModelsEmployeeProcess $modelsEmployeeProcess)
    {
        //
    }

    public function update(Request $request, ModelsEmployeeProcess $modelsEmployeeProcess)
    {
        //
    }

    public function destroy(Request $request)
    {

    }

    public function deleteUserProcess(Request $request){
        $id = $request->input('empProcess_id');

        $emp = EmployeeProcess::find($id);
        $emp->delete();
    }

}
