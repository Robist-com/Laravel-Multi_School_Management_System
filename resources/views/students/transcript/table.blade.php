
            <style>
                .names{
                color: red;
                font-family: 'Times New Roman', Times, serif;
                font-display: bold;
                font-size: large;
                }
                table{
                    border: 0px solid;
                    width:100%;
                    border-collapse:separate; 
                     border-spacing:0 15px; 
                }
                .vl {
            border-left: 6px solid green;
            height: 500px;
            position: absolute;
            left: 50%;
            margin-left: -3px;
            top: 0;
            }
            h6{
            display: inline-block
            }
            h5{
            display: inline-block
            }

.bordered-table {
    border:1px solid black;
    border-collapse: collapse;
}
.bordered-tr {
  border-left: 1px solid #000;
  border-right: 1px solid #000;
}

.bordered-td {
    border-left: 1px solid black;
    border-right: 1px solid black;
    border-bottom: 1px solid black;
}

.bordered-th {
    border-left: 1px solid #000;
    border-right: 1px solid #000;
    border-bottom: 1px solid black;

    text-align: center;
}

.col-form-label{
    font-size:12px;font-family:'Times New Roman', Times, serif;
}

.panel-heading {
  border: 1px solid   !important;
  background: #fff !important;
  text-transform:uppercase;
  text-align:center; 
  font-size:14px;
  font-family:'Times New Roman', Times, serif; 
  font-weight:bold;
}

.panel{
    border: 1px solid   !important;
}

.trans{
    text-align: center; 
    font-size:11px; 
    font-weight:bolder; 
    text-transform:uppercase; 
    font-family:'Times New Roman', Times, serif;
    border-spacing: 10%;
    border-collapse: separate;
}

.btn-print {
    color: #ffffff;
    background-color: #49b3e2;
    border-color: #aed0df;
    float: right;

    font-size: 40px;
    padding: 5px;
    margin: 10px 10px;
    border-radius: 20px;
}

.btn-print:hover,
.btn-print:focus,
.btn-print:active,
.btn-print.active,
.open .dropdown-toggle.btn-print {
  color: #ffffff;
  background-color: #0F9966;
  border-color: #19910E;
}

.btn-print:active,
.btn-print.active,
.open .dropdown-toggle.btn-print {
  background-image: none;
}

.btn-print .badge {
  color: #34BA1F;
  background-color: #ffffff;
}
@media print {
  .page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
  }
}
  
</style>
<button class="btn-print" onclick="printDiv('printableArea')">Print</button>
<div id="printableArea">
    <div class="wraperResult">
        <div class="panel">
          <div class="panel-heading">
                    Academic Transcript
          </div>
          </div>
          <div class="panel">
            <div class="panel-body">
                <div class="col-md-2">
                    <img src="{{asset('FrontEnd/img/Logo_of_UTG.gif')}}" alt=""
                    class="rounded-circle" width="85" height="85" style="border-radius:50%; vertical-alight:middle;">
                  </div>
                    <div class="col-md-5">
                      <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-3 col-form-label">Name  :</label>
                          <div class="col-sm-8">
                            <label  class="col-sm-10 col-form-label" id="inputEmail3">{{$studentinfo->first_name}} {{$studentinfo->last_name}}</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-3 col-form-label">Place of Birth  :</label>
                          <div class="col-sm-8">
                            <label  class="col-sm-10 col-form-label" id="inputEmail3">{{$studentinfo->dob}}</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-3 col-form-label">Stud Group :</label>
                          <div class="col-sm-8">
                            <label  class="col-sm-10 col-form-label" id="inputEmail3">{{$studentinfo->faculty_name}}</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-3 col-form-label">Class Group  :</label>
                          <div class="col-sm-8">
                          <label  class="col-sm-10 col-form-label" id="inputEmail3">{{$studentinfo->department_name}}</label>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-4 col-form-label">Graduation Date :</label>
                          <div class="col-sm-8">
                            <label  class="col-sm-10 col-form-label" id="inputEmail3"></label>
                          </div>
                        </div>
                        </p>
                    </div>
                <div class="col-md-5">
              <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Roll N<sup>o</sup>  :</label>
                  <div class="col-sm-8">
                    <label  class="col-sm-10 col-form-label" id="inputEmail3">{{$studentinfo->roll_no}} </label>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Level  :</label>
                  <div class="col-sm-8">
                    <label  class="col-sm-10 col-form-label" id="inputEmail3">{{$studentinfo->level}}</label>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Credit  :</label>
                  <div class="col-sm-8">
                    <label  class="col-sm-10 col-form-label" id="inputEmail3">200</label>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Grade Point  :</label>
                  <div class="col-sm-8">
                  <label  class="col-sm-10 col-form-label" id="inputEmail3">{{$studentinfo->point}}</label>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Achievement  :</label>
                  <div class="col-sm-8">
                    <label  class="col-sm-10 col-form-label" id="inputEmail3"></label>
                  </div>
                </div>
            </div>
          </div>
 
          {{-- <div class="col-sm-6"> --}}
            <table class="bordered-table " style="width:50%; float:left">
                <thead>
                    <tr class="bordered-tr">
                      {{-- <th class="bordered-th">DAYS <br> <sup>TIME</sup></th> --}}
                      <th class="bordered-th">CODE</th>
                      <th class="bordered-th ">SUBJECT</th>
                      {{-- <th class="bordered-th">CLASS</th> --}}
                      <th class="bordered-th">CREDIT</th>
                      <th class="bordered-th ">GRADE</th>
                      {{-- <th class="bordered-th">GRADE</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studenttranscript as $transcript)
                    @if ($transcript->semester_id == 1)

                    <tr>
                        <td style="text-align: center; font-weight:bold">Grade 1</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    <tr class="bordered-tr">
                       <td class="trans " >{{$transcript->course_code}}</td>
                       <td class="trans ">{{$transcript->course_name}}</a></td>
                       <td class="trans " >4</td>
                       <td class="trans " >{{ $transcript->grade}}</td>
                      </tr>
                      <tr>
                        <td style="text-align: center; font-weight:bold">&nbsp;</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    @endif

                    @if ($transcript->semester_id == 2)

                    <tr>
                        <td style="text-align: center; font-weight:bold">Grade 2</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    <tr class="bordered-tr">
                       <td class="trans " >{{$transcript->course_code}}</td>
                       <td class="trans ">{{$transcript->course_name}}</a></td>
                       <td class="trans " >4</td>
                       <td class="trans " >{{ $transcript->grade}}</td>
                      </tr>
                      <tr>
                        <td style="text-align: center; font-weight:bold">&nbsp;</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    @endif
                    @if ($transcript->semester_id == 3)

                    <tr>
                        <td style="text-align: center; font-weight:bold">Grade 3</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    <tr class="bordered-tr">
                       <td class="trans " >{{$transcript->course_code}}</td>
                       <td class="trans ">{{$transcript->course_name}}</a></td>
                       <td class="trans " >4</td>
                       <td class="trans " >{{ $transcript->grade}}</td>
                      </tr>
                      <tr>
                        <td style="text-align: center; font-weight:bold">&nbsp;</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    @endif
                    @if ($transcript->semester_id == 4)

                    <tr>
                        <td style="text-align: center; font-weight:bold">Grade 4</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    <tr class="bordered-tr">
                       <td class="trans " >{{$transcript->course_code}}</td>
                       <td class="trans ">{{$transcript->course_name}}</a></td>
                       <td class="trans " >4</td>
                       <td class="trans " >{{ $transcript->grade}}</td>
                      </tr>
                      <tr>
                        <td style="text-align: center; font-weight:bold">&nbsp;</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    @endif
                    @if ($transcript->semester_id == 5)

                    <tr>
                        <td style="text-align: center; font-weight:bold">Grade 5</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    <tr class="bordered-tr">
                       <td class="trans " >{{$transcript->course_code}}</td>
                       <td class="trans ">{{$transcript->course_name}}</a></td>
                       <td class="trans " >4</td>
                       <td class="trans " >{{ $transcript->grade}}</td>
                      </tr>
                      <tr>
                        <td style="text-align: center; font-weight:bold">&nbsp;</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    @endif
                      @endforeach
                </tbody>
            </table>
        {{-- SECOND TABLE --}}
            <table class="bordered-table" style="width:50%; float:left">
                <thead>
                    <tr class="bordered-tr">
                      {{-- <th class="bordered-th">DAYS <br> <sup>TIME</sup></th> --}}
                      <th class="bordered-th">CODE</th>
                      <th class="bordered-th ">SUBJECT</th>
                      {{-- <th class="bordered-th">CLASS</th> --}}
                      <th class="bordered-th">CREDIT</th>
                      <th class="bordered-th ">GRADE</th>
                      {{-- <th class="bordered-th">GRADE</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($studenttranscript as $transcript)
                    @if ($transcript->semester_id == 6)

                    <tr>
                        <td style="text-align: center; font-weight:bold">Grade 6</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    <tr class="bordered-tr">
                       <td class="trans " >{{$transcript->course_code}}</td>
                       <td class="trans ">{{$transcript->course_name}}</a></td>
                       <td class="trans " >4</td>
                       <td class="trans " >{{ $transcript->grade}}</td>
                      </tr>
                      <tr>
                        <td style="text-align: center; font-weight:bold">&nbsp;</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    @endif

                    @if ($transcript->semester_id == 7)

                    <tr>
                        <td style="text-align: center; font-weight:bold">Grade 7</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    <tr class="bordered-tr">
                       <td class="trans " >{{$transcript->course_code}}</td>
                       <td class="trans ">{{$transcript->course_name}}</a></td>
                       <td class="trans " >4</td>
                       <td class="trans " >{{ $transcript->grade}}</td>
                      </tr>
                      <tr>
                        <td style="text-align: center; font-weight:bold">&nbsp;</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    @endif
                    @if ($transcript->semester_id == 8)

                    <tr>
                        <td style="text-align: center; font-weight:bold">Grade 8</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    <tr class="bordered-tr">
                       <td class="trans " >{{$transcript->course_code}}</td>
                       <td class="trans ">{{$transcript->course_name}}</a></td>
                       <td class="trans " >4</td>
                       <td class="trans " >{{ $transcript->grade}}</td>
                      </tr>
                      <tr>
                        <td style="text-align: center; font-weight:bold">&nbsp;</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    @endif
                    @if ($transcript->semester_id == 9)

                    <tr>
                        <td style="text-align: center; font-weight:bold">Semester 9</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    <tr class="bordered-tr">
                       <td class="trans " >{{$transcript->course_code}}</td>
                       <td class="trans ">{{$transcript->course_name}}</a></td>
                       <td class="trans " >4</td>
                       <td class="trans " >{{ $transcript->grade}}</td>
                      </tr>
                      <tr>
                        <td style="text-align: center; font-weight:bold">&nbsp;</td>
                        <td></td><td></td> <td></td>
                    </tr>
                    @endif
                     @endforeach
                </tbody>
            </table>
          </div>
</div>
</div>
{{-- <img src="{{asset('/markssheetcontent/certificate-bg.png')}}" alt="" class="result-bg">  --}}
</div><!-- end of wraperResult -->
    <br>
    {{-- <table class="bordered-table">
         <tbody>
           <tr>
             <td class="bordered-td"style="text-align: center;">
              <br>
              Approved,
              Major Head / Secretary

              <br><br><br><br>
                <sup>
                  name:
                </sup>
            </td>
             <td class="bordered-td"style="text-align: center;">
              <br>
              <div id="result"></div>

              <br><br><br><br>
                <sup>
                  name:
                </sup>
            </td>

           </tr>
         </tbody>
       </table> --}}
    {{-- </body>
    </html>
         --}}
@section('scripts')
    
         <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        
           </script>
@endsection
