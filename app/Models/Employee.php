<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    public $timestamps = false;

    public $casts = [
        'app_acc' => 'array'
    ];
    
    public function accounts(){
        return $this->hasOne('App\Models\Account','emp_id','emp_id');
    }
}
