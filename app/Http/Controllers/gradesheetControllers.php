<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class gradesheetControllers extends Controller
{
    public  function  getgenerate()
	{
		$classes = Classes::pluck('class_name','class_code');
			//return View::Make('result.resultgenerate',compact('classes'));
		  if(Storage::disk('local')->exists('/public/grad_system.txt')){
			          $contant = Storage::get('/public/grad_system.txt');
			          $data = explode('<br>',$contant );

						//echo "<pre>";print_r($data);
						$gradsystem = $data[0];
					}else{
				      $gradsystem ='';
					}

		 $formdata = new formfoo5;
		$formdata->class="";
		$formdata->section="";
		$formdata->shift="";
		$formdata->exam="";
		$formdata->session="";
		$formdata->type="";
		return View('result.resultgenerate',compact('classes','gradsystem','formdata'));
	}
}
