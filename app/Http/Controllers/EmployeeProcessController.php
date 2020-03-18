<?php

namespace App\Http\Controllers;

use App\Models\EmployeeProcess;
use Illuminate\Http\Request;

class EmployeeProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsEmployeeProcess  $modelsEmployeeProcess
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsEmployeeProcess $modelsEmployeeProcess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelsEmployeeProcess  $modelsEmployeeProcess
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelsEmployeeProcess $modelsEmployeeProcess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelsEmployeeProcess  $modelsEmployeeProcess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelsEmployeeProcess $modelsEmployeeProcess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelsEmployeeProcess  $modelsEmployeeProcess
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsEmployeeProcess $modelsEmployeeProcess)
    {
        //
    }

<<<<<<< HEAD
    public function getUserProcess($userId){
        // $userProcess = EmployeeProcess::getUserProcess($userId);

        // return $userProcess;

        $userProcess = EmployeeProcess::where('user_id','=',$userId)->get();

        return $userProcess;
    }

=======
>>>>>>> f767090ca48bd6fc78681d340906ccf82573925b
}
