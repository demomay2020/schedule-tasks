@extends('layouts.app')

@section('content')

<div class="container">
<div class="row mt-40 t-border-1-gray">
    <div class="col-sm-12 mt-40 col-centered">
        
        @if (session()->has('msg'))
            <div class='alert alert-success'>{{ session()->get('msg') }}</div>
        @endif
        
        
        <div class="col-sm-6">
            <strong>My Link :</strong> <br><a href="{{route('schedule.step1',['booking_url'=>Auth::user()->booking_url])}}">
			{{ Auth::user()->booking_url }}</a>
        </div>

        <div class="col-sm-6">
            <div class="text-right">
                <a href=" {{route('event.add')}}" class="btn btn-default t-info t-border-2" > + New Event Type </a>
            </div>
        </div>
            
        <br/>
        <br/>
    </div>
    
    <div class="row">
    <div class="col-sm-12 mt-40">
    @if(isset($events) && count($events) > 0)    
        @foreach($events as $event)   
            <div class="col-sm-4">    
                <div class="panel panel-default">
                    <div class="panel-heading panel_heading">&nbsp;</div>
                    <!--<div class="panel-title">{{ $event->event_name }}</div>-->
                    <div class="panel-body">
                        <p style="font-size:16px;font-weight: bold">{{ $event->event_name }}</p>
                        <p>{{ $event->event_duration }} mins</p>
                    </div>            
                    <div class="panel-footer">
                        <a href=" {{ route('event.edit',['id'=>$event->id]) }}" > Edit </a>
                    </div>
                </div>    
            </div>    
        @endforeach
    @else
        <div class="text-center">
            You have not added any event!
        </div>
        <br>
    @endif    
    </div>
</div>
    
    
</div> 
      
</div>
@endsection