<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Auth;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //using policy set at app>policies>EmployeePolicy
        if($user->can('view', Employee::class)){ //if user is allowed to view then applist.index
            $apps = App::pluckApps();

            for($i=0;$i<$apps->count();$i++){
                $app = strtolower($apps[$i]);
                $count[$app] = Employee::where($app,'=', 1)->count();
            }
            // return dd($count);
            $data = [
                'apps' => $apps,
                'count' => $count,
            ];

            return view('applist.index')->with($data);
        }else{
            return response('GTFOH!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        if($user->can('create', Employee::class)){      
            $appName = strToUpper($request->app_name); //#ALLCAPS

            //save new app to app table
            $app = new App;
            $app->name = $appName;
            $app->save();

            //create new column for new app in employee table
            $newColumnName = strToLower($appName);

            Schema::table('employees', function (Blueprint $table) use ($newColumnName) {
                $table->boolean($newColumnName)->default(0)->after('status');
            });

            $message = 'Wow! you made a new app. congrats I guess...';

            return redirect('/apps')->with('success', $message);
        }else{
            return response('GTFOH!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete(Request $request){
        $user = Auth::user();
        if($user->can('create', Employee::class)){
            
            $message = 'Wow! you made a new app. congrats I guess...'.$request->appName;

            return redirect('/apps')->with('success', $message);
        }else{
            return response('GTFOH!');
        }
    }
}
