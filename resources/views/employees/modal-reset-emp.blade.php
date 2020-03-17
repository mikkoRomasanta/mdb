<div class="modal fade" id="mdlResetWith" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header color-bg-main color-font-dark">
                <h4 class="modal-title" id="mdlTitleReset"></h4>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{Form::open(['action' => 'EmployeeController@resetPass', 'method' => 'POST'])}}
                        {{Form::hidden('id','',['id' => 'idBox', 'class' => 'col-md-6 form-control', 'readonly'])}}
                        {{Form::hidden('emp_id','',['id' => 'empIdBox', 'class' => 'col-md-6 form-control', 'readonly'])}}
                    <div class="form-group row">
                        <div class="col-md-9">
                            <div class="form-group row" id="emailDiv">
                                {{Form::label('email', 'Email',['class' => 'col-md-2 col-form-label', 'style' => 'font-weight: bold'])}}
                                {{Form::text('email','',['id' => 'emailResetBox', 'class' => 'col-md-10 form-control', 'readonly'])}}
                            </div>
                            <div class="form-group row" id="passDiv">
                                {{Form::label('reset_pass_base','Temp Password:',['class' => 'col-md-6 col-form-label', 'style' => 'font-weight: bold'])}}
                                {{Form::text('reset_pass_base','pass',['id' => 'passBaseBox', 'class' => 'col-md-2 form-control text-center', 'readonly'])}}
                                <span class='pt-2' style="backgound-color:red"><i class='fas fa-plus fa-fw'></i></span>
                                {{Form::text('reset_pass_suffix','',['id' => 'passSuffixBox', 'class' => 'col-md-2 form-control text-center', 'readonly'])}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            {{Form::submit('Reset',['class' => 'btn btn-primary'])}}
                        </div>
                    </div>

                {{Form::close()}}
            </div>
        </div>
    </div>
</div>