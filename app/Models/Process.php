<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    public $timestamps = false;

    protected $table = 'tbl_proc';

    public function division(){
        return $this->belongsTo('App\Models\Division','division_id','id');
    }

    public function department(){
        return $this->belongsTo('App\Models\Dept','department_id','id');
    }

    public function employees(){
        return $this->belongsToMany('App\Models\EmployeeProcess');
    }
}
