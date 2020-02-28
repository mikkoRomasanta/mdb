<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\App;
use App\Rules\ConfirmOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        //using policy set at app>policies>EmployeePolicy
        if($user->can('view', Employee::class)){ //if user is allowed to view then show employees.index
            $apps = App::pluckApps();

            $data = [
                'apps' => $apps
            ];

            return view('employees.index')->with($data);
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
        $user = Auth::user();
        if($user->can('create', Employee::class)){    
            return view('employees.add-emp');
        }else{
            return response('GTFOH!');
        }
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
            $validatedData = $request->validate([
                'emp_id' => 'required|max:10|unique:employees,emp_id',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'nullable|max:255|email'
            ]);

            $emp = new Employee();
            $emp->emp_id = $request->emp_id;
            $emp->first_name = $request->first_name;
            $emp->last_name = $request->last_name;
            $emp->email = $request->last_name;

            $emp->save();

            $message = 'User ['.$request->emp_id.'] created successfully.';
            
            return redirect('/employees/add')->with('success', $message);
        }else{
            return response('GTFOH!');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if($user->can('create', Employee::class)){    
            $emp = Employee::where('emp_id', '=', $request->emp_id)->first();
            $apps = DB::table('apps')->pluck('name'); //get all apps (add active? if needed)
            $appCount = $apps->count(); //count # of apps

            for($i=0;$i<$appCount;$i++){ //loop through all apps
                $app = strtolower($apps[$i]); //lowercase the appname
                
                if(isset($request->app[$i])){ //if checkbox is on

                    $emp[$app] = 1; //basically same as $emp->appName = 1;
                }
                else{
                    $emp[$app] = 0;
                }
            }

            $emp->emp_id = $request->emp_id; //should we allow changing of emp_id? emp_id is unique in the database
            $emp->first_name = $request->first_name;
            $emp->last_name = $request->last_name; //dept and other info not YET included.

            $emp->save();

            $message = 'User ['.$request->emp_id.'] updated successfully.';

            return redirect('/employees')->with('success', $message);
        }else{
            return response('GTFOH!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function getEmployees(){
        $emp = Employee::get();

        return $emp->toJson();
    }

    public function pluckApps(){ //for Datatables
        $apps = App::pluckApps(); //custom function in App model

        return $apps->toJson();
    }

    public function changePassword(){
        $emp = Auth::user(); //get current logged-in user data
        $plucked = App::pluckApps(); //get all available apps
        $apps = []; //array to display user's active apps
        foreach($plucked as $app){
            $app = strtolower($app); //lowercase each appName
            if($emp[$app] == 1){ //check if app is active
                array_push($apps, $app); //add to $apps
            }
        }

        $data = [
            'emp' => $emp,
            'apps' => $apps
        ];


        return view('employees.change-password')->with($data);
    }

    public function changePass(Request $request){ // add limit on change pass? ex. once a month????????
        $userAuth = Auth::user(); //get current logged-in user's info
        $oldPassword = $userAuth->password; //get current logged-in user's password
        $this->validate($request, [
            'cur_password' => ['required', new ConfirmOldPassword($oldPassword)],
            'new_password' => 'required|min:6|confirmed'
        ]); //follow custom rule in App/Rules/ConfirmOldPassword

        $curPassword = $request->input("cur_password"); //get current password from user input
        $newPassword = $request->input('new_password'); //get new password from user input


        $emp = Employee::where('emp_id', '=', $userAuth->emp_id)->first();
        $emp->password = Hash::make($newPassword);
        $emp->save();

        // return response()->json(['result' => $newPassword.' '.$userId]);

        Auth::logout();

        $message = 'User ['.$userAuth->emp_id.'] updated successfully.';
        return redirect('/login')->with('success', $message);
    }

}
