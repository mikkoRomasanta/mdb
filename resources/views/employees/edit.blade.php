@extends('layouts.app')

@section('content')

<div class="container">
    <div>USER: {{$id}}</div><hr>
    <div class="card">
        <div class="card-header">Authorized Process</div>
        <table class="table text-center">
            <thead>
                <tr>
                    <th>Process Id</th>
                    <th>Process</th>
                </tr>
            </thead>
            <tbody>
                @foreach($userProcess as $process)
                    <tr>
                        <td>{{$process->process->id}}</td>
                        <td>{{$process->process->process_name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer">

        </div>
    </div>
</div>

@endsection