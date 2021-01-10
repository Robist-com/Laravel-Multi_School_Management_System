<?php

namespace App\Http\Controllers;

use App\Inbox;
use App\NoticeBoard;
use Illuminate\Http\Request;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
  public function construct()
  {
    $this->middleware('auth');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inbox =Inbox::join('users', 'users.id', '=', 'inboxes.user_id' )
        ->join('teachers', 'teachers.teacher_id','=', 'users.teacher_id')
        ->select('inboxes.*', 'users.name')
        ->get();

        


        $classstudents = NoticeBoard::all();
        // ClassSchedule::join('admissions', 'admissions.class_code', '=', 'class_schedule.class_id')
        //                                 ->where('class_schedule.teacher_id',Auth::user()->teacher_id)->get();
        // dd( $classstudents); die;
        return view('noticeboard.notice', compact('inbox','classstudents'))->with('inbox', $inbox);
    }

    public function UpdateInbox(Request $request){

    //    return $request->all();
        $mId = $request->msgId;

        $update = Inbox::where('id',$mId)->update([
          'status' => 0,'flag' => 'Read'
        ]);
        if($update){
            return response()->json(['message' => 'Message  Read Successfully.']);
        }

        // $teachers = Inbox::findOrFail($request->msgId);
        // $teachers->status = $request->status;

        // $teachers->save();

        // return response()->json(['message' => 'Message  Read Successfully.']);
    }


    public  function sendMessage(Request $request)
    {
        $type = $request->get('type');
        $body = $request->get('body');
        $status = $request->get('status');
        $start = $request->get('start_date');
        $end = $request->get('end_date'); 
        
        NoticeBoard::create([
            'type' => $type,
            'body' => $body,
            'status' => $status,
            'start_date' => $start,
            'end_date' => $end
        ]);

        return redirect()->back();


    }

    public  function sendMessage1(Request $request){
        $conID = $request->conID;
        $msg = $request->msg;
  
        $checkUserId = DB::table('messages')->where('conversation_id', $conID)->get();
        if($checkUserId[0]->user_from== Auth::user()->id){
          // fetch user_to
          $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
          ->get();
            $userTo = $fetch_userTo[0]->user_to;
        }else{
        // fetch user_to
        $fetch_userTo = DB::table('messages')->where('conversation_id', $conID)
        ->get();
          $userTo = $fetch_userTo[0]->user_to;
        }
  
          // now send message
          $sendM = DB::table('messages')->insert([
            'user_to' => $userTo,
            'user_from' => Auth::user()->id,
            'message' => $msg,
            'status' => 1,
            'conversation_id' => $conID
          ]);
          if($sendM){
            $userMsg = DB::table('messages')
            ->join('users', 'users.id','messages.user_from')
            ->where('messages.conversation_id', $conID)->get();
            return $userMsg;
          }
      }

    public function newMessage(){
        $uid = Auth::user()->id;
  
        $friends1 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.user_requested') // who is not loggedin but send request to
                ->where('status', 1)
                ->where('requester', $uid) // who is loggedin
                ->get();
  
        $friends2 = DB::table('friendships')
                ->leftJoin('users', 'users.id', 'friendships.requester')
                ->where('status', 1)
                ->where('user_requested', $uid)
                ->get();
  
        $friends = array_merge($friends1->toArray(), $friends2->toArray());
        return view('newMessage', compact('friends', $friends));
      }

      



    public function sendNewMessage(Request $request){
        $msg = $request->msg;
        $friend_id = $request->friend_id;
        $myID = Auth::user()->id;

        //check if conversation already started or not
        $checkCon1 = DB::table('conversation')->where('user_one',$myID)
        ->where('user_two',$friend_id)->get(); // if loggedin user started conversation

        $checkCon2 = DB::table('conversation')->where('user_two',$myID)
        ->where('user_one',$friend_id)->get(); // if loggedin recviced message first

        $allCons = array_merge($checkCon1->toArray(),$checkCon2->toArray());

        if(count($allCons)!=0){
          // old conversation
          $conID_old = $allCons[0]->id;
          //insert data into messages table
          $MsgSent = DB::table('messages')->insert([
            'user_from' => $myID,
            'user_to' => $friend_id,
            'message' => $msg,
            'conversation_id' =>  $conID_old,
            'status' => 1
          ]);
        }else {
          // new conversation
          $conID_new = DB::table('conversation')->insertGetId([
            'user_one' => $myID,
            'user_two' => $friend_id
          ]);
          echo $conID_new;

          $MsgSent = DB::table('messages')->insert([
            'user_from' => $myID,
            'user_to' => $friend_id,
            'message' => $msg,
            'conversation_id' =>  $conID_new,
            'status' => 1
          ]);

        }
    }










    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function show(Request $rc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $rc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $rc)
    {
        //
    }
}
