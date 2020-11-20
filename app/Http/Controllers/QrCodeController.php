<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Generator;
use App\Models\Admission;


class QrCodeController extends Controller
{
    public function generateQrcode()
    {
        $users = auth()->user()->school_id;

        $student = Admission::where('school_id', $users)->select('id','status')->get();

        $qrcode = new Generator;
       $data = $qrcode->size(200)->generate($student);
        return view('admins.qrCodes.generate')->with('data' ,$data);
    }

}
