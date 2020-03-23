<div class="modal fade" id="mdlCreateApp" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header theme-bg theme-color">
                <h4 class="modal-title" id="mdlTitle">Create App</h4>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body theme-color-rev">
                {{Form::open(['action' => 'AppController@store', 'method' => 'POST'])}}
                    <div class="form-group row">
                        {{Form::label('app_name', 'App Name',['class' => 'col-md-3 col-form-label', 'style' => 'font-weight: bold'])}}
                        {{Form::text('app_name','',['id' => 'empBox', 'class' => 'col-md-8 form-control', 'placeholder' => 'ex. GSIS, UMDB, or VDB'])}}
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