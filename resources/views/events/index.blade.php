@extends('layouts.app')
@section('content')
<div class="row">
 <div class="col-sm-3">
               <div class="panel panel-default">
                   <div class="panel-body">
                       <form class="form-horizontal" method="GET" action="/event/index">

                         <div class="form-group{{ $errors->has('month') ? ' has-error' : '' }}">
                             <label for="month" class="col-md-3 control-label">Month</label>
                             <div class="col-md-9">
                               <select id="month" name="month" class="form-control">
                                 <option value="0" <?php if($mon == 0){echo'selected';} ?>>Month</option>
                                <option value="1" <?php if($mon == 1){echo'selected';} ?>>Jan</option>
                                <option value="2" <?php if($mon == 2){echo'selected';} ?>>Feb</option>
                                <option value="3" <?php if($mon == 3){echo'selected';} ?>>March</option>
                                <option value="4" <?php if($mon == 4){echo'selected';} ?>>April</option>
                                <option value="5" <?php if($mon == 5){echo'selected';} ?>>May</option>
                                <option value="6" <?php if($mon == 6){echo'selected';} ?>>June</option>
                                <option value="7" <?php if($mon == 7){echo'selected';} ?>>July</option>
                                <option value="8" <?php if($mon == 8){echo'selected';} ?>>Aug</option>
                                <option value="9" <?php if($mon == 9){echo'selected';} ?>>Sep</option>
                                <option value="10" <?php if($mon == 10){echo'selected';} ?>>Oct</option>
                                <option value="11" <?php if($mon == 11){echo'selected';} ?>>Nov</option>
                                <option value="12" <?php if($mon == 12){echo'selected';} ?>>Dec</option>
                               </select>
                                 @if ($errors->has('month'))
                                     <span class="help-block">
                                         <strong>{{ $errors->first('month') }}</strong>
                                     </span>
                                 @endif
                             </div>
                         </div>
                         <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                             <label for="year" class="col-md-3 control-label">year</label>
                             <div class="col-md-9">
                               <select id="year" name="year" class="form-control">
                                 <option value="0" <?php if($year == 0){echo'selected';} ?>>Year</option>
                                <option value="2018" <?php if($year == 2018){echo'selected';} ?>>2018</option>
                                <option value="2019" <?php if($year == 2019){echo'selected';} ?>>2019</option>
                                <option value="2020" <?php if($year == 2020){echo'selected';} ?>>2020</option>
                                <option value="2021" <?php if($year == 2021){echo'selected';} ?>>2021</option>
                               </select>
                                 @if ($errors->has('year'))
                                     <span class="help-block">
                                         <strong>{{ $errors->first('year') }}</strong>
                                     </span>
                                 @endif
                             </div>
                         </div>
                         <div class="form-group{{ $errors->has('postcode') ? ' has-error' : '' }}">
                             <label for="postcode" class="col-md-3 control-label">Postcode</label>
                             <div class="col-md-9">
                                 <input id="postcode" class="form-control" type="text" name="postcode" value="{{$pos}}">
                                 @if ($errors->has('postcode'))
                                     <span class="help-block">
                                         <strong>{{ $errors->first('postcode') }}</strong>
                                     </span>
                                 @endif
                             </div>
                         </div>
                         <div class="form-group{{ $errors->has('range') ? ' has-error' : '' }}">
                             <label for="range" class="col-md-3 control-label">Range</label>
                             <div class="col-md-9">
                               <select name="range" class="form-control">
                                <option value="5" <?php if($range == 5){echo'selected';} ?>>5</option>
                                <option value="10" <?php if($range == 10){echo'selected';} ?>>10</option>
                                <option value="15" <?php if($range == 15){echo'selected';} ?>>15</option>
                                <option value="20" <?php if($range == 20){echo'selected';} ?>>20</option>
                                <option value="30" <?php if($range == 30){echo'selected';} ?>>30</option>
                                <option value="50" <?php if($range == 50){echo'selected';} ?>>50</option>
                                <option value="1000" <?php if($range == 1000){echo'selected';} ?>>National</option>
                               </select>
                                 @if ($errors->has('range'))
                                     <span class="help-block">
                                         <strong>{{ $errors->first('range') }}</strong>
                                     </span>
                                 @endif
                             </div>
                         </div>
                         <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                             <label for="subject" class="col-md-3 control-label">Subject</label>
                             <div class="col-md-9">
                                 <input id="subject" type="text" class="form-control" name="subject" value="{{$sub}}">
                                 @if ($errors->has('subject'))
                                     <span class="help-block">
                                         <strong>{{ $errors->first('subject') }}</strong>
                                     </span>
                                 @endif
                             </div>
                         </div>

                           <div class="form-group">
                               <div class="col-md-6 col-md-offset-4">
                                   <button type="submit" class="btn btn-primary">
                                       Search
                                   </button>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
 </div>
 <div class="col-sm-9">
     @if(!empty($events[0]->id))
     @foreach ($events as $event)
     <a href="/event/{{$event->id}}/view">
      <div class="col-sm-4">
        <div class="panel panel-default">
           <div class="panel-heading">
             <center>
               <h3>{{$event->name}}</h3><br /><h4>{{$event->date}}</h4><br />Time: {{$event->start_time}} - {{$event->finish_time}}
               <p>
                 @if(!empty($event->distance))
                   {{$event->distance}} Miles away
                 @endif
               </p>
             </center>
           </div>
           <div class="panel-body">
             {{$event->description}}
             <center>
               <br />
               <button type="button" class="btn btn-success">Book</button>
             </center>
           </div>
         </div>
      </div>
     </a>
    @endforeach
    @else
    <p>
      currently there are no events for this mounth.
    </p>
   @endif
 </div>

</div>
@endsection
