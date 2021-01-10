<?php

namespace App\Http\Controllers;

use App\Event;
use Calendar;
use Illuminate\Http\Request;
use Redirect,Response;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $events = Event::all();
    //     $event = [];
    
    //     foreach ($events as $row){
    // //            $enddate = $row->end_date."24:00:00";
    //         $event[] = \Calendar::event(
    //             $row->title,
    //             false,
    //             new \DateTime($row->start_date),
    //             new \DateTime($row->end_date),
    //             $row->id,
    //             [
    //                 'color'=>$row->color,
    //             ]
    //         );
    //     }
    //     $calendar =  \Calendar::addEvents($event);
    // //        return view('eventpage',compact('events','calendar'));
    //     return view('admins.calendar.event',compact('events','calendar'))->with('events', $events)->with('calendar', $calendar);
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     return view('admins.calendar.addevent');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'vanue' => 'required',
    //         'start_date' => 'required',
    //         'end_date' => 'required'
    //     ]);
    //     $events = new Event();
    //     $events -> title = $request -> title;
    //     $events -> vanue = $request -> vanue;
    //     $events -> color = $request -> color;
    //     $events -> start_date = $request -> start_date;
    //     $events -> end_date = $request -> end_date;
    //     $events -> description = $request -> description;
    //     $events -> save();
    //     Toastr::success('Event successfully added!','Success');
    //     return redirect('Event');
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Event  $event
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Event $event)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Event  $event
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Event $event)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Event  $event
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Event $event)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Event  $event
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Event $event)
    // {
    //     //
    // }


    public function index()
    {
        if(request()->ajax()) 
        {
 
         $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
         $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
 
         $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->get(['id','title','start', 'end']);
        //  dd($data);
         return Response::json($data);
        }
        return view('admins.calendar.event');
    }
    
   
    public function create(Request $request)
    {  
        $insertArr = [ 'title' => $request->title,
                       'start' => $request->start,
                       'end' => $request->end,
                       'vanue' => $request->vanue,
                       'description' => $request->description,
                       'school_id' => auth()->user()->school_id,
                    ];
        $event = Event::insert($insertArr); 

        return Response::json($event);
    }
     
 
    public function update(Request $request)
    {   
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
        $event  = Event::where($where)->update($updateArr);
 
        return Response::json($event);
    } 
 
 
    public function destroy(Request $request)
    {
        $event = Event::where('id',$request->id)->delete();
   
        return Response::json($event);
    } 



}


