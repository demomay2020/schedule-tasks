@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row t-border-1-gray">
        <div class="col-sm-10 col-centered">
            <div class="col-sm-3">           
                <p>
                    <a href="{{route('schedule.step1',['booking_url'=>Session::get('organiser_details')['booking_url']])}}"><i class="fa fa-arrow-left fa-2x t-info" aria-hidden="true"></i></a>
                </p>
                <br>
                <!--<div style="text-align: center">-->
                    <h5>{{Session::get('organiser_details')['name']}}</h5>
                    <h3><?php echo $event_details->event_name;?></h3>
                    <h5><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $event_details->event_duration?> mins</h5>
                    <br/>
                <!--</div>-->
            </div>

            <div class="col-sm-4">
                <p class="text-center"><strong>Select a Date & Time:</strong></p>
                    <div id="datepicker"></div>
            </div>

            <div class="col-sm-3" id="schedule_area" style="height: 315px;display:none;">
                Loading.....
            </div>
        </div>    
    </div>
</div>

<p>&nbsp;</p>

<div class="container">
    <div class="row mt-5">
        <div class="col-sm-10" id="continueDiv" style="display: none;text-align: right">
            <form method="get" action="" id="step2Form">
                <input type="hidden" id="hidden_event_type_id" name="hidden_event_type_id" value="{{ $event_id }}" disabled/>
                <input type="button" id="continueBtn" value="Continue" class="btn btn-info" onclick="window.location.href=$('#step2Form').attr('action')"/>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    var furl = window.location.pathname;
    var arr = furl.split('/');
    var append_link = '';
    if(arr[1] === 'public'){
        append_link = '/'+arr[1]+'/'+arr[2];
    }
    
    $(document).ready(function() {
        $("#datepicker").datepicker(
            { 
                startDate: new Date(), 
                daysOfWeekDisabled: [0,6],
            }).on('changeDate', function(e) {
                
                var curdate = e.format('yyyy-mm-dd');
                $('#chosen_date').val(curdate);
                $('#schedule_area').html('');
                $('#schedule_area').css('overflow-y','');
                $('#schedule_area').html('Loading.....');
                $('#schedule_area').show('slow');
                $('#continueDiv').hide();
                
                $.get(append_link + "/schedule/check/" + curdate,
                {
                  
                },
                function(data, status){
                  $('#schedule_area').css("overflow-y", "scroll").html(data);
                });
                
            });
        
    });// end of ready
    
    function choose_the_time(ts){
        $('#continueDiv').show();
        $('#step2Form').attr('action', append_link + "/schedule/step3/" + btoa(ts + '#' + '{{ $event_id }}'));        
        $('#continueBtn').removeClass('btn-default').addClass('btn-primary');
   }
    
</script>

@endsection