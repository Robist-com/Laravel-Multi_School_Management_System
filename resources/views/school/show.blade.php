@extends('layouts.new-layouts.admin_app')
@section('content')

<a href="{{ url()->previous() }}" class="btn btn-sm btn-info pull-right"> back </a>
<div class="row">
  <div class="col-md-6" style="margin-top: 5%">
    <div class="card">
        <img style="margin-left: 10%" width="250" class="card-img-top" src="{{ $school->image != '' ? asset('institute_logo/' .$school->image) : asset('institute_logo/default_logo.jpg') }}" alt="Card image cap">
        <div class="card-body">
          <h5 style="margin-left:10%; font-size:150%" >{{ $school->name }}</h5>
        </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
        <div class="card-body">
          <h5 class="card-title" style="text-transform: uppercase; font-family:Verdana, Geneva, Tahoma, sans-serif; font-size:250%; margin-top:10%">SCHOOL INFORMATION</h5>
            <div class="row" style="margin-top: 4%">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">E-mail: </label><br>
                <label for="">{{ $school->email }}</label>
              </div>
              </div>
               <div class="col-md-6">
                 <div class="form-group">
                  <label for="">Establish: </label><br>
                <label for="">{{ $school->establish }}</label>
                </div>
               </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="">Web: </label><br>
                <label for="">{{ $school->web }}</label>
              </div>
              </div>
               <div class="col-md-6">
                 <div class="form-group">
                   <label for="">Phone: </label><br>
                <label for="">{{ $school->phoneNo }}</label>
                </div>
               </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="">Address: </label><br>
                <label for="">{{ $school->address }}</label>
              </div>
              </div>
               <div class="col-md-6">
                 <div class="form-group">
                   <label for="">Status: </label><br>
                <label for="">{{ $school->is_active == 1 ? 'Is Active' : 'Is Not Active'}}</label>
                </div>
               </div>
               <div class="col-md-12">
                 <div class="form-group">
                   <label for="">Description: </label><br>
                <label for="">{{ $school->description }}</label>
                </div>
               </div>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header" style="text-align:center"> Other School Documents</div>
  <div class="card-body">

  </div>
</div>
    
@endsection