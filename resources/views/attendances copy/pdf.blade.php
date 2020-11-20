<style>
.pull{
    text-align:center;
    border: 1px solid;
}

th{
    text-align:center;
}
table{
   align-content: center
}
</style>

<!-- large table okay -->
<div class="table-responsive-lg"> 
<h1 style="float:right; color:blue;margin-top:20px;"><i>Academic Information System</i> </h1>
<h5><i>Name:</i> UTG University of The Gambia</h5>
<h5><i >Location:</i> Latrikunda Sabiji</h5><br>
<h6><i>Email:</i>latrikundasabiji@gmail.gm</h6>
<h6><i>Phone: (+220)</i> 3939919 / 4396236</h6>

{{-- Table Class Assign Start Here --}}
<table class="table" id="classAssignings-table">
        <caption style="margin-top:20px;" >Class Assigned PDF</caption>
    <thead>
        <tr>
            <th>Teacher</th>
            <th>Semester</th>
            <th>Course</th>
            <th>Deatils</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($classAssignings as $classAssigning)
            <tr class="border">
                <td class="col-md-3 pull">{!! $classAssigning->first_name !!} {!! $classAssigning->last_name !!}</td>
                <td class="col-md-3 pull">{!! $classAssigning->semester_name !!}</td>
                <td class="col-md-6 pull">{!! $classAssigning->course_name !!}</td>
                <td class="col-md-6 pull">
                    <span style="color:red">Level:</span>{!! $classAssigning->level !!} | {!! $classAssigning->time !!}
                    <span style="color:red">Day:</span>{!! $classAssigning->name !!} | {!! $classAssigning->class_name !!}
                    <span style="color:red">Shift:</span>{!! $classAssigning->shift !!} | {!! $classAssigning->batch !!}
                    <span style="color:red">Class Room:</span>{!! $classAssigning->classroom_name !!} 
                </td>
            </tr>
        @endforeach

    </tbody>
    
</table>
</div>




