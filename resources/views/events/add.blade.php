@extends('layouts.app')

@section('content')

<div class="container">
<div class="row mt-40 col-centered">
    <div class="col-md-6">
        
        @if (session()->has('msg'))
            <div class='alert alert-success'>{{ session()->get('msg') }}</div>
        @endif
        
        <div style="text-align: left">
            <a href="{{route('event.display')}}" class="btn btn-default t-info t-border-1"> < Back </a>
        </div>
        
        <br/>
        
        <div class="panel panel-default">
            <form method="post" action="{{ route('event.create') }}">
            <div class="panel-heading">
                {{ $action }} Event Type
            </div>
            
            <div class="panel-body">
                
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="form-group mt-20">
                        <label for="event_name">Event Name *</label>
                        <input type="text" name="event_name" id="event_name" value="{{ !empty($event_details->event_name) ? $event_details->event_name : '' }}" class="form-control" style="width:78%"/>
                        <div class="text-danger">
                            {{ $errors->has('event_name')?$errors->first('event_name'):'' }}
                        </div>    
                    </div>    
                    
                    <div class="form-group mt-20">
                        
                        <label for="event_duration">Event Duration *</label>
                        
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            
                            @foreach(range(15,60,15) as $duration)
                            
                            <label class="btn btn-default" id="label_{{ $duration }}">
                              <input type="radio" name="options" class="options" id="{{$duration}}" onchange="choose_duration({{$duration}})"> {{ $duration }} min
                            </label>
                            &nbsp;
                            
                            @endforeach
                            
                            &nbsp;&nbsp;
                            <label class="">
                                <input type="text" name="options" id="custom_min" placeholder="Custom min" class="form-control" onfocus="choose_duration()" style="width:55%"> 
                            </label>
                        </div>
                        <!--<div class="is-invalid" id="duration_error" style="display:none">Please choose/enter a duration.</div>-->
                        <input type="hidden" name="event_duration" id="event_duration" class="form-control" value="{{!empty($event_details->event_duration) ? $event_details->event_duration : ''}}"/>
                        <input type="hidden" name="id" value="{{!empty($event_details->id) ? $event_details->id : ''}}"/>
                        <div class="text-danger">
                            {{ $errors->has('event_duration')?$errors->first('event_duration'):'' }}
                        </div>
                    </div>
                    
            </div>
                
            <div class="panel-footer">
                <div class="text-right">                
                    <a href="/event/display" class="btn btn-md btn-default"> Cancel </a>
                    <input type="submit" class="btn btn-md btn-info" value="Save"/>
                </div>
            </div>    
                
            </form>
        </div>    
        
    </div>
</div>

</div>

<script type="text/javascript">
    
    var _action = '{{ $action }}';
    
    if(_action == 'Edit'){
        
        var _event_duration = '{{ !empty($event_details->event_duration) ? $event_details->event_duration : '' }}';
        //console.log(_event_duration);
        var default_options = false;
        $('.options').each(function(index, obj){
            
            if(this.id == _event_duration){
                $('#label_'+this.id).css('border','2px solid #007bff');
                default_options = true;
            }
        });
        
        if(!default_options){
            //filling custom mins
            $('#custom_min').val(_event_duration);
        }
        
        //filling existing duration
        $('#event_duration').val(_event_duration);
    }
    
    function choose_duration(num = null){
        
        $('.options').each(function(index, obj){
            if(this.id != num){
                //$('#label_'+this.id).css('border','0px');
                $('#label_'+this.id).css('border','1px solid #ccc');
            }else{
                $('#label_'+this.id).removeClass('active');
            }
        });
        
        if(num != null){
            $('#event_duration').val(num);
            $('#label_'+num).css('border','2px solid #007bff');
        }else{
            //$('#event_duration').val('');            
        }
        
    }
    
    $('#custom_min').on('keyup', function() {
        if (this.value.length > 0 && this.value > 0) {
             $('#event_duration').val(this.value);
        }
    });
    
</script>

@endsection