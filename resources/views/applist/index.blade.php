@extends('layouts.app')

@section('content')

<div class="container">
    <button type="button" data-toggle="modal" data-target="#mdlCreateApp" style="margin-bottom: .5em;">
        Create App
    </button>
    <hr style="margin-bottom: .5em;">
        @foreach($apps->chunk(4) as $chunk)
            {{-- <th>{{$app}}</th> --}}
            <div class="row">
                @foreach($chunk as $app)
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-header">{{$app}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">Users: {{$count[strToLower($app)]}}</div>
                                    <div class="col-md-1"> | </div>
                                    <div class="col-md-4"><small>enabled</small></div>
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