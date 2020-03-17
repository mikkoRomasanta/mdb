<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeProcess extends Model
{
    protected $table = 'employee_process';

    public function employees(){
        return $this->hasMany('App\Models\Employee','id','user_id');
    }

    public function process(){
        return $this->belongsTo('App\Models\Process','process_id','id');
    }

    // public function insertData($data){
    //     $value = DB::table('employee_process')->where('user_id','=',$data['user_id'])->where('process_id','=',$data['process_id'])->get();
    //     if($value->count == 0){
    //         $insertId = DB::table('employee_process')->inserGetId($data);
    //         return $insertid;
    //     }
    //     else{
    //         return 0;
    //     }
    // }
}
