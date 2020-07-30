<div id="myDiv">
    <ul class="nav nav-pills">
        {{-- <li class="active"><a data-toggle="tab" href="#home">H</a></li> --}}
        @foreach($enable_grade as $grade) 
        @if( $grade->semester_id == '1') 
        <li class="active"><a data-toggle="tab" href="#menu0" style="font-size:12px">GRADE 1</a></li>
        @endif
        @endforeach


        @foreach($enable_grade as $grade) 
        @if( $grade->semester_id == '2') 
        <li class="active"><a data-toggle="tab" href="#menu1" style="font-size:12px">GRADE 2</a></li>
        @endif
        @endforeach


        @foreach($enable_grade as $grade) 
        @if( $grade->semester_id == '3') 
        <li><a data-toggle="tab" href="#menu2" style="font-size:12px">GRADE 3</a></li>
        @endif
        @endforeach


        @foreach($enable_grade as $grade) 
        @if($grade->semester_id == '4') 
        <li><a data-toggle="tab" href="#menu3" style="font-size:12px">GRADE 4</a></li>
        @endif
        @endforeach


        @foreach($enable_grade as $grade) 
        @if( $grade->semester_id == '5') 
        <li ><a data-toggle="tab" href="#menu4" style="font-size:12px">GRADE 5</a></li>
        @endif
        @endforeach


        @foreach($enable_grade as $grade) 
        @if($grade->semester_id == '6') 
        <li ><a data-toggle="tab" href="#menu5" style="font-size:12px">GRADE 6</a></li>
        @endif
        @endforeach

        
        @foreach($class_grade as $grade) 
        @if($grade->semester_id == '7') 
        <li class="active" ><a data-toggle="tab" href="#menu6" style="font-size:12px">GRADE 7</a></li>
        @endif
        @endforeach

        
        @foreach($enable_grade as $grade) 
        @if($grade->semester_id == '8') 
        <li ><a data-toggle="tab" href="#menu7" style="font-size:12px">GRADE 8</a></li>
        @endif
        @endforeach


        @foreach($enable_grade as $grade) 
        @if($grade->semester_id == '9') 
        <li ><a data-toggle="tab" href="#menu8" style="font-size:12px">GRADE 9</a></li>
        @endif
        @endforeach


        @foreach($enable_grade as $grade) 
        @if($grade->semester_id == '10') 
        <li ><a data-toggle="tab" href="#menu9" style="font-size:12px">GRADE 10</a></li>
        @endif
        @endforeach


        @foreach($enable_grade as $grade) 
        @if($grade->semester_id == '11') 
        <li ><a data-toggle="tab" href="#menu10" style="font-size:12px">GRADE 11</a></li>
        @endif
        @endforeach


        @foreach($enable_grade as $grade) 
        @if($grade->semester_id == '12') 
        <li ><a data-toggle="tab" href="#menu11" style="font-size:12px">GRADE 12</a></li>
        @endif
        @endforeach
    </ul>
</div>