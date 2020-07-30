@include('pdf_header')

    <table class="table" id="teachers-table">
            <caption style="margin-top:20px;" >All teachers PDF</caption>
        <thead>
            <tr>
        <th>Full Name</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Date of Birth</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Country</th>
        <th>Passport</th>
        <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($teachers as $teacher)
            <tr>
                <td class="col-md-5 pull">{!! $teacher->first_name !!} {!! $teacher->last_name !!}</td>
            <td class="col-md-1 pull"> @if($teacher->gender == 0)
                    Male
                    @else
                    Female
                 @endif</td>
            <td class="col-md-3 pull">{!! $teacher->email !!}</td>
            <td class="col-md-3 pull">{!! date('Y-m', strtotime($teacher->dob)) !!}</td>
             <td  class="col-md-3 pull">{!! $teacher->phone !!}</td> 
            <td  class="col-md-3 pull">{!! $teacher->address !!}</td>
            <td  class="col-md-3 pull">{!! $teacher->nationality !!}</td>
            <td  class="col-md-3 pull">{!! $teacher->passport !!}</td> 
            <td class="col-md-3 pull"> @if($teacher->status == 0)
                    Single
                    @else
                    Married
                 @endif
                </td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




