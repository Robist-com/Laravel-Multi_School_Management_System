@extends('layouts.websiteLayout.app')

@section('content')

@foreach($event_detail as $event)
    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">{{$event->name}}</h2>
              <p>  {{$event->start_date}} - {{$event->end_date}}</p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
                @if(Auth()->user())
                  <a href="{{url('school/website')}}" class="nav-link text-left">Home</a>
                @else
                  <a href="{{url('school/site/' .$institute->web)}}" class="nav-link text-left">Home</a>
                @endif
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">News</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 mb-4">
                    <p class="mb-5">
                        <img src="{{ asset('school_images/event/' .$event->image)}}" alt="Image" class="img-fluid">
                    </p>
                    <p>{{$event->body}}</p>
                    
                </div>
                
            </div>
        </div>
    </div>
@endforeach
@endsection