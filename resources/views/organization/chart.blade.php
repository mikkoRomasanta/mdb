@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header theme-bg theme-color text-center"><h6>Org Chart</h6></div>
        <div class="card-body theme-color-rev" style="font-size: .8em;">
            <div class="row">
                @foreach($division as $key => $div)
                    <div class="col-md-6 border-bottom">
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
</div>

@endsection
