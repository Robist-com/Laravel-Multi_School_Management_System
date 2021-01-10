<?php

namespace App\Http\Controllers;

use App\FrontCms;
use Illuminate\Http\Request;
use Flash;
class FrontCmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $front_cms = FrontCms::where('school_id',auth()->user()->school_id)->first();

        return view('school.front_cms_settings.index')->with('front_cms', $front_cms);
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
        // if ($request->ajax()) {
            // dd($request->all());
            $front_cms_save = FrontCms::updateOrCreate(['head_background_color' => $request->header_bg_color, 
            'footer_background_color'=> $request->footer_bg_color,'head_fore_color' => $request->header_fg_color,
            'footer_fore_color' => $request->footer_fg_color,
            'facebook_link' => $request->facebook_link,'instagram_link' => $request->instagram_link,'twiter_link' => $request->twitter_link,'linkedin_link' => $request->linkedin_link,
            'youtube_link' => $request->youtube_link,'whatsapp_link' => $request->whatsapp_link,'icon' => $request->social_icon
            ,'theme_name' => $request->theme_name,'theme_status' => $request->theme_status, 'school_id'=> auth()->user()->school_id]);
            
            Flash::success('Front Cms Settings save successfully.');
            return back();

        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FrontCms  $frontCms
     * @return \Illuminate\Http\Response
     */
    public function show(FrontCms $frontCms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FrontCms  $frontCms
     * @return \Illuminate\Http\Response
     */
    public function edit(FrontCms $frontCms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FrontCms  $frontCms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $front_cms_id = FrontCms::find($id);
        // dd($request->all());
        $front_cms_save = FrontCms::where('school_id', auth()->user()->school_id)
            ->update([
            'head_background_color' => $request->header_bg_color, 
            'footer_background_color'=> $request->footer_bg_color,'head_fore_color' => $request->header_fg_color,
            'footer_fore_color' => $request->footer_fg_color,
            'facebook_link' => $request->facebook_link,'instagram_link' => $request->instagram_link,
            'twitter_link' => $request->twitter_link,'linkedin_link' => $request->linkedin_link,
            'youtube_link' => $request->youtube_link,'whatsapp_link' => $request->whatsapp_link,
            'icon' => $request->social_icon,
            'theme_name' => $request->theme_name,
            'theme_status' => $request->theme_status]);
            
            // dd($front_cms_save);

            Flash::success('Front Cms Settings save successfully.');
            return redirect(route('front_cms.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FrontCms  $frontCms
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrontCms $frontCms)
    {
        //
    }
}
