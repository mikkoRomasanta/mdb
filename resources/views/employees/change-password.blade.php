@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <strong>User : </strong>{{$emp->emp_id}}
            <hr>
            <p><small><strong>Name:</strong> {{$emp->first_name.' '.$emp->last_name}} </small></p>
            <p><small><strong>Email:</strong> {{$emp->email}} </small></p>
                <p><small><strong>Division:</strong> {{$org[0]->division->division_name}} </small></p>
                <p><small><strong>Department:</strong> {{$org[0]->department->department_name}} </small></p>
                <p><small><strong>Process:</strong>
                    @foreach($org as $proc)
                        {{$proc->process_name}} <br>
                    @endforeach
                    </small></p>
            <hr>
            <strong>Accounts:</strong>
            @foreach($apps as $app)
                {{ strToUpper($app).' | '}}
            @endforeach
        </div>
        <div class="col-md-6">
            <div class="card shadow mx-auto" style="width: 80%">
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
                        {{Form::submit('Submit',['class' => 'btn btn-primary btn-block'])}}
                    {{Form::close()}}
                </div>
            </div>
            <div class="text-center"><small>Need assistance? Have a concern or suggestion? Contact us @ loc. 1013 </small></div>
        </div>
        <div class="col-md-3">
            Additonal Info
            <hr>
            <p><small><strong>Change Password Date:</strong> {{$changeDate['created_at']}}</small></p>
            <p><small><strong># of Password Reset:</strong> {{$resetNum}}</small></p>
        </div>
    </div>
</div>
@endsection