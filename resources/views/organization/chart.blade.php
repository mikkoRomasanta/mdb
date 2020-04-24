@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header theme-bg theme-color text-center theme-link">
            <h5>Org Chart <span style="font-size: .55em;"><a id="editBtn">Edit</a></span></h5>
        </div>
        <div class="card-body theme-color-rev" style="font-size: .8em;">
            <div class="row">
                @foreach($division as $key => $div)
                    <div class="col-md-6 border-bottom border-right">
                        <div class="row">
                            <div class="col-md-6"><strong>{{$div['div']}}</strong></div>
                            <div class="col-md-6"><span class='theme-color ml-3'><strong>GM:</strong> {{$div['gm']}}</span></div>
                        </div>
                        @foreach($div['dept'] as $dept)
                            <div class="row ml-3">
                                <div class="col-md-6">{{$dept['dept']}}</div>
                                <div class="col-md-6"><span class='theme-color'><strong>DH: </strong> {{$dept['dh']}}</span></div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card mt-3" id="addPositionCard" style="display:none">
        <div class="row">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header theme-bg theme-color text-center">{{Form::text('flexdata','',['id' => 'flexdata', 'placeholder' => 'add to division/dept', 'class' => 'form-control-sm flexdata'])}} ADD GM</div>
                        <div class="card-body theme-color-rev" style="font-size: .8em;">
                
                            <table class="table table-sm theme-color-rev" id="divTbl">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Division</th>
                                        <th>GM</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($division as $key => $div)
                                        <tr>
                                            <td class="divId">{{$div['id']}}</td>
                                            <td>{{$div['div']}}</td>
                                            <td>{{$div['gm']}}</td>
                                            <td><button class="text-success" id="addGmBtn"><i class="fas fa-plus-circle fa-fw" title="add or replace"></i></button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header theme-bg theme-color text-center">{{Form::text('flexdata','',['id' => 'flexdata2', 'placeholder' => 'add to division/dept', 'class' => 'form-control-sm flexdata'])}} ADD DH</div>
                        <div class="card-body theme-color-rev" style="font-size: .8em;">

                            <table class="table table-sm theme-color-rev" id="deptTbl">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Department</th>
                                        <th>DH</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($department as $d)
                                        <tr>
                                            <td class="deptId">{{$d['id']}}</td>
                                            <td>{{$d['dept']}}</td>
                                            <td>{{$d['dh']}}</td>
                                            <td><button class="text-success" id="addDhBtn"><i class="fas fa-plus-circle fa-fw" title="add or replace"></i></button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $.fn.dataTable.ext.classes.sPageButton = 'btn btn-sm btn-outline-secondary';
    $('.flexdata').flexdatalist({ //choose user to add to process
        minLength: 1,
        data: '{{url("empDataTable")}}',
        searchIn: ['emp_id','first_name','last_name'],
        valueProperty: 'id',
        visibleProperties: ['emp_id','first_name','last_name'],
        selectionRequired: true,
        searchContain: true
    });

    $('#editBtn').on('click', function(){
        $('#addPositionCard').slideToggle();
    });

    $('#divTbl tbody').on( 'click', '#addGmBtn', function () {

        var div_id = $(this).closest('tr').find('.divId').text();
        var user_id = $('#flexdata').val();

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if(user_id == ''){
                alert('please select a user');
            }

        $.ajax({
            type: "POST",
            url: "{{route('store.gm')}}",
            data: {
                'user_id':user_id,
                'div_id':div_id,
            },
            success:function(data) {
                alert('GM successfully added/repalced');
                location.reload();
            },
        });        
    });

    $('#deptTbl').DataTable({});

    $('#deptTbl tbody').on( 'click', '#addDhBtn', function () {

        var dept_id = $(this).closest('tr').find('.deptId').text();
        var user_id = $('#flexdata2').val();

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if(user_id == ''){
                alert('please select a user');
            }

        $.ajax({
            type: "POST",
            url: "{{route('store.dh')}}",
            data: {
                'user_id':user_id,
                'dept_id':dept_id,
            },
            success:function(data) {
                alert('GM successfully added/repalced');
                location.reload();
            },
        });        
    });

});
</script>
@endpush
