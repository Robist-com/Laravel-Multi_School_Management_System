<?php

namespace App\Http\Controllers;
use Flash;
use Illuminate\Http\Request;
use App\SendVerificationCode;
class SendVerificationCodeController extends Controller
{


    public function getVerify()
    {
        return view('verify');
    }

    public function Verify(Request $request)
    {
      
        return view('verificationcodes');
    }

    public function VerifyCode(Request $request)
    {
        $teacher = new SendVerificationCode; // Teacher is the modal of the Teacher where we have all the fillbale attributes.
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        $teacher->password = $request->password;
        $teacher->activate = $request->activate;
        
        if( $teacher){
            $teacher->code=SendVerificationCode::sendVerificationCode($teacher->phone);
            $teacher->save();
        }
        
        return view('verify');
    }

   public function sendVerifyCode(Request $request)
   {

        if($user=SendVerificationCode::where('code',$request->code)->first()){
           $user->activate=1;
           $user->code=null;
           $user->save();

           Flash::success('Welcome ' .$request->name. ' Your account is Active!');
           return  redirect('/student');
        }else{
            Flash::error('Sorry ' .$request->name. ' Verify your account please.!');
            return  redirect()->back();
        }

    
   }

}
