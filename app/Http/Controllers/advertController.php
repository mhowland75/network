<?php

namespace App\Http\Controllers;
use App\Adverts;
use Illuminate\Http\Request;
use Storage;

class advertController extends Controller
{
    public function create(){
      return view('adverts.create');
    }
    public function store(request $request){
      //return $request->all();
      $filename = $request->image->getClientOriginalName();
      $data = new Adverts;
      $data->name = $request->name;
      $data->company = $request->company;
      $data->start_date = $request->start_date;
      $data->end_date = $request->end_date;
      $data->visibility = $request->visibility;
      $data->image = $filename;
      $data->save();
      $request->image->storeAs('public/adverts', $filename);
      return redirect('advert/index');
    }
    public function index(){
      $adverts = Adverts::all();
      foreach($adverts as $advert){
        $advert->image = Storage::url($advert->image);
      }
      return view('adverts.index',compact('adverts'));
    }
    public function edit($id){
      $advert = Adverts::find($id);
      $advert->image = Storage::url($advert->image);
      return view('adverts.edit',compact('advert'));
    }
    public function update(){

    }

}
