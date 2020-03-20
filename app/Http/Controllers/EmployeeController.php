<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\App;
use App\Models\EmployeeProcess;
use App\Models\Process;
use App\Models\PasswordResets;
use App\Rules\ConfirmOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ResetPassword;
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
        $apps = App::pluckApps();

        $data = [
            'apps' => $apps
        ];

        return view('employees.index')->with($data);

        
    }

    public function create()
    {
        $process = Process::orderBy('process_name','ASC')->pluck('process_name','id');

        return view('employees.add-emp')->with('data',$process);
    }

    public function store(Request $request)
    { 
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
        $emp->role = $request->role;

        $emp->save();

        $user_id = Employee::where('emp_id','=',$request->emp_id)->value('id');

        $proc = new EmployeeProcess();
        $proc->user_id = $user_id;
        $proc->process_id = $request->process;
        $proc->save();

        $message = 'User ['.$request->emp_id.'] created successfully.';
        
        return redirect('/employees/add')->with('success', $message);

    }

    public function show(Employee $employee)
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'nullable|max:255|email'
        ]);
        
        $emp = Employee::where('emp_id', '=', $request->emp_id)->first();
        $apps = App::pluckApps(); //get all apps (add active? if needed)
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
        $emp->last_name = $request->last_name;
        $emp->email = $request->email;
        $emp->role = $request->role;

        $emp->save();

        $message = 'User ['.$request->emp_id.'] updated successfully.';

        return redirect('/employees')->with('success', $message);

    }

    public function destroy(Employee $employee)
    {
        //
    }

    public function getEmployees(){
        $emp = Employee::get();
        // return dd($emp);
        return $emp->toJson();
    }

    public function pluckApps(){ //for Datatables
        $apps = App::pluckApps(); //custom function in App model

        return $apps->toJson();
    }

    public function changePasswordIndex(){
        $user = Auth::user(); //get current logged-in user data
        $emp = Employee::where('emp_id','=',$user->emp_id)->first(); //use this for div and process
        $proc = EmployeeProcess::where('user_id',$user->id)->get();
        for($i=0;$i<$proc->count();$i++){
            $proc_id[$i] = $proc[$i]['process_id'];
            $org[$i] = Process::with('department','division')->where('id','=',$proc_id[$i])->first();
        }

        $numOfReset = PasswordResets::where('emp_id','=',$user->emp_id)->where('reset','=',1)->orderBy('created_at','DESC')->count();
        $dateOfLastChange = PasswordResets::where('emp_id','=',$user->emp_id)->where('reset','=',0)->orderBy('created_at','DESC')->first();
        // return dd($dateOfLastChange);
        if($dateOfLastChange == null){
            $dateOfLastChange['created_at'] = 'N/a'; 
        }

        // return dd($dateOfLastChange);
        // return dd($proc_id);
        // $org = Process::with(['dept' => function ($q){$q->where('id','=',8);}])->where('id','=',$proc_id)->get();
        // $org = Process::with('department','division')->where('id','=',$proc_id)->get();
        // return dd($org);
        // with(['itemStats' => function ($q) {$q->orderBy('id', 'desc');}])
        // return dd($test2);
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
            'apps' => $apps,
            'proc' => $proc,
            'org' => $org,
            'resetNum' => $numOfReset,
            'changeDate' => $dateOfLastChange
        ];


        return view('employees.change-password')->with($data);
    }

    public function changePass(Request $request){ // FOR normal change pass
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
        $emp->status = 'ACTIVE'; // will activate INACTIVE / TEMP users
        $emp->save();

        PasswordResets::newRecord($emp->emp_id,false); //true for reset, false if change pass

        // return response()->json(['result' => $newPassword.' '.$userId]);

        Auth::logout();

        $message = 'User ['.$userAuth->emp_id.'] updated successfully.';
        return redirect('/')->with('success', $message);
    }

    public function resetPass(Request $request){
        $emp = Employee::findOrFail($request->id); //get selected user info
        $pass = $request->reset_pass_base.$request->reset_pass_suffix; //combine pass + random 3 digit number
        $emp->password  = Hash::make($pass);
        $emp->status = 'TEMP'; //TEMP = indicator that user has a temporary password.
        $emp->save();

        PasswordResets::newRecord($emp->emp_id,true); //true for reset, false if change pass

        if(is_null($request->email)){ //if user has no email

            $message = 'User ['.$request->emp_id.'] updated successfully. New password is: '.$pass;
            return redirect('/employees')->with('success', $message);
        }
        else{
                $emp->tempPass = $pass;
            // $emp->notify(new ResetPassword($emp)); //send email notif. follow App\Notifications\ResetPassword;

            $message = 'Email sent to User ['.$request->emp_id.']';
            return redirect('/employees')->with('success', $message);
        }        
        
    }

    public function getUserProcess($id){
        $userProcess = EmployeeProcess::with('process')->where('user_id','=',$id)->get();

        return $userProcess;
    }
    

}
