<div class="modal fade" id="mdlEdit" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header color-bg-main color-font-dark">
                <h4 class="modal-title" id="mdlTitle"></h4>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                {{Form::open(['action' => 'EmployeeController@update', 'method' => 'POST'])}}
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
                        {{Form::label('app_gsis', 'GSIS',['class' => 'col-md-1 col-form-label', 'style' => 'font-weight: bold'])}}
                        {{Form::checkbox('app_gsis',null,false,['id' => 'gsisXBox', 'class' => 'col-md-1 form-control'])}} <!-- intentional #id convention. -->

                        {{Form::label('app_ldb', 'LDB',['class' => 'col-md-1 col-form-label', 'style' => 'font-weight: bold'])}}
                        {{Form::checkbox('app_ldb',null,false,['id' => 'ldbXBox', 'class' => 'col-md-1 form-control'])}} <!-- intentional #id convention. -->

                        {{Form::label('app_umdb', 'UMDB',['class' => 'col-md-1 col-form-label', 'style' => 'font-weight: bold'])}}
                        {{Form::checkbox('app_umdb',null,false,['id' => 'umdbXBox', 'class' => 'col-md-1 form-control'])}} <!-- intentional #id convention. -->

                        {{Form::label('app_vdb', 'VDB',['class' => 'col-md-1 col-form-label', 'style' => 'font-weight: bold'])}}
                        {{Form::checkbox('app_vdb',null,false,['id' => 'vdbXBox', 'class' => 'col-md-1 form-control'])}} <!-- intentional #id convention. -->
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