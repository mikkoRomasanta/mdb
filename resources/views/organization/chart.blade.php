@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header theme-bg theme-color text-center"><h6>Org Chart</h6></div>
        <div class="card-body theme-color-rev" style="font-size: .8em;">
            <div class="row">
                @foreach($divs as $div)
                    <div class="col-md-6 border-bottom">
                        <div class="row">
                            <div class="col-md-6"><strong>{{$div->division_name}}</strong></div>
                            <div class="col-md-6"><span class='theme-color'><strong>GM: </strong></span>{{$div->gm}}</div>
                            <div class="card">
                                <div class="card-body">tetst</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
