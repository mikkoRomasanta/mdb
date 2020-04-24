<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    public $timestamps = false;

    protected $table = 'tbl_dept';

    public function position(){
        return $this->hasMany('App\Models\EmployeePosition','org_id','id');
    }
}
