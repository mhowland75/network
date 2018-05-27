<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Gallery;
use Storage;

class galleryController extends Controller
{
    public function index(request $request){
      if(!empty($request->all())){
        // $request->all();
        $mon = $request->month;
        $year = $request->year;
        $sub = $request->subject;
        $events = app('App\Http\Controllers\eventController')->searchEventDate($mon,$year);
      }
      else{
        $mon = 0;
        $year = 0;
        $sub = '';
        $events = app('App\Http\Controllers\eventController')->getEvents('p');
      }
      if(!empty($sub)){
         $events = app('App\Http\Controllers\eventController')->searchSubject($events,$sub);
      }
    //  $events = app('App\Http\Controllers\eventController')->getEvents('p');
      foreach($events as $event){
        $images = Gallery::select('image')->where('event_id',$event->id)->paginate(6);
        foreach($images as $image){
          $image->image = Storage::url($image->image);
        }
        $event['images'] = $images;
      }
    //  return $images;
      //return $events;
      return view('gallery.index',compact('events','mon','year','sub'));
    }

    public function create(){
      $events = Event::select('id','name')->get();
      return view('gallery.create',compact('events'));
    }

    public function store(request $request){
    //  return $request->all();
      foreach($request->image as $image){
        $filename = $image->getClientOriginalName();
        $data = new Gallery;
        $data->event_id = $request->event;
        $data->image = $filename;
        $data->save();
        $image->storeAs('public', $filename);
      }

      return redirect('gallery/'.$request->event.'/manage');
    }
    public function update(){

      return view('gallery.update',compact());
    }

    public function view($id){
      $event = Event::select('name')->where('id',$id)->get();
      $images = Gallery::select('image')->where('event_id',$id)->get();
      foreach($images as $image){
        $image->image = Storage::url($image->image);
      }
      return view('gallery.view',compact('images','event'));
    }

    public function manage($id){
      $event = Event::where('id',$id)->get();
      $images = Gallery::where('event_id',$id)->get();
      foreach($images as $image){
        $image->image = Storage::url($image->image);
      }
      //return $images;
      return view('gallery.manage', compact('images','event'));
    }


}
