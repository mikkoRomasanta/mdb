@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="empDataTable">
            <table class="table table-striped display nowarp" id="empTable"  style="width:100%">
                <thead>
                    <tr>
                        <th style="color: white; background-color:gray">Actions</th>
                        <th>Emp ID</th>
                        <th>Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        @foreach($apps as $app)
                            <th>{{$app}}</th>
                        @endforeach
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script type="text/javascript">

    $(document).ready(function(){

        var checkbox = function ( data, type, full, meta ) { //function to display checkboxes instead of 1's and 0's
            if (data === 1) { //if 1/true then display a checked checkbox
                return '<input type="checkbox" class="editor-active" onclick="return false;" checked>';
            } else {
                return '<input type="checkbox" onclick="return false;" class="editor-active">';
            }
            return data;
        }

        var apps = []; // app list array from sql table 'apps'

        $.ajax({
            url: "{{route('pluck.app')}}", //get list
            type: 'get',
            dataType: 'JSON',
            success: function(response){
                var len = response.length;
                for(var i=0; i<len; i++){
                    // alert(response[i].toLowerCase());
                    apps.push(response[i].toLowerCase()); //put each app into array 'apps'
                    // console.log(apps);
                }

                var builtColumns = [ //column template to be used in DT
                    { "defaultContent": "<a href='#' class='btn btn-success btn-sm small-icon' id='editBtn' title='edit'><i class='fas fa-edit fa-fw'></i></a> <a href='#' class='btn btn-warning btn-sm small-icon' id='resetBtn' title='reset password'><i class='fas fa-undo-alt fa-fw'></i></a>"},
                    {'data' : 'emp_id'},
                    {'data' : 'first_name'},
                    {'data' : 'last_name'},
                    {'data' : 'email'},
                    {'data' : 'role'},
                    {'data' : 'status'},
                ]; //basically madagdag la after ning {data : email} rening atyu keng addAppColumns

                function addAppColumns(item,index){ //function to add app(item) to builtColumns
                    var element = {} //object yayni
                    element.data = item; //ex data: gsis
                    element.render = checkbox; //ex. render: checkbox
                    builtColumns.push(element)
                    // console.log(builtColumns);
                }
                
                apps.forEach(addAppColumns); //for each app call addAppColumns function ^

                var DataTable =   $('#empTable').DataTable({ //start of DT  
                    stateSave: true,
                    ajax: {
                            url: "{{route('dt.emp')}}",
                            dataSrc: ''
                            },
                    columns: builtColumns,
                    dom: "<'row'<'col-md-7'B><'col-md-2 chooseApps'>" +
                            "<'col-md-3'f>>" +
                            "<'row'<'col-md-6'><'col-md-6'>>" +
                            "<'row'<'col-md-12't>>" +
                            "<'row'<'col-md-3' l><'col-md-3'i><'col-md-6'p>>",
                    buttons: [
                        'excel',
                        {
                            text: 'Add Users',
                            className: 'dt-middle-button',
                            action: function ( e, dt, node, config ) {
                                window.location = '{{ route("create.user") }}'
                            }
                        },
                    ],
                    scrollY: "450px",
                    scrollX: true,
                    scrollCollapse: true,
                    columnDefs: [
                        { width: 35, targets: 0 },
                        { width: 80, targets: 1 },
                    ],
                    fixedColumns: {
                        leftColumns: 1,
                    },
                    orderBy: 1
                        
                }); // end of DT

                $('#empTable tbody') //for edit button + modal
                    .on( 'click', '#editBtn', function () {
                        $("#mdlEdit").modal();
                        var data = DataTable.row( $(this).parents('tr') ).data();
                        // console.log('My object: ', data);
                        $('#mdlTitle').html('Edit Employee: '+data.emp_id);
                        $('#empBox').val(data.emp_id);
                        $('#fnameBox').val(data.first_name);
                        $('#lnameBox').val(data.last_name);

                        for(var x=0;x<apps.length;x++){//for every app; do this
                            $('#appBox'+x).prop('checked',false); //clear checkboxes 1st
                            var app = apps[x]; //get appName
                            // console.log(app);
                            // console.log(data);
                            if(data[app] === 1){//ex. data.gsis / data.umdb
                                $('#appBox'+x).prop('checked',true); //check checkbox if bool is true
                            }
                        }

                    });

                    $('#empTable tbody') //for edit button + modal
                    .on( 'click', '#resetBtn', function () {
                        var data = DataTable.row( $(this).parents('tr') ).data(); //get row values
                        $("#mdlResetWith").modal(); 
                        if(data.email === null){ //if user has no email
                            $('#idBox').val(data.id);
                            $('#empIdBox').val(data.emp_id);
                            $('#emailBox').val(data.email); //reset box
                            $('#emailDiv').prop('hidden',true); //hide email input box
                            $('#passDiv').prop('hidden',false);
                        }else{
                            $('#idBox').val(data.id);
                            $('#empIdBox').val(data.emp_id);
                            $('#emailBox').val(data.email);
                            $('#emailDiv').prop('hidden',false);
                            $('#passDiv').prop('hidden',true);
                        }
                        var num = Math.floor(100 + Math.random() * 900)
                        $('#passSuffixBox').val(num);
                        $('#mdlTitleReset').html('Reset Password: '+data.emp_id);
                    });

            } //success function end 
        }); //ajax end

    });
</script>
@if (count($errors) > 0)
    <script>
        $( document ).ready(function() {
            $('#mdlAdd').modal('show');
        });
    </script>
@endif
@endpush

@section('modal')
    @include('employees.modal-edit-emp')
    @include('employees.modal-reset-emp')
@endsection