<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Scheduler;
use App\Event;
use Route;
use Session;
use Auth;
use DB;

class SchedulerController extends Controller
{
    
    public function __construct() {
        
        $cu_route = Route::getCurrentRoute()->getActionName();
        $route_details = explode('@',$cu_route);        
        $action=$route_details[1];       
        if($action == "display" && Auth::guest()){
            $this->middleware('auth');
            return redirect('/login');
        }else {
            
            if($action == "step1"){
                $booking_url = Route::current()->parameter('booking_url');               
                $user = DB::table('users')->where('booking_url', $booking_url)->first();
                $organiser_details = array(
                    'id'=>$user->id,
                    'name'=>$user->name,
                    'booking_url'=>$booking_url
                );               
                Session::put('organiser_details', $organiser_details);
            }
        }
        
    }
    
    public function display($filter=""){        
        $user = Auth::user();        
        
        if($filter == 'past'){
            $order_by = 'DESC';
            $date_condition = '<';
        }else{
            $order_by = 'ASC';
            $date_condition = '>=';
        }
        
        $schedules = Scheduler::leftJoin('events', 'schedulers.event_type_id', '=', 'events.id')
                    ->select('*','events.event_name')
                    ->where('events.user_id',$user->id)
                    ->where('schedulers.scheduled_date', $date_condition ,date('Y-m-d'))
                    ->orderBy('schedulers.start_time', $order_by)
                    //->get()
                    ->paginate(2);
        $group_by_dates=array();
        
        foreach($schedules as $key=>$value){
            $group_by_dates[$value->scheduled_date][] = $value->toArray();
        }
        
        $tmp = Event::get(['id', 'event_name', 'event_duration'])->toArray();        
        foreach($tmp as $key=>$val){
            $all_event_types[$val['id']] = $val;
        }
        return view('schedulers.display',compact('schedules','all_event_types','group_by_dates','filter'));
    }
    
    public function step1(){
        
        $all_event_types = Event::where('user_id', Session::get('organiser_details')['id'])->get();        
        return view('schedulers.step1',compact('all_event_types'));
    }
    
    public function step2($event_id){   
        $event_details = Event::find(base64_decode($event_id));
        return view('schedulers.step2',compact('event_details','event_id'));
    }
    
    public function check($cur_date){   
        $this->layout = null;        
        $resultset = Scheduler::select('start_time')->where('scheduled_date', "$cur_date")
               ->get();
        
        $filled_slot = $resultset->toArray();
        
        return view('schedulers.partial',compact('filled_slot','cur_date'));
    }
    
    public function step3($param1){
        
        list($time_slot,$event_type_id) = explode('#',base64_decode($param1));
        
        $event_details = Event::find(base64_decode($event_type_id));
        
        $display_date = date("l, M d, Y",$time_slot);        
        $start_time = date("g:i a", $time_slot);        
        $time_slot_till = strtotime("+$event_details->event_duration minutes",$time_slot);
        $end_time = date("g:i a", $time_slot_till);        
        $display_duration = $start_time . ' - ' . $end_time.',';
        
        Session::put('sess_event_name',$event_details->event_name);
        
        return view('schedulers.step3',compact('event_details','event_type_id','display_date','display_duration','time_slot','time_slot_till'));
        
    }
    
    public function store(Request $request){
        
        $this->validate($request,[
           'first_name'=>'required',
           'last_name'=>'required',
           'email'=>'required|email'
        ],[
            'first_name.required'=>'Please enter first name',
            'last_name.required'=>'Please enter last name',
            'email'=>'This is not a valid email',
            'email.required'=>'Please enter email'
        ]);
        
        
        Scheduler::create([
            'event_type_id' => base64_decode($request->event_type_id),
            'scheduled_date' => date('Y-m-d',$request->time_slot),
            'start_time' => $request->time_slot,
            'end_time' => $request->time_slot_till,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email
        ]);     
        session()->flash('schedule_text',$request->schedule_text);
        return redirect('/schedule/confirm');
    }
        
    public function confirm(){
        $sess_event_name = Session::get('sess_event_name');
        return view('schedulers.confirm',compact('sess_event_name'));
    }
   
}