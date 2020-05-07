<?php
    $start=strtotime($cur_date . ' 10:00');
    $end=strtotime($cur_date . ' 19:00');
    //36000 68400
    foreach ( range( $start, $end, 900 ) as $timestamp ) {
            
        $slot_occupied = in_array($timestamp, array_column($filled_slot, 'start_time'));
        
        $ymp_display_timeslot = date( 'g:i a', $timestamp );
        
        $display_timeslot = (strlen($ymp_display_timeslot) == 7)?'0'.$ymp_display_timeslot:$ymp_display_timeslot;
    ?>
    
    @if (!$slot_occupied)
        <input type="button" class="btn btn-default btn-md col-sm-12 t-info t-border-1 mt-5" value="{{ $display_timeslot }}" onclick="choose_the_time('{{ $timestamp }}')"/>
    @else
        <input type="button" class="btn btn-danger btn-md col-sm-12 mt-5" value="{{ $display_timeslot }}" disabled/>
    @endif
        
    <?php } ?>