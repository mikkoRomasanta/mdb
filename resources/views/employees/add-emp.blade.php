@extends('layouts.app')

@section('content')
    <div class="container">
        {{Form::open(['action' => 'EmployeeController@store', 'method' => 'POST'])}}
            <div class="form-group row">
                {{Form::label('emp_id', 'Emp ID',['class' => 'col-md-3 col-form-label', 'style' => 'font-weight: bold'])}}
                {{Form::text('emp_id','',['id' => 'empBox', 'class' => 'col-md-8 form-control'])}}
            </div>
            <div class="form-group row">
                {{Form::label('first_name', 'First Name',['class' => 'col-md-3 col-form-label', 'style' => 'font-weight: bold'])}}
                {{Form::text('first_name','',['id' => 'fnameBox', 'class' => 'col-md-8 form-control'])}}
            </div>
            <div class="form-group row">
                {{Form::label('last_name', 'Last Name',['class' => 'col-md-3 col-form-label', 'style' => 'font-weight: bold'])}}
                {{Form::text('last_name','',['id' => 'lnameBox', 'class' => 'col-md-8 form-control'])}}
            </div>
            <div class="form-group row">
                {{Form::label('dept', 'Department',['class' => 'col-md-3 col-form-label', 'style' => 'font-weight: bold'])}}
                {{Form::text('dept','',['id' => 'deptBox', 'class' => 'col-md-8 form-control'])}}
            </div>
            <div class="form-group row">
                {{Form::label('email', 'Email',['class' => 'col-md-3 col-form-label', 'style' => 'font-weight: bold'])}}
                {{Form::text('email','',['id' => 'lnameBox', 'class' => 'col-md-8 form-control', 'placeholder' => 'example@nanox.com'])}}
            </div>
            {{-- <div class="form-group row">
                <!-- App checkboxes Start-->
                @for($i=0;$i<count($apps);$i++) <!-- count $apps from index.blade.php-->
                    {{Form::label($apps[$i],'',['class' => 'col-md-1 col-form-label', 'style' => 'font-weight: bold'])}}
                    {{Form::checkbox('app['.$i.']',null,false,['id' => 'appBox'.$i, 'class' => 'col-md-1 form-control'])}}
                @endfor
                <!-- App checkboxes End-->

            </div> --}}
            <div class="form-group row">
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                </div>
            </div>
            {{Form::close()}}
        </div>
@endsection