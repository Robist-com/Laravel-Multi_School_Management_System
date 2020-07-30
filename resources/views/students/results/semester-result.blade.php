<div class="tab-content">
    <div class="tab-pane fade active in" id="activity">
        <div class="tabbable">
          @include('students.results.semester-tabs.tabs-header')
            <div class="tab-content">
                {{-- semester 1 tab --}}
                @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '1') 
              <div id="menu0" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 1</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester1')
              </div>
              @endif
              @endforeach
              
                {{-- semester 2 tab --}}
                @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '2') 
               <div id="menu1" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 2</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester2')
              </div>
              @endif
              @endforeach

               {{-- semester 3 tab --}}
               @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '3') 
               <div id="menu2" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 3</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester3')
              </div>
              @endif
              @endforeach

                {{-- semester 4 tab --}}
                @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '4') 
               <div id="menu3" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 4</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester4')
              </div>
              @endif
              @endforeach

                  {{-- semester 5 tab --}}
                  @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '5') 
               <div id="menu4" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 5</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester5')
              </div>
              @endif
              @endforeach

                {{-- semester 6 tab --}}
                @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '6') 
               <div id="menu5" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 6</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester6')
              </div>
              @endif
              @endforeach

                  {{-- semester 7 tab --}}
                  @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '7') 
               <div id="menu6" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 7</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester7')
              </div>
              @endif
              @endforeach

                {{-- semester 8 tab --}}
                @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '8') 
               <div id="menu7" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 8</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester8')
              </div>
              @endif
              @endforeach
                {{-- semester 9 tab --}}
                @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '9') 
               <div id="menu8" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 9</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester8')
              </div>
              @endif
              @endforeach

                {{-- semester 10 tab --}}
                @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '10') 
               <div id="menu9" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 10</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester10')
              </div>
              @endif
              @endforeach

                {{-- semester 11 tab --}}
               @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '11') 
               <div id="menu10" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 11</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester11')
              </div>
              @endif
              @endforeach

                {{-- semester 12 tab --}}
               @foreach($class_grade as $grade) 
                  @if($grade->semester_id == '12') 
               <div id="menu11" class="active tab-pane in fade">
                <h3 style="font-weight:bold; color:red">GRADE 12</h3>
                <hr class="line">
                @include('students.results.semester-tabs.semester12')
              </div>
              @endif
              @endforeach
            </div>
        </div>
    </div>
</div>
