@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="row t-border-1-gray">
        <div class="col-md-8 col-centered">
        
        @if(count($group_by_dates) > 0 )
        
            <a href="{{route('schedule.display',['filter'=>'upcoming'])}}" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">Upcoming</a>
            <a href="{{route('schedule.display',['filter'=>'past'])}}" class="btn btn-default" tabindex="-1" role="button" aria-disabled="true">Past</a>
            <br/><br/>
        
                @foreach($group_by_dates as $key=>$value)
                    
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ date("l, M d Y",strtotime($key)) }} 
                    </div>

                    <div class="panel-body">
                        @foreach($value as $appointments)
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="fa-stack fa-lg">
                                            <i class="fa fa-circle fa-stack-1x purple"></i>
                                    </span>
                                    {{ date('g:i a',$appointments['start_time']) . ' - ' . date('g:i a',$appointments['end_time']) }}
                                </div>

                                <div class="col-md-6">
                                    <p><strong>{{$appointments['first_name']}} {{$appointments['last_name']}}</strong></p>
                                    <p>
                                        Event Type : <strong>{{ $appointments['event_name'] }}</strong>
                                    </p>
                                </div>
                            </div>
                            <hr/>
                            
                            @if(!$schedules->hasMorePages())
                                <p class="text-center small">
                                     You have reached to the end of the list.   
                                </p>
                            @endif
                            
                            
                        @endforeach
                    </div>
                    
                </div>
                
                @endforeach
        
                <?php echo $schedules->links(); ?>
            @else
                <div class="text-center">
                    You have no schedule!
                </div>
                <br>
            @endif
                
        </div>
    </div>

</div>
   
    
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
  jQuery(document).ready( function() {
    jQuery( "#tabs" ).tabs();
  } );
</script>

@endsection