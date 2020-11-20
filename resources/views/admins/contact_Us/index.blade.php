@extends('layouts.new-layouts.app')

@section('content')

<h2>Complains and Enquires</h2>

<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Complain and Enquires List</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Messge</th>
                          <th>date</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($contact_us as $contact_us)
                        <tr>
                      
                          <td>{{$contact_us->first_name . ' ' . $contact_us->last_name}}</td>
                          <td>{{$contact_us->email}}</td>
                          <td>{{$contact_us->phone}}</td>
                          <td>{{$contact_us->message}}</td>
                          <td data-toggle="tooltip" data-placement="top" title="{{date('d-m-Y', strtotime($contact_us->created_at))}}">{{$contact_us->created_at->diffForHumans()}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
              </div>

@endsection