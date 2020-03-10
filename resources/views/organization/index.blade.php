@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="card shadow pt-2 pb-2 mr-4 col-md-8">
            <table class="table table-condensed" id="processTable"  style="font-size: .8em" width="100%">
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
                <tbody>
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
        <div class="card shadow col-md-3" width="100%">
            <div class="card-header">USERS</div>
            <div class="card-body">
                <div id="usersLabel" class="font-weight-bold small"></div>
                <table id="usersTable" class="small"></table>
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

        $('#processTable').on('click','#viewBtn',function(){
            var i =table.row( $(this).parents('tr') ).data();
            var x =$(this).closest('tr').find('#viewBtn');
            var id = $(x).val();
            $('#usersLabel').html(i[3]);
            $.get('{{url('organization')}}/' + id,function(data,status){
                var str = '';
                // console.log(data);
                $.each( data, function( key, value ) {
                    str += '<tr><td>'+value["employees"][0]["last_name"]+' '+value["employees"][0]["first_name"]+'</td></tr>';
                });

                $('#usersTable').html(str);
                
            });

        });

    });
</script>
@endpush