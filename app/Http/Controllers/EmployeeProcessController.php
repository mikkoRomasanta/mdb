<?php

namespace App\Http\Controllers;

use App\Models\EmployeeProcess;
use App\Models\EmployeePosition;
use Illuminate\Http\Request;

class EmployeeProcessController extends Controller
{

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

    public function deleteUserProcess(Request $request){
        $id = $request->input('empProcess_id');

        $emp = EmployeeProcess::find($id);
        $emp->delete();
    }

    public function storeGm(Request $request){
        $query = EmployeePosition::where('org_id',$request->div_id)->where('position','=','GM')->first();
        
        if(!is_null($query)){
            $emp = EmployeePosition::find($query->id);
            $emp->user_id = $request->user_id;
            $emp->save();

            $message = 'Replace old GM Successful';
            return redirect('/employees')->with('success', $message);
        }else{
            $rec = new EmployeePosition();
            $rec->user_id = $request->user_id;
            $rec->org_id = $request->div_id;
            $rec->position = 'GM';
            $rec->save();

            $message = 'Add new GM Successful';
            return redirect('/employees')->with('success', $message);
        }
    }

    
    public function storeDh(Request $request){
        $query = EmployeePosition::where('org_id',$request->dept_id)->where('position','=','DH')->first();
        
        if(!is_null($query)){
            $emp = EmployeePosition::find($query->id);
            $emp->user_id = $request->user_id;
            $emp->save();

            $message = 'Replace old DH Successful';
            return redirect('/employees')->with('success', $message);
        }else{
            $rec = new EmployeePosition();
            $rec->user_id = $request->user_id;
            $rec->org_id = $request->dept_id;
            $rec->position = 'DH';
            $rec->save();

            $message = 'Add new DH Successful';
            return redirect('/employees')->with('success', $message);
        }
    }


}
