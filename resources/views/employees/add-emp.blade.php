@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
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
                    {{Form::label('email', 'Email',['class' => 'col-md-3 col-form-label', 'style' => 'font-weight: bold'])}}
                    {{Form::text('email','',['id' => 'emailBox', 'class' => 'col-md-8 form-control'])}}
                </div>
                <div class="form-group row">
                    {{Form::label('role', 'Role',['class' => 'col-md-3 col-form-label', 'style' => 'font-weight: bold'])}}
                    {{Form::select('role',['ADMIN'=>'ADMIN','USER' => 'USER'],'USER',['id' => 'roleBox', 'class' => 'col-md-8 form-control'])}}
                </div>
                <div class="form-group row">
                    {{Form::label('process', 'Process',['class' => 'col-md-3 col-form-label', 'style' => 'font-weight: bold'])}}
                    {{Form::select('process',$data,null,['id' => 'processBox', 'class' => 'col-md-8 form-control'])}}
                </div>
                <div class="form-group row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
                    </div>
                </div>
                {{Form::close()}}
        </div>
    </div>
</div>
@endsection

@push('scripts')




@endpush