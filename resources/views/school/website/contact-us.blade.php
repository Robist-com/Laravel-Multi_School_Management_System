@extends('layouts.websiteLayout.app')

@section('content')

    
    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('images/bg_1.jpg')">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-7">
              <h2 class="mb-0">Contact</h2>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
            </div>
          </div>
        </div>
      </div> 
    

    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="{{url('school/website')}}">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current">Contact</span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
        @include('flash::message')
        <form action="{{route('contact_us.send')}}" method="post">
        @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" name="fname" class="form-control form-control-lg">
                    @if(auth()->user())
                    <input type="hidden" id="school_id" name="school_id" value="{{auth()->user()->school_id}}" class="form-control form-control-lg">
                    @else
                    @foreach($contact_us as $contact)
                    <input type="hidden" id="school_id" name="school_id" value="{{$contact->school_id}}" class="form-control form-control-lg">
                    @endforeach
                    @endif
                </div>
                <div class="col-md-6 form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="lname" class="form-control form-control-lg">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="eaddress">Email Address</label>
                    <input type="text" id="eaddress" name="email" class="form-control form-control-lg">
                </div>
                <div class="col-md-6 form-group">
                    <label for="tel">Tel. Number</label>
                    <input type="text" id="tel" name="phone" class="form-control form-control-lg">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="eaddress">Complain</label>
                    <input type="radio" id="complain" name="enquires" class="form-control1 ">
                </div>
                <div class="col-md-6 form-group">
                    <label for="tel">Enquires</label>
                    <input type="radio" id="enquires" name="enquires" class="form-control1 ">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Send Message" class="btn btn-bg btn-lg px-5">
                </div>
            </div>
        </div>
        </form>
    </div>

    @endsection