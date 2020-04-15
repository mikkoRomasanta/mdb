<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    protected $table = 'employee_positions';

    public function employee(){
        return $this->hasOne('App\Models\Employee','id','user_id');
    }
}
