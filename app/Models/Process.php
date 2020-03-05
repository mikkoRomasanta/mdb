<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    public $timestamps = false;

    protected $table = 'tbl_proc';

    public function division(){
        return $this->belongsTo('App\Division','id','div_id');
    }

    public function dept(){
        return $this->belongsTo('App\Dept','dept_id','id');
    }

    public function employees(){
        return $this->belongsToMany('App\EmployeeProcess');
    }
}
