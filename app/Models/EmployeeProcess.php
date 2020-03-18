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
}
