@include('table_style')
<style>

input:read-only{
    border:none;
    border-color: transparent;
}
</style>


<div class="table-responsive">
<div class="panel">
    <div class="panel-body">
    <div  id="wait"></div>
    </div>
</div>

{{-- HERE IS THE USER ONLINE TABLE OKNAY WHICH CAN BE BLADE AS WELL --}}
    <table class="table table-striped table-bordered table-hover" id="batches-table">
        <thead>
            <tr>
                <th>SN <sup>o</sup></th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Student</th>
                <th style="text-align:center">Login Time</th>
                <th colspan="3">Ip Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Roll::join('admissions','admissions.id', '=', 'rolls.student_id')->get() as $key=> $student )
            
               

                 <tr>
                <td>{{$key+1}}</td>
                @if($student->isonline == 1) 
                <td><a href="#"><i class="fa fa-circle text-success"></i> Online</a></td>
                @else

                <td><a href="#"><i class="fa fa-circle text-danger"></i> Offline</a></td>
                 @endif

                <td title="{{$student->username}}">{{$student->first_name}} {{$student->last_name}}</td>
                <td>{{$student->ip_address}} </td>

                <td style="text-align:center">{!! date('H:i:s', strtotime($student->created_at)) !!}</td>


                {{-- ALL IS THE SAME WITH THE STUDENT ONLINE BLADE JUST WE CHANGE THE FUNCTIONS OKAY. --}}

                {{-- NOW LET'S MOVE TO THE STUENT CONTROLLER OKAY --}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
