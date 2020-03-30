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
                        </div>
                    </div>
                        <div class="col-md-6 border-bottom border-left">
                            @foreach($div->department as $dept)
                                <div class="row">
                                    <div class="col-md-12"><strong>{{$dept->department_name}}</strong></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"><span class='theme-color'><strong>DH: </strong></span>{{$dept->department_head}}</div>
                                    <div class="col-md-6"><span class='theme-color'><strong>ADH: </strong></span>{{$dept->assistant_department_head}}</div>
                                </div>
                            @endforeach
                        </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
