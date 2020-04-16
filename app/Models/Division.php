<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    public $timestamps = false;

    protected $table = 'tbl_div';

    public function department(){
        return $this->hasManyThrough('App\Models\Dept','App\Models\Process','division_id','id','id','department_id');
    }
}
