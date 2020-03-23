@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="card shadow pt-2 pb-2 mr-4 col-md-7">
            <table class="table table-condensed table-responsive theme-bg theme-color" id="processTable"  style="font-size: .8em" width="100%">
                <thead>
                    <tr id="filterRow">
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Action</th>
                        <th>Division</th>
                        <th>Department</th>
                        <th>Process</th>
                    </tr>
                </thead>
                <tbody class="theme-color-rev">
                    @foreach($data as $org)
                        <tr>
                            <td class="text-center text-info"><button class="btn btn-sm text-info "id="viewBtn" value="{{$org->id}}"><i class="fa fa-eye"></i></button></td>
                            <td>{{$org->division->division_name}}</td>
                            <td>{{$org->department->department_name}}</td>
                            <td>{{$org->process_name}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card shadow col-md-4 p-0" width="100%">
            <div class="card-header theme-bg theme-color">
                <div class="row">
                    <div class="col-md-4"><strong>USERS</strong></div>
                    <div class="col-md-6">
                        {{Form::text('flexdata','',['id' => 'flexdata', 'placeholder' => 'add user to process', 'class' => 'form-control-sm'])}}
                    </div>
                    <div class="col-md-2"><button class="text-success" id="addBtn"><i class="fas fa-plus-circle fa-fw" title="add user"></i></button></div>
                </div>
            </div>
            <div class="card-body theme-color-rev">
                <div id="usersLabel" class="font-weight-bold small text-center theme-bg-rev"></div>
                {{Form::hidden('process_id','',['id' => 'process_id'])}}
                <table id="usersTable" class="table-sm table-bordered table-responsive text-center small">
                    <thead>
                        <tr>
                            <th width="25%">Emp ID</th>
                            <th width="60%">Name</th>
                            <th width="20%">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="userProcessTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $.fn.dataTable.ext.classes.sPageButton = 'btn btn-sm btn-outline-secondary';
        var table = $('#processTable').DataTable( {
            "processing": true,
            "serverSide": false,
            "stateSave": true,
            initComplete: function () {
                this.api().columns([1,2]).every( function () {
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
        } );

        $('#processTable').on('click','#viewBtn',function(){ //show users of process
            var i =table.row( $(this).parents('tr') ).data();
            var x =$(this).closest('tr').find('#viewBtn');
            var id = $(x).val();
            $('#usersLabel').html(i[3]);
            $('#process_id').val(id);
            $.get('{{url('organization')}}/' + id,function(data,status){
                var str = '';
                // console.log(data);
                $.each( data, function( key, value ) {
                    str += '<tr><td hidden="hidden">'+value["id"]+'</td><td>'+
                    value["employees"][0]["emp_id"]+'&emsp;&emsp;</td><td>'
                    +value["employees"][0]["last_name"]+' '+value["employees"][0]["first_name"]+'</td><td>'+
                    '<button class="text-danger" id="delBtn"><i class="fas fa-minus-circle fa-fw" title="delete process"></i></button></td></tr>';
                });

                $('#userProcessTableBody').html(str);
                
            });

        });

        $('#flexdata').flexdatalist({ //choose user to add to process
            minLength: 1,
            data: '{{url("empDataTable")}}',
            searchIn: 'emp_id',
            valueProperty: 'id',
            visibleProperties: ['emp_id','first_name','last_name'],
            selectionRequired: true,
            searchContain: true
        });

        $('#addBtn').click(function(){ //add user to current selected process
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var user_id = $('#flexdata').val();
            var process_id = $('#process_id').val();

            if(user_id == ''){
                alert('please select a user');
            }
            else if(process_id == ''){
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

        //delete user process
        $('#usersTable tbody').on( 'click', '#delBtn', function () { //remove process from user
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

    });
</script>
@endpush