@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped display nowarp" id="empTable"  style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Emp ID</th>
                    <th>Name</th>
                    <th>Last Name</th>
                    <th>Dept</th>
                    <th>Email</th>
                    @foreach($apps as $app)
                        <th>{{$app}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
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
                    {'data' : 'dept'},
                    {'data' : 'email'},
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
                    "scrollY": 400,
                    "scrollX": true,
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
                                window.location = 'employees/add'
                            }
                        },
                    ],
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
    @include('employees.edit-emp-modal')
    {{-- @include('employees.add-emp-modal') --}}
@endsection