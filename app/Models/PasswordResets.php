<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $table = 'password_resets';

    public static function newRecord($emp_id,$bool){
        $record = new PasswordResets();
        $record->emp_id = $emp_id;
        $record->reset = $bool; //to record if pass reset or change pass 
        $record->save();
    }
}
