<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{

    public $casts = [
        'app_acc' => 'array'
    ];
    
    public function accounts(){
        return $this->hasOne('App\Models\Account','emp_id','emp_id');
    }
}
