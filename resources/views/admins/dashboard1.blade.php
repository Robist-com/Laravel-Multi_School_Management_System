@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"><i class="fa fa-dashboard" aria-hidden="true"> Dashboard</i></h1>
        <h1 class="pull-right">
           <div class="pull-right" style="margin-top: -10px;margin-bottom: 5px" >
            @include('flash::message')
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>

    
@endsection