<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Gallery;
use App\User;
use App\Venue;
use App\Comments;
use Auth;
use DB;
use Carbon\Carbon;
use Storage;
use Session;

class eventController extends Controller
{
    public function create(){
      return view('events.create');

    }
    public function store(request $request){
      //return $request->all();
      $filename = $request->image->getClientOriginalName();
      $data = new Event;
      $data->name = $request->name;
      $data->date = $request->date;
      $data->start_time = $request->start_time;
      $data->finish_time = $request->finish_time;
      $data->location = $request->location;
      $data->description = $request->description;
      $data->subject = $request->subject;
      $data->type = $request->type;
      $data->max_capasity = $request->max_capasity;
      $data->price = $request->price;
      $data->speaker = $request->speaker;
      $data->visibility = $request->visibility;
      $data->image = $filename;
      $data->save();
      $request->image->storeAs('public', $filename);

      $venue = new Venue;
      $venue->event_id = $data->id;
      $venue->first_line = $request->first_line;
      $venue->second_line = $request->second_line;
      $venue->city = $request->city;
      $venue->postcode = $request->postcode;
      $venue->save();
      return redirect('event/manage');
    }
    public function manage(){
      $events = Event::all();
      foreach ($events as $event){
        $imageCount = Gallery::where('event_id',$event->id)->count();
        $event['imageCount'] = $imageCount;
        $event['bookingCount'] = DB::table('bookings')->where('event_id',$event->id)->count();
      }

      return view('events.manage',compact('events'));
    }
    public function edit($id){
      $event = Event::find($id);
      return view('events.edit',compact('event'));
    }
    public function update(request $request){
      $request->validate([
          'name' => 'required|max:50|min:4',
          'description' => 'required|max:500',
      ]);
      $data = Event::find($request->id);
      $data->name = $request->name;
      $data->date = $request->date;
      $data->start_time = $request->start_time;
      $data->finish_time = $request->finish_time;
      $data->location = $request->location;
      $data->description = $request->description;
      $data->subject = $request->subject;
      $data->type = $request->type;
      $data->max_capasity = $request->max_capasity;
      $data->price = $request->price;
      $data->speaker = $request->speaker;
      $data->visibility = $request->visibility;
      $data->save();
      return redirect('/event/manage');
    }
    public function index(request $request){
      //return $request->all();

      if(!empty($request->all())){
         $request->validate([
          'month' => 'integer',
          'year' => 'integer',
          'subject' => 'max:40',
          'range' => 'required|integer',
          'postcode' => 'max:60',

        ]);
        $year = $request->year;
        $mon = $request->month;
        $range =  $request->range;
        session(['range'=>$range]);
        $pos = $request->postcode;
        $sub = $request->subject;
        $events = $this->searchEventDate($mon,$year);
      }
      else{
        if(!empty(session('postcode'))){
          $pos = session('postcode');
        }
        else{
          $pos = '';
        }
        if(!empty(session('range'))){
          $range = session('range');
        }
        else{
          $range = 1000;
        }
        $sub = '';
        $mon = 0;
        $year = 0;
        $events = $this->getEvents('f');
      }
      if(!empty($request->subject)){
         $events = $this->searchSubject($events,$request->subject);
      }
      if(!empty($pos)){
          $events = $this->searchByDistance($request->range, $request->postcode,$events);
          if(!empty($events[0]->id)){
            foreach($events as $event){
              $postcode = Venue::select('postcode')->where('event_id',$event->id)->get();
              $event->distance = $this->distanceCal($pos, $postcode);
            }
          }
      }
      $events = $this->dataFormat($events);
      //return $mon;
      //return $events;
      return view('events.index',compact('events','mon','year','range','sub','pos'));
    }
    public function searchEventDate($mon, $year,$timescale = 1){
      if($mon > 0 && $year > 0){
        $dt = Carbon::now();
        $dt->year   = $year;
        $dt->month  = $mon;
        $dt->day    = 1;
        return Event::whereBetween('date', [$dt->toDateString(),$dt->addMonths($timescale)->toDateString()])->orderBy('date', 'asc')->get();
      }
      else{
        return $this->getEvents('f');
      }
    }

    public function view($id){
      $event = Event::find($id);
      $venue = Venue::find($id);
      $venue->postcode;
      $lonLat = $this->geocode($venue->postcode);
      $event = $this->dataFormat($event);
      $event = $event[0];
      $comments = Comments::where('event_id',$id)->orderBy('created_at','dec')->get();
      foreach($comments as $comment){
        $user = User::select('email','name')->where('id',$comment->user_id)->get();
        $comment->user_name = $user[0]->name;
        $comment->user_email = $user[0]->email;
      }
      return view('events.view',compact('event','venue','lonLat','comments'));
    }
    public function addComment(request $request){
      //return $request->all();
      $data = new Comments;
      $data->event_id = $request->id;
      $data->user_id = Auth::id();
      $data->comment = $request->comment;
      $data->save();
      return redirect('/event/'.$request->id.'/view');
    }
    public function book(request $request){
      $event = Event::find($request->id);
      $userId = Auth::user()->id;
      $now = Carbon::now();
      $test = DB::table('bookings')->where('user_id',$userId)->where('event_id',$event->id)->get();
      if(empty($test[0]->id)){
        DB::table('bookings')->insert(
            [
              'event_id' => $event->id,
             'user_id' => $userId,
             'status' => 0,
             'created_at' => $now,
           ]
        );
      }
      return redirect('event/'.$event->id.'/view');
    }
    public function usersBookedOnEvent($id){
      $users = DB::table('bookings')->select('user_id')->where('event_id',$id)->get();
      $userDetails = array();
      foreach($users as $user){
        $userDetails[] = User::where('id',$user->user_id)->get();
      }
      //return $userDetails;
      return view('events.bookedUsers',compact('userDetails'));
    }
    public function myBookedEvents(){
      $userId = Auth::user()->id;
      $events = $this->getEvents('f',$userId);
      return view('events.myBookings',compact('events'));
    }
    public function myEventHistory(){
      $userId = Auth::user()->id;
      $events = $this->getEvents('p',$userId);
      return view('events.myEventHistory',compact('events'));
    }
    public function dateFormat($date){
      $year =  substr($date,0,4);
      $mon =  substr($date,5,-3);
      $day =  substr($date,8);
      $date = Carbon::createFromDate($year,$mon,$day);
      return $date->toFormattedDateString();

    }
    public function getEvents($x = 'a', $id = NULL){
      $dt = Carbon::now();
      if(empty($id)){
        if($x == 'f'){
          $events = Event::whereDate('date', '>', $dt)->get();
        }
        elseif($x == 'p'){
          $events = Event::whereDate('date', '<', $dt)->get();
        }
        elseif($x = 'a'){
          $events = Event::all();
        }
      }else{
       $eventIds = DB::table('bookings')->select('event_id')->where('user_id', $id)->get();
        $events = array();
        if($x == 'f'){
          foreach($eventIds as $eventId){
              $event = Event::where('id', $eventId->event_id)->where('date', '>', $dt)->get();
              if(!empty($event[0]->id)){
                $events[] = $event[0];
              }
           }

        }
        elseif($x == 'p'){
          foreach($eventIds as $eventId){
              $event = Event::where('id', $eventId->event_id)->where('date', '<', $dt)->get();
              if(!empty($event[0]->id)){
                $events[] = $event[0];
              }
           }
        }
        elseif($x == 'a'){
          foreach($eventIds as $eventId){
             $event = Event::where('id', $eventId->event_id)->get();
              if(!empty($event[0]->id)){
                $events[] = $event[0];
              }
           }
        }
      }
      //return $events;
      return $events;
    }
    public function dataFormat($events){
      //return $events;
      if(empty($events->id) && empty($events[0]->id)){
        return $events = 0;
      }

      if(empty($events[0]->id)){
        $events = array($events);
      }
      foreach($events as $event){
        $event->date = $this->dateFormat($event->date);
        $event->start_time = substr($event->start_time,0,-3);
        $event->finish_time = substr($event->finish_time,0,-3);
        $event->image = Storage::url($event->image);
        $event->price = number_format((float)$event->price, 2, '.', '');
      }

      return $events;
    }
    public function searchBuild(){
      $types = array();
      $subject = array();
      $eventTypes = Event::select('type')->get();
      $types = array();
      foreach($eventTypes as $r){
        $types[] = $r['type'];
      }
      return $this->arrayRemoveDuplicates($types);
    }
    public function arrayRemoveDuplicates($x){
      $m =array();
      foreach($x as $y){
        if(!in_array($y,$m)){
          $m[] = $y;
        }
      }
      return $m;
    }
    public function geocode($address){
      $arrContextOptions=array(
          "ssl"=>array(
              "verify_peer"=>false,
              "verify_peer_name"=>false,
          ),
      );
        // url encode the address
        //$address = urlencode($address);
        // google map geocode api url
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyCn5l93lWIys0bRYb97uWDJe_m1M0LcwyI";
        // get the json response
        $resp_json = file_get_contents($url,false, stream_context_create($arrContextOptions));
        // decode the json
        $resp = json_decode($resp_json, true);
        // response status will be 'OK', if able to geocode given address
        if($resp['status']=='OK'){
            // get the important data
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
            // verify if data is complete
            if($lati && $longi && $formatted_address){
                // put the data in the array
                $data_arr = array();
                array_push(
                    $data_arr,
                        $lati,
                        $longi,
                        $formatted_address
                    );
                return $data_arr;

            }else{
                return false;
            }
        }
        else{
            echo "<strong>ERROR: {$resp['status']}</strong>";
            return false;
        }
    }
    public function searchByDistance($range = 25, $postcode = 'ba34ts',$events = NULL){
      //return $events;

      if(!empty($events)){
        $c = array();
        $array = array();
        foreach($events as $event){
          $venue = Venue::select('postcode')->where('event_id',$event->id)->get();
          $array['postcode'] = $venue[0]->postcode;
          $array['event_id'] = $event->id;
          $c[] = $array;
        }
        //return $c;
      $f = array();
        foreach($c as $location){
          $loca = $location['postcode'];
          $distance = $this->distanceCal($postcode,$loca);
          //return array($range, $distance);
          if($range >= $distance){
            $f[] = $location['event_id'];
          }
        }
        //return $f;
        $events = array();
        foreach($f as $m){
          $l = Event::where('id',$m)->get();
          $events[] = $l[0];
        }
        if(!empty($events[0])){
          return $events;
        }else{
          return NULL;
        }
      }
      else{
        $events = array();
      }

    }
    public function searchSubject($events, $subject){
      //return $events;
      $array = array();
      foreach($events as $event){
        if( stripos($event->subject,$subject) !== false || stripos($event->name,$subject)) {
            $array[] = $event;
        }
      }
      return $array;
    }
    public function distanceCal($from,$to){
      $arrContextOptions=array(
          "ssl"=>array(
              "verify_peer"=>false,
              "verify_peer_name"=>false,
          ),
      );
      $from = str_replace(" ","+",$from);
      $to = str_replace(" ","+",$to);
      $url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$from.'&destinations='.$to.'&key=AIzaSyCn5l93lWIys0bRYb97uWDJe_m1M0LcwyI";
      $resp_json = file_get_contents($url,false, stream_context_create($arrContextOptions));
      $resp = json_decode($resp_json, true);
      if(!empty($resp['rows'][0]['elements'][0]['distance']['text'])){
        session(['postcode'=>$from]);
        $distance = (float) $resp['rows'][0]['elements'][0]['distance']['text'];
      }
      else{
        $distance = 0;
      }
      return $distance;
    }
}
