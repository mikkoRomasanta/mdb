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
                        <div class="card text-center">{{$app}}</div>
                    </div>
                @endforeach
            </div>
        @endforeach
</div>

@endsection

@section('modal')
    @include('applist.create-app-modal')
@endsection