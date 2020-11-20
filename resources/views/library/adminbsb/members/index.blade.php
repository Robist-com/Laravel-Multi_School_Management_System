<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>LIBRARY </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        @if(isset($add_member))
        <a href="{{route('librarymember.index')}}"><button type="submit" class="btn btn-round bg-teal"><i
                    class="fa fa-sign-out" aria-hidden="true"> Return </i></button></a>
        @elseif(isset($book_issue_return))
        <a href="{!! route('issuebook.detail', [$issue_book->roll_no]) !!}"><button type="submit"
                class="btn btn-round bg-teal"><i class="fa fa-sign-out" aria-hidden="true"> Issue Book </i></button></a>
        @elseif(isset($issue_book))
        <a href="{{route('librarymember.index')}}"><button type="submit" class="btn btn-round bg-teal"><i
                    class="fa fa-plus-circle" aria-hidden="true"> Return List </i></button></a>
        @else
        <a href="{{route('librarymember.add')}}"><button type="submit" class="btn btn-round bg-teal"><i
                    class="fa fa-plus-circle" aria-hidden="true"> Add Member </i></button></a>
        @endif
    </div>
    <br><br>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            @if(isset($member))
            <h2>Update Member</h2>
            @elseif(isset($add_member))
            <h2>Add Member</h2>
            @else
            <h2> Member List</h2>
            @endif
            <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">more_vert</i>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);">Action</a></li>
                        <li><a href="javascript:void(0);">Another action</a></li>
                        <li><a href="javascript:void(0);">Something else here</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="body">
            @if(isset($add_member))
            @if(isset($member))
            {!! Form::model($member, ['route' => ['librarymember.update', $member->id], 'method' => 'post', 'class' =>
            'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            @else
            {!! Form::open(['route' => 'librarymember.store', 'class' => 'form-horizontal form-label-left', 'enctype' =>
            'multipart/form-data']) !!}
            @csrf
            @endif

            @if(auth()->user()->group == "Admin")
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="school_id" id="school_id">
                        <option>Choose School</option>
                        @foreach (auth()->user()->school->all() as $school)
                        <option value="{{ $school->id }}"
                            @if(isset($member)){{$member->school_id == $school->id ? 'selected' : ''}} @endif>
                            {{$school->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @else
            <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
            @endif

            <div class="form-group row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Roll No<b style="color:red">*</b></label>
                    <div class="form-line">
                    <input type="text" name="roll_no" id="roll_no" class="form-control" @if(isset($member))
                        value="{{$member->roll_no}}" @endif autocomplete="off">
                </div>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Library Card No<b style="color:red">*</b></label>
                    <div class="form-line">
                    <input type="text" name="library_card" id="library_card" class="form-control" disabled
                        value="{{$library_card_number}}" @if(isset($member)) value="{{$member->library_card}}" @endif
                        autocomplete="off">
                </div>
            </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Member Type <b style="color:red">*</b></label>
                    <select name="member_type" id="member_type" class="form-control bootstrap-select">
                        <option value="student">Student</option>
                        <option value="staff"> Staff</option>
                        <option value="other"> Other</option>
                    </select>
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Join Date <b style="color:red">*</b></label>
                    <input type="text" name="join_date" id="date" class="form-control bootstrap-select" value="{{date('Y-m-d')}}"
                        @if(isset($member)) value="{{$member->join_date}}" @endif autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-12 col-xs-12">
                  <select name="status" id="status" class="form-control bootstrap-select">
                  @if(isset($member))
                    <option value="on" @if($member->status == "on") selected @endif> Active</option>
                    <option value="off" @if($member->status == "off") selected @endif> In Active</option>
                    @else
                    <option value="on"> Active</option>
                    <option value="off"> In Active</option>
                    @endif
                  </select>
                </div>
            </div>

            <div class="modal-footer">
                @if(isset($member))
                {!! Form::submit('Save Changes', ['class' => 'btn bg-teal']) !!}
                @else
                <button type="submit" class="btn btn-round bg-teal">Save</button>
                @endif
            </div>

            {!! Form::close() !!}
            @endif

            @if(isset($member_list))
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive js-exportable">
                    <thead>
                        <tr class="headings">

                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Roll Number">Roll
                                N<s>o.</s></th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top"
                                title="Member Full Name">
                                Name</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top"
                                title="Library Card Number">
                                Library Card No.</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Member Type">
                                Member
                                Type</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top"
                                title="Member Phone Number">
                                Phone</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Member Status">
                                Status
                            </th>
                            <th class="column-title no-link last" data-toggle="tooltip" data-placement="top"
                                title="Issue Book or Return Book"><span class="nobr">Issue / Return</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($member_list as $member)
                        <tr class="even pointer">
                            <td class="">{!! $member->roll_no !!}</td>
                            <td class="">{!! $member->first_name .' '. $member->last_name !!}</td>
                            <td class="">{!! $member->library_card !!}</td>
                            <td class="">{!! $member->member_type !!}</td>
                            <td class="">{!! $member->phone !!}</td>
                            <td class="">@if($member->status == 'on') <label for=""
                                    class="label bg-green">Active</label>@else <label for=""
                                    class="label label-danger">In Active</label> @endif</td>
                            <td>
                                <div class='btn-group'>
                                    <a data-level_id="{{$member->id}}" data-level="{{$member->level}}"
                                        data-level_description="{{$member->level_description}}"
                                        data-course_id="{{$member->course['course_name']}}"
                                        href="{!! route('issuebook.detail', [$member->roll_no]) !!}"
                                        class='btn bg-pink btn-xs'>
                                        <i class="fa fa-external-link-square"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
        </div>



        @if(isset($issue_book))
        @if(isset($book_issue_return))
        {!! Form::model($book_issue_return, ['route' => ['issuebook.update', $book_issue_return->id], 'method' =>
        'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
        @csrf
        @else
        {!! Form::open(['route' => 'issuebook.store', 'class' => 'form-horizontal form-label-left', 'enctype' =>
        'multipart/form-data']) !!}
        @csrf
        @endif

        @if(auth()->user()->group == "Admin")
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="school_id" id="school_id">
                    <option>Choose School</option>
                    @foreach (auth()->user()->school->all() as $school)
                    <option value="{{ $school->id }}"
                        @if(isset($member)){{$member->school_id == $school->id ? 'selected' : ''}} @endif>
                        {{$school->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @else
        <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
        @endif

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-3">
                <div class="card profile-card">
                    <div class="profile-header">&nbsp;</div>
                    <div class="profile-body">
                        <div class="image-area">
                            <img  src="{{asset('student_images/' .$issue_book->image)}}" alt="Avatar - Profile Image"
                                title="Change the avatar" width="160px">
                            <!-- <img src="../../images/user-lg.jpg" alt="AdminBSB - Profile Image" /> -->
                        </div>
                        <div class="content-area">
                            <h3>{!! $issue_book->first_name .' '. $issue_book->last_name !!}</h3>
                        </div>
                    </div>
                    <div class="profile-footer">
                        <ul>
                            <li>
                                <span>Roll Number</span>
                                <span class="label bg-green">{{$issue_book->roll_no}}</span>
                            </li>
                            <li>
                                <span>Library Card </span>
                                <span class="label bg-green">{{$issue_book->library_card}}</span>
                            </li>
                            <li>
                                <span>Gender</span>
                                <span class="label bg-green">@if($issue_book->gender = 0) Male @else Female
                                    @endif</span>
                            </li>
                            <li>
                                <span>Member Type</span>
                                <span class="label bg-green">{{$issue_book->member_type}}</span>
                            </li>
                            <li>
                                <span> Phone</span>
                                <span class="label bg-green">{{$issue_book->phone}}</span>
                            </li>
                        </ul>
                        <button class="btn btn-primary btn-lg waves-effect btn-block">FOLLOW</button>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-9">
                <div class="card">
                    <div class="body">
                        <div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                        data-toggle="tab">Home</a></li>
                                <li role="presentation"><a href="#profile_settings" aria-controls="settings" role="tab"
                                        data-toggle="tab">Profile Settings</a></li>
                                <li role="presentation"><a href="#change_password_settings" aria-controls="settings"
                                        role="tab" data-toggle="tab">Change Password</a></li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home">
                                    <div class="panel panel-default panel-post">
                                        <div class="panel-heading">
                                            @if(isset($book_issue_return))
                                            <h3>Return Book</h3>
                                            @else
                                            <h3>Issue Book</h3>
                                            @endif
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-12">

                                                <div class="col-xs-12 col-sm-12">
                                                    <div class="x_panel">

                                                        <div class="x_title">
                                                        </div>
                                                        <br>
                                                        @if(!$book_issue_return)
                                                        <div class="form-group row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label for="">Books <b style="color:red">*</b></label>
                                                                <select name="book_id" id="book_id"
                                                                    class="form-control bootstrap-select">
                                                                    <option value="0" selected>select</option>
                                                                    @foreach(App\Books::where('school_id',
                                                                    auth()->user()->school_id)->get() as $book)
                                                                    <option value="{{$book->id}}">{{$book->book_title}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label for="">Return Date <b
                                                                        style="color:red">*</b></label>
                                                                <div class="form-line">
                                                                    <input type="text" name="due_return_date" id="date"
                                                                        class="form-control" value="{{date('Y-m-d')}}"
                                                                        @if(isset($member))
                                                                        value="{{$member->join_date}}" @endif
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="form-line">
                                                                    <input type="hidden" name="student_id"
                                                                        id="student_id" class="form-control"
                                                                        value="{{$issue_book->student_id}}"
                                                                        @if(isset($member))
                                                                        value="{{$member->join_date}}" @endif
                                                                        autocomplete="off">
                                                                </div>
                                                                <div class="form-line">
                                                                    <input type="hidden" name="issue_date"
                                                                        id="issue_date" class="form-control"
                                                                        value="{{date('Y-m-d')}}" @if(isset($member))
                                                                        value="{{$member->issue_date}}" @endif
                                                                        autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <br>
                                                        @if(isset($book_issue_return))
                                                        <div class="form-group">
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                <label for="">Return Date <b
                                                                        style="color:red">*</b></label>
                                                                <div class="form-line">
                                                                    <input type="text" name="return_date" id="date"
                                                                        value="{{date('Y-m-d')}}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="pull-right">
                                                            @if(isset($book_issue_return))
                                                            {!! Form::submit('Save Changes', ['class' => 'btn bg-teal'])
                                                            !!}
                                                            @else
                                                            <button type="submit"
                                                                class="btn btn-round bg-teal">Save</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>

                                                <div class="col-xs-12 col-sm-12">
                                                    <hr>
                                                    <div class="x_panel">
                                                        <h3>Books Issued</h3>
                                                        <table id="datatable-responsive"
                                                            class="table table-striped table-bordered dt-responsive js-exportable">
                                                            <thead>
                                                                <tr class="headings">

                                                                    <th class="column-title" data-toggle="tooltip"
                                                                        data-placement="top" title="Issued Book Title">
                                                                        Book</th>
                                                                    <th class="column-title" data-toggle="tooltip"
                                                                        data-placement="top" title="Issued Book Number">
                                                                        Book no</th>
                                                                    <th class="column-title" data-toggle="tooltip"
                                                                        data-placement="top" title="Issued Date">
                                                                        Issue D</th>
                                                                    <th class="column-title" data-toggle="tooltip"
                                                                        data-placement="top"
                                                                        title="Issued Due Return Date">Due Return Date
                                                                    </th>
                                                                    <th class="column-title" data-toggle="tooltip"
                                                                        data-placement="top" title="Return Date">
                                                                        Return Date</th>

                                                                </tr>
                                                            </thead>
                                                            <?php $dateNow = date("d")+1;
               
                                                            $timenow = [];
                                                            foreach ($issue_list as $key => $value) {
                                                              $timenow = $value->due_return_date;
                                                            }
                                                            $now = date('Y-m-d');
                                                            $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $now);
                                                            $end_date = \Carbon\Carbon::createFromFormat('Y-m-d',   $timenow);
                                                            $different_days = $start_date->diffInDays($end_date);
                                                            ?>
                                                            <tbody>
                                                                @foreach($issue_list as $member)
                                                                <tr class="even pointer">
                                                                    <td class="">{!! $member->book_title!!}</td>
                                                                    <td class="">{!! $member->book_number !!}</td>
                                                                    <td class="">{!!date('d/m/Y', strtotime(
                                                                        $member->issue_date)) !!}</td>
                                                                    <td class="">@if($member->return_date == '' && $now
                                                                        >= $member->due_return_date)
                                                                        <label for="">@if($different_days == 0) please
                                                                            return the book @else you are
                                                                            Find {{$different_days}} @endif
                                                                        </label> @else {!!date('d/m/Y', strtotime(
                                                                        $member->due_return_date)) !!} @endif
                                                                    </td>
                                                                    <td class="">@if($member->return_date == '') <a
                                                                            href="{!! route('issuebook.edit', [$member->issue_book_id]) !!}">
                                                                            <i class="fa fa-reply fa-lg"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top"
                                                                                title="Return Book"></i>
                                                                            @elseif($member->return_date >
                                                                            $member->due_return_date) <label for=""
                                                                                data-toggle="modal"
                                                                                data-target="#return_book"
                                                                                class="label label-danger"
                                                                                data-level_id="{{$member->student_id}}"
                                                                                data-email="{{$member->email}}"><b
                                                                                    for="" data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="SEND A MESSAGE">{!!date('d/m/Y',
                                                                                    strtotime( $member->return_date))
                                                                                    !!}</b></label> @else
                                                                            {!!date('d/m/Y', strtotime(
                                                                            $member->return_date)) !!} @endif</a></td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>

                                                {!! Form::close() !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div role="tabpanel" class="tab-pane fade in" id="profile_settings">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="NameSurname" class="col-sm-2 control-label">Name Surname</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="NameSurname"
                                                        name="NameSurname" placeholder="Name Surname"
                                                        value="Marc K. Hammond" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="Email" class="col-sm-2 control-label">Email</label>
                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="email" class="form-control" id="Email" name="Email"
                                                        placeholder="Email" value="example@example.com" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputExperience"
                                                class="col-sm-2 control-label">Experience</label>

                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <textarea class="form-control" id="InputExperience"
                                                        name="InputExperience" rows="3"
                                                        placeholder="Experience"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputSkills" class="col-sm-2 control-label">Skills</label>

                                            <div class="col-sm-10">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="InputSkills"
                                                        name="InputSkills" placeholder="Skills">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <input type="checkbox" id="terms_condition_check"
                                                    class="chk-col-red filled-in" />
                                                <label for="terms_condition_check">I agree to the <a href="#">terms and
                                                        conditions</a></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="change_password_settings">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="OldPassword" class="col-sm-3 control-label">Old Password</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="OldPassword"
                                                        name="OldPassword" placeholder="Old Password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NewPassword" class="col-sm-3 control-label">New Password</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="NewPassword"
                                                        name="NewPassword" placeholder="New Password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="NewPasswordConfirm" class="col-sm-3 control-label">New Password
                                                (Confirm)</label>
                                            <div class="col-sm-9">
                                                <div class="form-line">
                                                    <input type="password" class="form-control" id="NewPasswordConfirm"
                                                        name="NewPasswordConfirm" placeholder="New Password (Confirm)"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-danger">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($book_list))
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr class="headings">

                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Title">
                                Title</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Number">
                                Number</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top"
                                title="Book ISBN Number">
                                ISBN#</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Publisher">
                                Publisher</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Author">
                                Author</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Subject">
                                Subject</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top"
                                title="Book Rack Number">
                                Rack#</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top"
                                title="Book Total Quantity and Price">
                                Qty</th>
                            <!-- <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book In Stock">in
                                Stock</th> -->
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Price">
                                price</th>
                            <!-- <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Added Date"> -->
                            <!-- Date</th> -->
                            <th class="column-title no-link last" data-toggle="tooltip" data-placement="top"
                                title="Book Operations"><span class="nobr">Action</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($book_list as $book)
                        <tr class="even pointer">
                            <td class="">{!! $book->book_title !!}</td>
                            <td class="">{!! $book->book_number !!}</td>
                            <td class="">{!! $book->isbn_number !!}</td>
                            <td class="">{!! $book->publish !!}</td>
                            <td class="">{!! $book->author !!}</td>
                            <td class="">{!! $book->subject !!}</td>
                            <td class="">{!! $book->rac_number !!}</td>
                            <td class="">{!! $book->book_qty !!}</td>
                            <!-- <td class="">{!! $book->available !!}</td> -->
                            <td class="">{!! $book->book_price !!}</td>

                            <td colspan="3">
                                {!! Form::open(['route' => ['expensestype.delete', $book->id],
                                'method' =>
                                'delete', 'id' => 'delete_form']) !!}

                                <div class="btn-group">

                                    <button type="button" class="btn bg-pink dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        ACTION <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">

                                        <li>
                                            <a href="{!! url('print-faculty-single', [$book->id]) !!} " target="_blank">
                                                <i class="glyphicon glyphicon-print"></i> Print</a>
                                        </li>

                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a data-book_id="{{$book->id}}" data-book_qty="{{$book->book_qty}}"
                                                data-available="{{$book->available}}"
                                                data-book_price="{{$book->book_price}}"
                                                data-rac_number="{{$book->rac_number}}"
                                                data-subject="{{$book->subject}}" data-author="{{$book->author}}"
                                                data-publish="{{$book->publish}}"
                                                data-isbn_number="{{$book->isbn_number}}"
                                                data-book_number="{{$book->book_number}}"
                                                data-book_title="{{$book->book_title}}" data-date="{{$book->date}}"
                                                data-book_description="{{$book->book_description}}"
                                                data-created_at="{{$book->created_at}}"
                                                data-updated_at="{{$book->updated_at}}" data-toggle="modal"
                                                data-target="#book-show">
                                                <i class="glyphicon glyphicon-eye-open"></i> View</a>

                                        </li>

                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{!! route('book.edit', [$book->id]) !!}">
                                                <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                        </li>

                                        <li role="separator" class="divider"></li>

                                        <li>

                                            <a id="delete_link" href="#"
                                                data-confirm="Are you sure want to delete {{$book->book_title}} ?"><i
                                                    class="material-icons">delete_forever</i> Delete</a>
                                        </li>

                                    </ul>
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>
</div>

<div class="modal fade" id="expense-type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="fa fa-head">Add New Expense Type</span> </h4>
            </div>
            <form action="{{route('expensestype.store')}}" method="POST" id="frm-level-create"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($book)){{$book->school_id == $school->id ? 'selected' : ''}} @endif>
                                    {{$school->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                    @endif
                    <!-- Level Field -->
                    <div class="form-group">
                        <label for="">Expense Type <b style="color:red">*</b></label>
                        {!! Form::text('type', null, ['class' => 'form-control', '' => 'Enter Expense
                        Type']) !!}
                    </div>
                    <!-- Submit Field -->
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                    {!! Form::submit('Create Expense Type', ['class' => 'btn btn-success']) !!}
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" id="book-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="fa fa-level-up">Book Details</span> </h4>
            </div>
            <div class="modal-body" style="background:#EEEEEE">

                <div class="form-group">
                    <div class="form-line">
                        <label for="">Book Title</label>
                        <input type="hidden" name="" id="book_id" class="form-control" disabled>
                        <input type="text" name="" id="book_title_view" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="">Book Number</label>
                        <input type="text" name="" id="book_number_view" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="">Isbn Number</label>
                        <input type="text" name="" id="book_isbn_view" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="">Publisher</label>
                        <input type="text" name="" id="book_publisher_view" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="">Book Author</label>
                        <input type="text" name="" id="book_author_view" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="">Subject</label>
                        <input type="text" name="" id="book_subject_view" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="">Rack Number</label>
                        <input type="text" name="" id="book_rack_number_view" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="">Book Quantity</label>
                        <input type="text" name="" id="book_qty_view" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="">Book Price</label>
                        <input type="text" name="" id="book_price_view" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="">Book Availablity</label>
                        <input type="text" name="" id="book_available_view" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <label for="">Book Description</label>
                        <input type="text" name="" id="book_description_view" class="form-control" disabled>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                <!-- {!! Form::submit('Create Level', ['class' => 'btn btn-success']) !!} -->
            </div>
            </form>
        </div>
    </div>
</div>
</div>









<div class="modal fade" id="return_book" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="fa fa-head">Send Email</span> </h4>
            </div>
            {!! Form::model(NULL, ['url' => ['issuebook.update'], 'method' => 'post', 'class' => 'form-horizontal
            form-label-left', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            <div class="modal-body">
                @if(auth()->user()->group == "Admin")
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <select class="form-control bootstrap-select" name="school_id" id="school_id">
                            <option>Choose School</option>
                            @foreach (auth()->user()->school->all() as $school)
                            <option value="{{ $school->id }}"
                                @if(isset($member)){{$member->school_id == $school->id ? 'selected' : ''}} @endif>
                                {{$school->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @else
                <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                @endif

                <div class="form-group">
                    <div class="form-line">
                        <input type="text" name="email_user" id="email_user" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <textarea name="" id="" cols="10" rows="5" class="form-control"></textarea>
                    </div>
                </div>

                <!-- Submit Field -->
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                {!! Form::submit('Return Book', ['class' => 'btn btn-success']) !!}
            </div>
            </form>
        </div>
    </div>
</div>

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" id="level-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="fa fa-level-up">Add New Level</span> </h4>
            </div>
            <form action="{{route('levels.update','$member->id')}}" method="post">
                @csrf
                @method('PUT')
                <!-- <form action="{{route('levels.store')}}" method="POST" id="frm-level-create"> -->
                <!-- <form action="#" method="POST" id="frm-classroom-create"> -->
                <div class="modal-body" style="background:#EEEEEE">

                    <!-- Level Field -->
                    <div class="form-group">
                        {!! Form::label('level', 'Level:') !!}
                        {!! Form::text('level', null, ['class' => 'form-control', '' => 'Enter Level Here','readonly'])
                        !!}
                    </div>
                    <input type="hidden" id="level_id" name="level_id">
                    <!-- Course Id Field -->
                    <div class="form-group">
                        {!! Form::label('course_id', 'Course Name:') !!}
                        <input type="text" name="course_id" id="course_id" class="form-control" readonly>
                    </div>
                    <!-- Level Description Field -->
                    <div class="form-group">
                        <label for="level_description">Level Description:</label>
                        <input type="text" class="form-control" name="level_description" id="level_description"
                            readonly>
                        <!-- {!! Form::text('level_description', null, ['class' => 'form-control', 'cols' => 40, 'rows' =>2, ''=> 'Level Description']) !!} -->
                    </div>

                    <!-- Created At Field -->
                    <div class="form-group">
                        {!! Form::label('created_at', 'Created At:') !!}
                        <input type="text" class="form-control" name="created_at" id="created_at" readonly>
                    </div>

                    <!-- Updated At Field -->
                    <div class="form-group">
                        {!! Form::label('updated_at', 'Updated At:') !!}
                        <input type="text" class="form-control" name="updated_at" id="updated_at" readonly>
                    </div>
                    <!-- Submit Field -->
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                    <!-- {!! Form::submit('Create Level', ['class' => 'btn btn-success']) !!} -->
                </div>
            </form>
        </div>
    </div>
</div>
</div>


@section('js')

<script>
$('#date').datetimepicker({
    format: 'Y-m-d',
    timepicker: false
});

var deleteLinks = document.querySelectorAll('#delete_link');

for (var i = 0; i < deleteLinks.length; i++) {
    deleteLinks[i].addEventListener('click', function(event) {
        event.preventDefault();

        var choice = confirm(this.getAttribute('data-confirm'));

        if (choice) {
            document.getElementById("delete_form").submit(); //form id
        }
    });
}

//  Exportable table
$('.js-exportable').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});

// {{--------------------------Level Side-------------------------}} 
$('#return_book').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    var level = button.data('level')
    var course_id = button.data('course_id')
    var level_description = button.data('level_description')
    var level_id = button.data('level_id')
    var email = button.data('email')

    // alert(email)
    // $('#email_user').val(email);

    var modal = $(this)

    modal.find('.modal-title').text('Send Email');
    modal.find('.modal-body #level').val(level);
    modal.find('.modal-body #course_id').val(course_id);
    modal.find('.modal-body #level_description').val(level_description);
    modal.find('.modal-body #level_id').val(level_id);
    modal.find('.modal-body #email_user').val(email);
});

// {{--------------------------Level view Side-------------------------}} 
$('#level-show').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    var level = button.data('level')
    var course_id = button.data('course_id')
    var level_description = button.data('level_description')
    var created_at = button.data('created_at')
    var updated_at = button.data('updated_at')
    var level_id = button.data('level_id')

    var modal = $(this)

    modal.find('.modal-title').text('VIEW LEVEL INFORMATION');
    modal.find('.modal-body #level').val(level);
    modal.find('.modal-body #course_id').val(course_id);
    modal.find('.modal-body #level_description').val(level_description);
    modal.find('.modal-body #created_at').val(created_at);
    modal.find('.modal-body #updated_at').val(updated_at);
    modal.find('.modal-body #level_id').val(level_id);
});

</script>

@endsection