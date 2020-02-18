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
                        <th>{{$app->name}}</th>
                    @endforeach
                </tr>
            </thead>
        </table>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            var DataTable =   $('#empTable').DataTable({
                "scrollY": 400,
                "scrollX": true,
                stateSave: true,
                ajax: {
                        url: "{{route('dt.emp')}}",
                        dataSrc: ''
                        },
                columns: [
                    { "defaultContent": "<a href='#' class='btn btn-info btn-sm' id='editBtn'><i class='fas fa-edit fa-fw'></i></a>"},
                    {'data' : 'emp_id'},
                    {'data' : 'first_name'},
                    {'data' : 'last_name'},
                    {'data' : 'dept'},
                    {'data' : 'email'},
                    {'data' : 'gsis',
                        render: function(data, type, row) {
                                if (data === 1) {
                                    return '<input type="checkbox" class="editor-active" onclick="return false;" checked>';
                                } else {
                                    return '<input type="checkbox" onclick="return false;" class="editor-active">';
                                }
                                return data;
                            }
                    },
                    {'data' : 'ldb',                        
                        render: function(data, type, row) {
                            if (data === 1) {
                                return '<input type="checkbox" class="editor-active" onclick="return false;" checked>';
                            } else {
                                return '<input type="checkbox" onclick="return false;" class="editor-active">';
                            }
                            return data;
                        }
                    },
                    {'data' : 'umdb',                        
                        render: function(data, type, row) {
                            if (data === 1) {
                                return '<input type="checkbox" class="editor-active" onclick="return false;" checked>';
                            } else {
                                return '<input type="checkbox" onclick="return false;" class="editor-active">';
                            }
                            return data;
                        }
                    },
                    {'data' : 'vdb',
                        render: function(data, type, row) {
                            if (data === 1) {
                                return '<input type="checkbox" class="editor-active" onclick="return false;" checked>';
                            } else {
                                return '<input type="checkbox" onclick="return false;" class="editor-active">';
                            }
                            return data;
                        }
                    }
                ],
                dom: "<'row'<'col-md-7'B><'col-md-2 chooseApps'>" +
                        "<'col-md-3'f>>" +
                        "<'row'<'col-md-6'><'col-md-6'>>" +
                        "<'row'<'col-md-12't>>" +
                        "<'row'<'col-md-3' l><'col-md-3'i><'col-md-6'p>>",
                buttons: [
                    'excel',
                    {
                        text: 'Add Apps',
                        className: 'dt-middle-button',
                        action: function ( e, dt, node, config ) {
                            $('#mdlEdit').modal('show')
                        }
                    },
                ]
                    
            });

            $('#empTable tbody')
                .on( 'click', '#editBtn', function () {
                    $("#mdlEdit").modal();
                    var data = DataTable.row( $(this).parents('tr') ).data();
                    // console.log('My object: ', data);
                    $('#mdlTitle').html('Edit Employee: '+data.emp_id);
                    $('#empBox').val(data.emp_id);
                    $('#fnameBox').val(data.first_name);
                    $('#lnameBox').val(data.last_name);
                    $('#ldbXBox').prop('checked',false); //TODO: get appList then loop through
                    $('#gsisXBox').prop('checked',false);
                    $('#umdbXBox').prop('checked',false);
                    $('#vdbXBox').prop('checked',false);

                    if(data.gsis === 1){
                        $('#gsisXBox').prop('checked',true);
                    }
                    if(data.ldb === 1){
                        $('#ldbXBox').prop('checked',true);
                    }
                    if(data.umdb === 1){
                        $('#umdbXBox').prop('checked',true);
                    }
                    if(data.vdb === 1){
                        $('#vdbXBox').prop('checked',true);
                    }


            });

        });
    </script>
@endpush

@section('modal')
    @include('employees.edit-emp')
@endsection