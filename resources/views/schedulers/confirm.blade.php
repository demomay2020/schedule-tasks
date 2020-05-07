@extends('layouts.app')
@section('content')

<div class="container">
    
<div class="row mt-40 t-border-1-gray">
    <div class="col-md-6 col-centered">        
        @if (session()->has('schedule_text'))
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <strong>Confirmed</strong>
                </div>
                <div class="panel-body">
                    <p class="text-center">You are scheduled with {{Session::get('organiser_details')['name']}}.</p>                    
                    <hr />
                    <h5 class="mln-12">
                        <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-1x purple"></i>
                        </span>
                        <span>{{ $sess_event_name }}</span>                        
                    </h5>    
                    
                    <h5><i class="fa fa-calendar" aria-hidden="true"></i> 
                        <span class="ml-12">{{ session()->get('schedule_text') }}</span>
                    </h5>
                        
                </div>
            </div>
        @endif 
    </div>
    
    <div class="row">
        <div class="col-md-6 col-centered">        
            @if (session()->has('schedule_text'))
                <div class="text-center">
                    <a href="{{route('schedule.step1',['booking_url'=>Session::get('organiser_details')['booking_url'] ])}}" > -> Schedule another event </a>
                </div>
            @endif 
        </div>
    </div>
    
</div>

</div>    
    
@endsection