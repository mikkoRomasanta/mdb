<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class Employee extends Authenticatable
{
    use Notifiable;

    public function employeeProcess(){
        return $this->hasMany('App\Models\EmployeeProcess','user_id','id');
    }

    
}
