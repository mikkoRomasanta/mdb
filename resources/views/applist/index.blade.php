@extends('layouts.app')

@section('content')

<div class="container">
    <button type="button" data-toggle="modal" data-target="#mdlCreateApp" style="margin-bottom: .5em;" class="btn theme-btn">
        Create App
    </button>
    <hr style="margin-bottom: .5em;">
        @foreach($apps->chunk(4) as $chunk)
            {{-- <th>{{$app}}</th> --}}
            <div class="row">
                @foreach($chunk as $app)
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header theme-bg theme-color">                                
                                {{-- {{Form::open(['action' => 'AppController@delete', 'method' => 'POST'])}} --}}
                                    {{Form::hidden('appName',$app,['readonly'])}}
                                
                                <strong>{{$app}}</strong>
                                    {{-- <a class="float-right btn-danger small-icon" title="delete" onclick="return confirm('Are you sure?')" type="submit" value="submit"><i class='fas fa-trash fa-fw'></i></a> --}}
                                    {{-- {{Form::button('<i class="fa fa-trash"></i>',['type' => 'submit','class' => 'float-right text-danger', 'title' => 'Delete'])}} --}}
                                {{-- {{Form::close()}} --}}
                            </div>
                            <div class="card-body theme-color-rev">
                                <div class="row">
                                    <div class="col-md-12">Users: {{$count[strToLower($app)]}}</div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            </div>
        @endforeach
</div>

@endsection

@section('modal')
    @include('applist.create-app-modal')
@endsection