<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\App;
use Illuminate\Http\Request;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $apps = App::pluckApps();

        $data = [
            'apps' => $apps
        ];


        return view('employees.index')->with($data);

        
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
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $emp = Employee::where('emp_id', '=', $request->emp_id)->first();
        $apps = DB::table('apps')->pluck('name'); //get all apps (add active? if needed)
        $appCount = $apps->count(); //count # of apps

        for($i=0;$i<$appCount;$i++){ //loop through all apps
            $app = strtolower($apps[$i]); //lowercase the appname
            
            if(isset($request->app[$i])){ //if checkbox is on

                $emp[$app] = 1; //basically same as $emp->appName = 1;
            }
            else{
                $emp[$app] = 0;
            }
        }

        $emp->emp_id = $request->emp_id; //should we allow changing of emp_id? emp_id is unique in the database
        $emp->first_name = $request->first_name;
        $emp->last_name = $request->last_name; //dept and other info not YET included.

        $emp->save();

        $message = 'User ['.$request->emp_id.'] updated successfully.';

        return redirect('/employees')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function getEmployees(){
        $emp = Employee::get();

        return $emp->toJson();
    }

    public function pluckApps(){ //for Datatables
        $apps = App::pluckApps(); //custom function in App model

        return $apps->toJson();
    }

}
