@extends('layouts.app')

@section('content')

<div class="container">

<div class="row mt-40 t-border-1-gray">
    <div class="col-md-9 col-centered">
        <div class="col-md-5">

            <p>
                <a href="{{route('schedule.step2',['event'=>base64_encode($event_details->id)])}}"><i class="fa fa-arrow-left fa-2x t-info" aria-hidden="true"></i></a>
            </p>
            <br>

            <!--<div style="text-align: left">-->
                <h5>{{Session::get('organiser_details')['name']}}</h5>
                <h3>{{ $event_details->event_name }}</h3>
                <h5><i class="fa fa-clock-o" aria-hidden="true"></i>
                {{ $event_details->event_duration }} mins</h5>
                <h5 class="text-success">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    {{ $display_duration }} {{ $display_date }}
                </h5>
                <br/>
            <!--</div>-->
        </div>
    
        <div class="col-md-4">

            <form method="post" action="{{ route('schedule.create') }}">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div class="form-group">
                    <label for="fn">First Name*</label>
                    <input type="text" name="first_name" id="first_name" class="form-control"/>
                    <div class="text-danger">
                        {{ $errors->has('first_name')?$errors->first('first_name'):'' }}
                    </div>    
                </div>    

                <div class="form-group">
                    <label for="ln">Last Name*</label>
                    <input type="text" name="last_name" id="last_name" class="form-control"/>
                    <div class="text-danger">
                        {{ $errors->has('last_name')?$errors->first('last_name'):'' }}
                    </div>    
                </div>

                <div class="form-group">
                    <label for="em">Email*</label>
                    <input type="text" name="email" id="email" class="form-control"/>
                    <div class="text-danger">
                        {{ $errors->has('email')?$errors->first('email'):'' }}
                    </div>    
                </div>

            <input type="hidden" id="schedule_text" name="schedule_text" value="{{ $display_duration }} {{ $display_date }}"/>
            <input type="hidden" id="event_type_id" name="event_type_id" value="{{ $event_type_id }}"/>
            <input type="hidden" id="time_slot" name="time_slot" value="{{ $time_slot }}"/>
            <input type="hidden" id="time_slot" name="time_slot_till" value="{{ $time_slot_till }}" />

            <div class="form-group mt-30">
                <input type="submit" class="btn btn-info" value="Schedule Event"/>
            </div>

            </form>
        </div>
    </div>
</div>

</div>

<script type="text/javascript">
    
    $(function() {
        $("#datepicker").datepicker(
            { startDate: new Date(), daysOfWeekDisabled: [0,6]}
        );
    });
    
    function choose_the_time(ts){
        $('#time_slot').val(ts);
   }
    
</script>

@endsection