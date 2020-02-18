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

        $apps = DB::table('apps')->orderBy('name','ASC')->get();
        
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

        if(isset($request->app_gsis)){ //TODO: put checkboxes into an array + loop
            $emp->gsis = '1';
        }
        else{
            $emp->gsis = '0';
        }
        if(isset($request->app_ldb)){
            $emp->ldb = '1';
        }
        else{
            $emp->ldb = '0';
        }
        if(isset($request->app_umdb)){
            $emp->umdb = '1';
        }
        else{
            $emp->umdb = '0';
        }
        if(isset($request->app_vdb)){
            $emp->vdb = '1';
        }
        else{
            $emp->vdb = '0';
        }

        //Save updates
        $emp->emp_id = $request->emp_id;
        $emp->first_name = $request->first_name;
        $emp->last_name = $request->last_name;

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

}
