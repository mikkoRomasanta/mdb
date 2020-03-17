<div class="modal fade" id="mdlEdit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header color-bg-main color-font-dark">
                <h4 class="modal-title" id="mdlTitle"></h4>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{Form::open(['action' => 'EmployeeController@update', 'method' => 'POST'])}}
                        {{Form::hidden('emp_id','',['id' => 'empBox', 'class' => 'col-md-8 form-control'])}}
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
                        {{Form::select('role',['ADMIN'=>'ADMIN','USER' => 'USER'],'',['id' => 'roleBox', 'class' => 'col-md-8 form-control'])}}
                    </div>
                    <div class="form-check form-check-inline">
                        <!-- App checkboxes Start-->
                        @for($i=0;$i<count($apps);$i++) <!-- count $apps from index.blade.php-->
                            <div class="card">
                                <div class="card-header p-2">
                                    {{Form::label($apps[$i],'',['class' => 'form-check-label', 'style' => 'font-weight: bold'])}}
                                </div>
                                <div class="card-body p-2" align="center">
                                    {{Form::checkbox('app['.$i.']',null,false,['id' => 'appBox'.$i, 'class' => 'form-check-input'])}}
                                </div>
                            </div>
                        @endfor
                        <!-- App checkboxes End-->

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
</div>