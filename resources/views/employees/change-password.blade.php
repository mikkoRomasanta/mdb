@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            Display user info here
            <hr>
            <p><small>Name / ID</small></p>
            <p><small>DEPT etc...</small></p>
            <p><small>Contact Us / link to ticketing (if need to update info)</small></p>
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
                                {{Form::password('new_password',['class' => 'form-control text-center', 'placeholder' => 'enter your new password'])}}
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
        </div>
        <div class="col-md-3">
            Display addtl. Info here
            <hr>
            <p><small>Activated accounts.</small></p>
            <p><small>Date of last password reset</small></p>
            <p><small># of password reset?</small></p>
        </div>
    </div>
</div>
@endsection