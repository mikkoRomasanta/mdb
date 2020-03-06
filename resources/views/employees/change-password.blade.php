@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <strong>User : </strong>{{$emp->emp_id}}
            <hr>
            <p><small><strong>Name:</strong> {{$emp->first_name.' '.$emp->last_name}}</small></p>
            {{-- <p><small><strong>Dept:</strong> {{$emp->dept}}</small></p> --}}
            <p><small><strong>Email:</strong> {{$emp->email}}</small></p>
            {{-- <p><small><strong>Dept:</strong> {{$emp->dept->dept_name}}</small></p> --}}
            {{-- <p><small><strong>Process</strong> {{$test[0]['employee_process']['process_id']}}</small></p> --}}
            <hr>
            <strong>Accounts:</strong>
            @foreach($apps as $app)
                {{ strToUpper($app).' | '}}
            @endforeach
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title text-center" style="margin-bottom: 0;">Change Password</h4>
                </div>
                <div class="card-body">
                    {{Form::open(['action' => ['EmployeeController@changePass'], 'method' => 'POST', 'class' => 'text-center'])}}
                        <div class="form-group form-row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                {{Form::label('cur_password', 'Current Password')}}
                                {{Form::password('cur_password',['class' => 'form-control text-center', 'placeholder' => 'enter your old password'])}}
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                {{Form::label('new_password', 'New Password')}}
                                {{Form::password('new_password',['class' => 'form-control text-center', 'placeholder' => 'Minimum of 6 characters'])}}
                            </div>
                        </div>
                        <div class="form-group form-row">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    {{Form::label('new_password_confirmation', 'Confirm Password')}}
                                    {{Form::password('new_password_confirmation',['class' => 'form-control text-center', 'placeholder' => 'confirm your new password'])}}
                                </div>
                            </div>
                        {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                    {{Form::close()}}
                </div>
            </div>
            <div class="text-center"><small>Need assistance? Have a concern or suggestion? Contact us @ loc. 1013 </small></div>
        </div>
        <div class="col-md-3">
            Additonal Info
            <hr>
            <p><small>Date of last password reset</small></p>
            <p><small># of password reset?</small></p>
        </div>
    </div>
</div>
@endsection