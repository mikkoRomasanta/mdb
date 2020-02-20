@extends('layouts.app')

@section('content')

<div class="container">
    <table class="table">
        <thead>
            <-- TODO: CREATE SIDEBAR(for apps) HERE! // Make cards?
            <tr>
                @foreach($apps as $app)
                    <th>{{$app}}</th>
                @endforeach
            </tr>
        </thead>
    </table>

    <button type="button" data-toggle="modal" data-target="#mdlCreateApp">
        Create App
    </button>

@endsection

@section('modal')
    @include('applist.create-app-modal')
@endsection