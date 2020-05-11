@extends('layouts.app')

@section('content')

<div class="container">
<div class="row mt-40 t-border-1-gray">
    <div class="col-md-5 col-centered text-center">
        <h3>{{Session::get('organiser_details')['name']}}</h3>
        <p>Welcome to my scheduling page.<br/>
        Please follow the instructions to add an event.</p>
        <br/>
    </div>
    
    <div class="row">
        <div class="col-md-5 ml-30">
            @foreach($all_event_types as $val)
                <a href="{{route('schedule.step2',['event'=>base64_encode($val->id)])}}" style="text-decoration: none;color:#777;">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-1x purple"></i>
                            </span>

                            <strong >{{ $val->event_name }}</strong>

                            <p style="text-align: right;margin-top:-25px;"> 
                                 <i class="fa fa-caret-right fa-2x"></i>
                            </p>

                        </div>
                    </div>
                </a>    
            @endforeach

        </div>
    </div>
    
</div>

</div>
@endsection