<form class="form-horizontal">
    <div class="form-group">
      <label for="inputName" class="col-sm-3 control-label">Full Name</label>

      <div class="col-sm-6">
        <input type="email" class="form-control" id="inputName"
      value="{{$students->first_name}} {{$students->last_name}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-sm-3 control-label">Email</label>

      <div class="col-sm-6">
        <input type="email" class="form-control" id="inputEmail"
        value="{{$students->email}}" readonly>
      </div>
    </div>

    <div class="form-group">
      <label for="inputName" class="col-sm-3 control-label">Gender</label>
      <div class="col-sm-4">
          @if($students->gender == 0)
         <span> Male </span>
          @else
           <span> Female </span>
          @endif
      </div>
  </div>
      <div class="form-group">
          <label for="inputName" class="col-sm-3 control-label">Status</label>
          <div class="col-sm-4">
            <p> @if($students->status == 0)
                  Single
                  @else Marriged
                @endif
              </p>
          </div>
      </div>
    <div class="form-group">
          <label for="inputName" class="col-sm-3 control-label">Date of Birth</label>

          <div class="col-sm-6">
            <input type="text" class="form-control" id="inputName"
            value="{{$students->dob}}" readonly>
          </div>
        </div>
        <div class="form-group">
              <label for="inputName" class="col-sm-3 control-label">Phone No.</label>

              <div class="col-sm-6">
                <input type="text" class="form-control" id="inputName"
                value="+{{$students->phone}}" readonly>
              </div>
            </div>
            <div class="form-group">
                  <label for="inputName" class="col-sm-3 control-label">Passport No.</label>

                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputName"
                    value="{{$students->passport}}" readonly>
                  </div>
                </div>
    <div class="form-group">
      <label for="inputExperience" class="col-sm-3 control-label" >Address</label>

      <div class="col-sm-9">
        <input class="form-control" id="inputExperience" value="{{$students->address}}" readonly>
      </div>
    </div>
    <div class="form-group">
      <label for="inputSkills" class="col-sm-3 control-label">Nationality</label>

      <div class="col-sm-6">
        <input type="text" class="form-control" id="inputSkills"
        value="{{$students->nationality}}" readonly>
      </div>
    </div>
    <div class="form-group">
          <label for="inputSkills" class="col-sm-3 control-label">Register Date</label>

          <div class="col-sm-6">
            <input type="text" class="form-control" id="inputSkills"
             value="{{date("Y-m-d", strtotime ($students->dateregistered))}}" readonly>
          </div>
        </div>
  </form>
