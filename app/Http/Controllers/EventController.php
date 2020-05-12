<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Event;
use Session;
//use Auth;

class EventController extends Controller
{
    
    public function __construct() {        
        $this->middleware('auth');        
    }
        
    public function add($id=""){
        
        $event_details = "";
        
        if(!empty($id)){            
            $event_details = Event::find($id);
            $action = 'Edit';  
        }else{
            $action = 'Add';        
        }       
        return view('events.add',compact('event_details','action'));
    }
    
    public function display(){
        
        //dd(Auth::check());
        
        //echo Session::get('id');
       
        $events = Event::where('user_id', Auth::id())
               ->get(); 
        
        return view('events.display',compact('events'));
    }
    
    public function store(Request $request){

        $this->validate($request, [
           'event_name' => 'required',
            'event_duration' =>'required'
        ],[
            'event_name.required' =>'Please enter event name',
            'event_duration.required' =>'Please choose/enter event duration'
        ]);
        
        if($request->id){
            Event::updateOrCreate(
                ['id' => $request->id],
                ['event_name' => $request->event_name, 'event_duration' => $request->event_duration,'user_id'=>Auth::id()]
            );              
        }else{
            Event::create([
                'event_name' => $request->event_name,
                'event_duration' => $request->event_duration,
                'user_id'=>Auth::id()
            ]);
        }
        session()->flash('msg','Event has been added');        
        return redirect('/event/add');
    }
    
    public function destroy($id){
        Event::destroy($id);
        return redirect()->back()->with('msg','Event has been deleted');
    }
}