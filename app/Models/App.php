<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    public $timestamps = false;
    
    public static function pluckApps(){
        $apps = DB::table('apps')->orderBy('name','ASC')->pluck('name');

        return $apps;
    }
}
