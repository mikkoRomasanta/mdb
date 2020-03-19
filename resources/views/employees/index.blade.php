@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="empDataTable">
            <table class="table table-striped display nowarp" id="empTable"  style="width:100%;line-height: 1em;">
                <thead>
                    <tr class="bg-gradient-secondary text-white" id="filterRow">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        @foreach($apps as $app)
                            <th></th>
                        @endforeach
                    </tr>
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
            if (data === 1) { //if 1/true then display a checked checkbox // <input type="hidden" value="' + data + '" />
                return '<input type="checkbox" class="editor-active" onclick="return false;" checked><input type="hidden" value="' + data + '" />';
            } else {
                return '<input type="checkbox" onclick="return false;" class="editor-active"><input type="hidden" value="' + data + '" />';
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
                    orderBy: 1,
                    initComplete: function () {
                        this.api().columns([5,6]).every( function () {
                            var column = this;
                            var select = $('<select style="font-size: .8em;width: 100%;"><option value="">All</option></select>')
                            .appendTo($("#filterRow").find("th").eq(column.index()))
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                                );

                                column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                            } );
                            column
                            .data()
                            .unique()
                            .sort()
                            .each(function(d, j) {
                                var val = $.fn.dataTable.util.escapeRegex(d);
                                if (column.search() === "^" + val + "$") {
                                select.append(
                                '<option value="' + d + '" selected="selected">' + d + "</option>"
                                );
                                } else {
                                select.append('<option value="' + d + '">' + d + "</option>");
                                }
                            });
                        } );
                    }
                        
                }); // end of emp DT

                $('#empTable tbody') //for edit button + modal
                    .on( 'click', '#editBtn', function () {
                        $("#mdlEdit").modal();
                        var data = DataTable.row( $(this).parents('tr') ).data();
                        // console.log('My object: ', data);
                        $('#mdlTitle').html('Edit Employee: '+data.emp_id);
                        $('#empBox').val(data.emp_id);
                        $('#fnameBox').val(data.first_name);
                        $('#lnameBox').val(data.last_name);
                        $('#emailBox').val(data.email);
                        $('#roleBox').val(data.role);
                        var id = data.id;
                        $('#idEditBox').val(data.id);
                        
                        for(var x=0;x<apps.length;x++){//for every app; do this
                            $('#appBox'+x).prop('checked',false); //clear checkboxes 1st
                            var app = apps[x]; //get appName
                            // console.log(app);
                            // console.log(data);
                            if(data[app] === 1){//ex. data.gsis / data.umdb
                                $('#appBox'+x).prop('checked',true); //check checkbox if bool is true
                            }
                        }

                        $.get('{{url('userProcess')}}/' + id,function(data,status){ //processes of selected user
                            var str = '';
                            // alert(id);
                            // console.log(data);
                            $.each( data, function( key, value ) { //add rows for every process
                                str += '<tr><td hidden="hidden">'+value["id"]+'</td><td>'+value["process"]["process_name"]+'&emsp;&emsp;</td><td>'+
                                '<button class="text-danger" id="delBtn"><i class="fas fa-minus-circle fa-fw" title="delete process"></i></button></td></tr>';
                            });

                            $('#userProcessTableBody').html(str); //insert rows into table
                            
                        });

                    });

                    $('#empTable tbody') //for reset button + modal
                    .on( 'click', '#resetBtn', function () {
                        var data = DataTable.row( $(this).parents('tr') ).data(); //get row values
                        $("#mdlResetWith").modal(); 
                        if(data.email === null){ //if user has no email
                            $('#idBox').val(data.id);
                            $('#empIdBox').val(data.emp_id);
                            $('#emailResetBox').val(data.email); //reset box
                            $('#emailDiv').prop('hidden',true); //hide email input box
                            $('#passDiv').prop('hidden',false);
                        }else{
                            $('#idBox').val(data.id);
                            $('#empIdBox').val(data.emp_id);
                            $('#emailResetBox').val(data.email);
                            $('#emailDiv').prop('hidden',false);
                            $('#passDiv').prop('hidden',true);
                        }
                        var num = Math.floor(100 + Math.random() * 900)
                        $('#passSuffixBox').val(num);
                        $('#mdlTitleReset').html('Reset Password: '+data.emp_id);
                    });

                    $('#flexdata').flexdatalist({ //choose process to add to user
                        minLength: 1,
                        data: '{{url("getAllProcess")}}',
                        searchIn: 'process_name',
                        valueProperty: 'id',
                        visibleProperties: ['process_name'],
                        selectionRequired: true,
                        searchContain: true
                    });

                    $('#addBtn').click(function(){ //add process to current selected user
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var process_id = $('#flexdata').val();
                        var user_id = $('#idEditBox').val();

                        if(process_id == ''){
                            alert('please select a process');
                        }

                        $.ajax({
                            type: "POST",
                            url: "{{route('employeeProcess.store')}}",
                            data: {
                                'user_id':user_id,
                                'process_id':process_id,
                            },
                            success:function(data) {
                                alert('User successfully added to process');
                                location.reload();
                            },
                        });
                    });

            } //success function end 
        }); //ajax end

        //delete user process
        $('#userProcessTable tbody').on( 'click', '#delBtn', function () { //remove process from user
            var x = confirm('Are you sure you want to remove the process?');
            if(x != true){
                e.preventDefault();
            }else{
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var empProcess_id = $(this).closest('tr').children('td:eq(0)').text();

                $.ajax({
                    type: "POST",
                    url: "{{route('del.userProcess')}}",
                    data: {
                        'empProcess_id':empProcess_id,
                    },
                    success:function(data) {
                        alert('Process successfully deleted');
                        location.reload();
                    },
                });
            }
            
        });

    }); //document ready end
</script>
@if (count($errors) > 0)
    <script>
        $( document ).ready(function() {
            $('#mdlEdit').modal('show');
            $('#mdlTitle').html('Edit Employee: ');
        });
    </script>
@endif
@endpush

@section('modal')
    @include('employees.modal-edit-emp')
    @include('employees.modal-reset-emp')
@endsection