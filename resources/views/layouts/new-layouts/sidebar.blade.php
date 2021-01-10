@if(Auth::user()->group == "Admin")


<div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{url('/home')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{url('dashboard2')}}" aria-expanded="false"><i
                                class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard 2</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{url('dashboard3')}}" aria-expanded="false"><i
                                class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard 3</span></a></li>
                    {{-- <li><a href="index2.html">Dashboard2</a></li>
          <li><a href="{{url('school/dashboard3')}}">Dashboard3</a>
            </li> --}}
        </ul>
        </li>

        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                href="{{route('roles.index')}}" aria-expanded="false"><i class="fa fa-lock"></i><span
                    class="hide-menu">Role</span></a></li>
        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                href="{{route('permissions.index')}}" aria-expanded="false"><i class="fa fa-lock"></i><span
                    class="hide-menu">Permission</span></a></li>



        {{-- <li><a><i class="fa fa-home"></i> Front Office <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                <li><a href="form.html">Front Office</a></li>
                <li><a href="form_advanced.html">Admission Enquiry</a></li>
                <li><a href="{{route('contact_us.index')}}">Complain</a></li>
                <li><a href="form_wizards.html">Setup Front Office</a></li>
                <li><a href="form_upload.html">Form Upload</a></li>
                <li><a href="form_buttons.html">Form Buttons</a></li>
            </ul>
        </li> --}}

        @if(in_array('school_view',$permision) || in_array('school_add',$permision) ||
        in_array('school_update',$permision) || in_array('school_delete',$permision))
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                    class="fa fa-building" aria-hidden="true"></i><span class="fa fa-chevron-down"></span> All Schools </a>
            <ul aria-expanded="false" class="nav child_menu">

                @if(in_array('school_view',$permision))
                <li class="sidebar-item"><a href="{{ route('searchSchool') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Manage School </span></a></li>
                @endif
                {{-- @if(in_array('school_delete',$permision))
                <li class="sidebar-item"><a href="{{ url('manage') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Structutre </span></a></li>
                @endif --}}
            </ul>
        </li>
        @endif
        {{-- @if ($permision)
        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                    class="fa fa-paw" aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Academics </a>
            <ul aria-expanded="false" class="nav child_menu">
                @if(in_array('class_add',$permision))
                <li class="sidebar-item"><a href="{{route('classes.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Classes </span></a></li>
                @endif
                @if(in_array('batch_add',$permision))
                <li class="sidebar-item"><a href="{{route('batches.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Session </span></a></li>
                @endif 

                @if(in_array('subject_add',$permision))
                <li class="sidebar-item"><a href="{{route('courses.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Subject </span></a></li>
                @endif

                @if(in_array('level_add',$permision))
                <li class="sidebar-item"><a href="{{route('levels.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Level </span></a></li>
                @endif

                @if(in_array('day_add',$permision))
                <li class="sidebar-item"><a href="{{route('days.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Days </span></a></li>
                @endif

                @if(in_array('shift_add',$permision))
                <li class="sidebar-item"><a href="{{route('shifts.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Shifts </span></a></li>
                @endif

                @if(in_array('class_add',$permision))
                <li class="sidebar-item"><a href="{{route('times.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Times </span></a></li>
                @endif
                @if(in_array('classroom_add',$permision))
                <li class="sidebar-item"><a href="{{route('classRooms.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Rooms </span></a></li>
                @endif

                @if(in_array('class_add',$permision))
                <li class="sidebar-item"><a href="{{route('academics.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Academics </span></a></li>
                @endif
                @if(in_array('grade_add',$permision))
                <li class="sidebar-item"><a href="{{route('semesters.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Grade </span></a></li>
                @endif
            </ul>
        </li>
        @endif --}}

        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                aria-expanded="false"><i class="fa fa-calendar" aria-hidden="true"></i><span
                    class="fa fa-chevron-down"></span> Staff Attendance </a>
            <ul aria-expanded="false" class="nav child_menu">
                <li class="sidebar-item"><a href="{!! route('attendances.index') !!}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Take Attendance </span></a></li>

                <!-- <li class="sidebar-item"><a href="{{url('timetables')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Time Table </span></a></li>
                <li class="sidebar-item"><a href="{{url('salary')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Salary </span></a></li>
                <li class="sidebar-item"><a href="{{url('county.home')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Country </span></a></li> -->
            </ul>
        </li>

        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                aria-expanded="false"><i class="fa fa-tags" aria-hidden="true"></i><span
                    class="fa fa-chevron-down"></span> Schedule </a>
            <ul aria-expanded="false" class="nav child_menu">
                <li class="sidebar-item"><a href="{{route('classSchedules.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Class Schedules </span></a></li>
                {{-- <li class="sidebar-item"><a href="{{url('timetables')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Time Table </span></a></li>
                <li class="sidebar-item"><a href="{{url('salary')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Salary </span></a></li>
                <li class="sidebar-item"><a href="{{url('county.home')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Country </span></a></li> --}}
            </ul>
        </li>

        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                aria-expanded="false"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span
                    class="fa fa-chevron-down"></span> Students Information</a>
            <ul aria-expanded="false" class="nav child_menu">

                <li class="sidebar-item"><a href="{{route('admin\search.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> All Students</span></a></li>
            </ul>
        </li>

          <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                aria-expanded="false"><i class="fa fa-suitcase " aria-hidden="true"></i><span
                    class="fa fa-chevron-down"> </span> Teachers Information</a>
            <ul aria-expanded="false" class="nav child_menu">
                <li class="sidebar-item"><a href="{{route('searchTeacher')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> All Teachers </span></a></li>
                {{-- <li class="sidebar-item"><a href="{{url('teachers/list')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Teacher List</span></a></li> --}}

            </ul>
        </li>


        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                    class="fa fa-money" aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Fee Collection
            </a>
            <ul aria-expanded="false" class="nav child_menu">
                <li class="sidebar-item"><a href="{{url('view/fee/collection')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Collect Fee </span></a></li>
                <li class="sidebar-item"><a href="{{ url('student/list/fee/collection') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Class Wise Fee Collect </span></a>
                </li>
                <li class="sidebar-item"><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Search Fee Payment </span></a></li>
                <li class="sidebar-item"><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Structutre </span></a></li>
                <li class="sidebar-item"><a href="{{route('feetypes.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Type </span></a></li>
                <li class="sidebar-item"><a href="{{route('days.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Discount </span></a></li>
            </ul>
        </li>

        {{-- <li class="sidebar-item"><a href="{{url('user.salary')}}" class="sidebar-link"><i class="fa fa-money"></i><span
                    class="hide-menu">Salary</span></a></li> --}}

        {{-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                aria-expanded="false"><i class="fa fa-credit-card " aria-hidden="true"></i><span
                    class="fa fa-chevron-down"> </span> Groups</a>
            <ul aria-expanded="false" class="nav child_menu">
                <li class="sidebar-item"><a href="{{route('faculties.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Student Group </span></a></li>
                <li class="sidebar-item"><a href="{{route('departments.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Class Group</span></a></li>

            </ul>
        </li> --}}

        {{-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                    class="fa fa-google-wallet" aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Reports
            </a>
            <ul aria-expanded="false" class="nav child_menu">
                <li class="sidebar-item"><a href="{{ route('Reports') }}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> All Reports </span></a></li>
                <li class="sidebar-item"><a href="{{ route('getstudentInormation') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Student Reports </span></a></li>
                <li class="sidebar-item"><a href="{{ route('Finance') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Finance Reports </span></a></li>
                <!-- <li class="sidebar-item"><a href="{{ route('getFeeReport') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Finance Reports </span></a></li> -->
                <li class="sidebar-item"><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Search Fee Payment </span></a></li>
                <li class="sidebar-item"><a href="{{ route('studentFees.index') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Structutre </span></a></li>
                <li class="sidebar-item"><a href="{{route('levels.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> User Log </span></a></li>
                <li class="sidebar-item"><a href="{{route('days.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Discount </span></a></li>
                <li class="sidebar-item"><a href="{{route('shifts.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Human Resources </span></a></li>
                <li class="sidebar-item"><a href="{{route('times.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Examination </span></a></li>
                <li class="sidebar-item"><a href="{{route('times.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Online Examination </span></a></li>
                <li class="sidebar-item"><a href="{{route('AttendaceReport')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Attendance </span></a></li>
                <li class="sidebar-item"><a href="{{route('academics.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Academics </span></a></li>
                <li class="sidebar-item"><a href="{{route('semesters.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Grade </span></a></li>
            </ul>
        </li> --}}

        {{-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                    class="fa fa-puzzle-piece" aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Front CMS
            </a>
            <ul aria-expanded="false" class="nav child_menu">
                <li class="sidebar-item"><a href="{{ route('event.create') }}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> School Event </span></a></li>
                <li class="sidebar-item"><a href="{{ route('getFeeReport') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Gallary </span></a></li>
                <li class="sidebar-item"><a href="{{ route('news.create') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> News </span></a></li>
                <li class="sidebar-item"><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Media Manager </span></a></li>
                <li class="sidebar-item"><a href="{{ route('studentFees.index') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Pages </span></a></li>
                <li class="sidebar-item"><a href="{{route('levels.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Menu </span></a></li>
                <li class="sidebar-item"><a href="{{route('banner.create')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Banner Menu </span></a></li>
            </ul>
        </li> --}}

        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                    class="fa fa-certificate" aria-hidden="true"></i><span class="fa fa-chevron-down"></span>
                Certificates </a>
            <ul aria-expanded="false" class="nav child_menu">
                <li class="sidebar-item"><a href="{{ route('Reports') }}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Student Certificate </span></a>
                </li>
                <li class="sidebar-item"><a href="{{ url('design_certificate') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Design Certificates </span></a></li>
                <li class="sidebar-item"><a href="{{ route('getFeeReport') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Generate Certificate </span></a></li>
                <li class="sidebar-item"><a href="{{ url('student/id_card') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Create ID Card </span></a></li>
                <li class="sidebar-item"><a href="{{ url('staff/id_card') }}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Staff ID Card </span></a></li>
                <li class="sidebar-item"><a href="{{route('student_idCard.generate')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Generate ID Card </span></a></li>
                <li class="sidebar-item"><a href="{{route('banner.create')}}" class="sidebar-link"><i
                            class="mdi mdi-note-plus"></i><span class="hide-menu"> Banner Menu </span></a></li>
            </ul>
        </li>

        {{-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                aria-expanded="false"><i class="fa fa-th-large custom"></i><span class="fa fa-chevron-down"> </span>
                Exam Management</a>
            <ul aria-expanded="false" class="nav child_menu">
                <li class="sidebar-item"><a href="{{route('teachers.index')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Teacher </span></a></li>
                <li class="sidebar-item"><a href="{{url('teachers/list')}}" class="sidebar-link"><i
                            class="mdi mdi-note-outline"></i><span class="hide-menu"> Teacher List</span></a></li>

            </ul>
        </li> --}}

      

        <li class="sidebar-item"><a href="{{url('calendar')}}" class="sidebar-link"><i class="fa fa-calendar"
                    aria-hidden="true"></i><span class="hide-menu"> Calendar </span></a></li>

        {{-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                href="{{url('download')}}" aria-expanded="false"><i class="fa fa-cloud-download"></i><span
                    class="hide-menu">Downloads</span></a></li> --}}

        {{-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                href="{{url('download')}}" aria-expanded="false"><i class="fa fa-cloud-download"></i><span
                    class="hide-menu">Downloads</span></a></li> --}}

        </ul>
    </div>


    <div class="menu_section">
        <h3>Live On</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-cogs"></i> Settings <span class="fa fa-chevron-down"></span></a>
                {{-- <li class="sidebar-item"> <span class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-cogs " aria-hidden="true"> </i> <span class="hide-menu"> Settings</span></span> --}}
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{url('profile')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> My profile </span></a></li>
                    <li class="sidebar-item"><a href="{{url('change.password')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Change Password </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{{route('users.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add User </span></a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                    <li><a href="fixed_footer.html">Fixed Footer</a></li>
                </ul>
            </li>

            {{-- <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="page_403.html">403 Error</a></li>
          <li><a href="page_404.html">404 Error</a></li>
          <li><a href="page_500.html">500 Error</a></li>
          <li><a href="plain_page.html">Plain Page</a></li>
          <li><a href="login.html">Login Page</a></li>
          <li><a href="pricing_tables.html">Pricing Tables</a></li>
        </ul>
      </li> --}}
            {{-- <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="#level1_1">Level One</a>
            <li><a>Level One<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li class="sub_menu"><a href="level2.html">Level Two</a>
                </li>
                <li><a href="#level2_1">Level Two</a>
                </li>
                <li><a href="#level2_2">Level Two</a>
                </li>
              </ul>
            </li>
            <li><a href="#level1_2">Level One</a>
            </li>
        </ul>
      </li>     --}}
            {{-- <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li> --}}
        </ul>
    </div>

</div>

@endif

<!-- ACCOUNTANT ACCESS -->
@if(Auth::user()->group == "Owner")
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{url('/home')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                class="hide-menu">Dashboard</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{route('home.dashboard2')}}" aria-expanded="false"><i
                                class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard 2</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{url('school/dashboard3')}}" aria-expanded="false"><i
                                class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard 3</span></a></li>
                    {{-- <li><a href="">Dashboard2</a></li>
          <li><a href="index3.html">Dashboard3</a></li> --}}
                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{route('roles.index')}}" aria-expanded="false"><i class="fa fa-lock"></i><span
                        class="hide-menu">Role</span></a></li>
            {{-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{route('permissions.index')}}" aria-expanded="false"><i
                        class="fa fa-lock fa fa-unlock"></i><span class="hide-menu">Permission</span></a></li> --}}



            {{-- <li><a><i class="fa fa-home"></i> Front Office <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="form.html">Front Office</a></li>
                    <li><a href="form_advanced.html">Admission Enquiry</a></li>
                    <li><a href="{{route('contact_us.index')}}">Complain</a></li>
                    <li><a href="form_wizards.html">Setup Front Office</a></li>
                    <li><a href="form_upload.html">Form Upload</a></li>
                    <li><a href="form_buttons.html">Form Buttons</a></li>
                </ul>
            </li> --}}

            {{-- @if(in_array('school_view',$permision) || in_array('school_add',$permision) || --}}
            {{-- in_array('school_update',$permision) || in_array('school_delete',$permision)) --}}
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                        class="fa fa-building" aria-hidden="true"></i><span class="fa fa-chevron-down"></span> School
                </a>
                <ul aria-expanded="false" class="nav child_menu">

                    {{-- @if(in_array('school_view',$permision)) --}}
                    <li class="sidebar-item"><a href="{{ route('school.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Manage School </span></a></li>
                    {{-- @endif --}}
                    {{-- @if(in_array('school_delete',$permision))
                    <li class="sidebar-item"><a href="{{ url('manage') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Structutre </span></a></li>
                    @endif --}}
                </ul>
            </li>
            {{-- @endif --}}

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                        class="fa fa-paw" aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Academics </a>
                <ul aria-expanded="false" class="nav child_menu">
                    {{-- @if(in_array('class_add',$permision)) --}}
                    <li class="sidebar-item"><a href="{{route('classes.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Classes </span></a></li>
                    {{-- @endif --}}
                    {{-- @if(in_array('batch_add',$permision))--}}
                    <li class="sidebar-item"><a href="{{route('batches.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Session </span></a></li>
                    {{-- @endif  --}}

                    {{-- @if(in_array('subject_add',$permision)) --}}
                    <li class="sidebar-item"><a href="{{route('courses.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Subject </span></a></li>
                    {{-- @endif --}}

                    {{-- @if(in_array('level_add',$permision)) --}}
                    <li class="sidebar-item"><a href="{{route('levels.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Level </span></a></li>
                    {{-- @endif --}}

                    {{-- @if(in_array('day_add',$permision)) --}}
                    <li class="sidebar-item"><a href="{{route('days.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Days </span></a></li>
                    {{-- @endif --}}

                    {{-- @if(in_array('shift_add',$permision)) --}}
                    <li class="sidebar-item"><a href="{{route('shifts.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Shifts </span></a></li>
                    {{-- @endif --}}

                    {{-- @if(in_array('class_add',$permision)) --}}
                    <li class="sidebar-item"><a href="{{route('times.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Times </span></a></li>
                    {{-- @endif --}}
                    {{-- @if(in_array('classroom_add',$permision)) --}}
                    <li class="sidebar-item"><a href="{{route('classRooms.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Rooms </span></a></li>
                    {{-- @endif --}}

                    {{-- @if(in_array('class_add',$permision))
                    <li class="sidebar-item"><a href="{{route('academics.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Academics </span></a></li>
                    @endif --}}
                    {{-- @if(in_array('grade_add',$permision)) --}}
                    <li class="sidebar-item"><a href="{{route('semesters.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Grade </span></a></li>
                    {{-- @endif --}}
                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-calendar"
                        aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Attendance </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{!! route('attendances.index') !!}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Take Attendance </span></a>
                    </li>
                    <!-- <li class="sidebar-item"><a href="{{url('timetables')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Time Table </span></a></li>
                    <li class="sidebar-item"><a href="{{url('salary')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Salary </span></a></li>
                    <li class="sidebar-item"><a href="{{url('county.home')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Country </span></a></li> -->
                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-tags" aria-hidden="true"></i><span
                        class="fa fa-chevron-down"></span> Schedule </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{route('classSchedules.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Class Schedules </span></a>
                    </li>
                    <!-- <li class="sidebar-item"><a href="{{url('timetables')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Time Table </span></a></li>
                    <li class="sidebar-item"><a href="{{url('salary')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Salary </span></a></li>
                    <li class="sidebar-item"><a href="{{url('county.home')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Country </span></a></li> -->
                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-usd" aria-hidden="true"></i><span
                        class="fa fa-chevron-down"></span> Incomes </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{route('income.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Income </span></a></li>
                    <li class="sidebar-item"><a href="{{route('incometype.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Income Types </span></a></li>
                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-credit-card"
                        aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Expenses </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{route('expenses.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Expense </span></a></li>
                    <li class="sidebar-item"><a href="{{route('expensestype.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Expense Type </span></a></li>
                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-book" aria-hidden="true"></i><span
                        class="fa fa-chevron-down"></span> Library </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{route('book.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Book List </span></a></li>
                    <li class="sidebar-item"><a href="{{route('librarymember.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Issue Return </span></a></li>
                    <li class="sidebar-item"><a href="{{url('add/librarymember')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Member </span></a></li>
                    <!-- <li class="sidebar-item"><a href="{{url('add/staff/member')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Staff Member </span></a></li> -->
                </ul>
            </li>

            {{-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-tasks" aria-hidden="true"></i><span
                        class="fa fa-chevron-down"></span> Inventory </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{url('issue/item')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Issue Item </span></a></li>
                    <li class="sidebar-item"><a href="{{url('add/item/stock')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Item Stock</span></a></li>
                    <li class="sidebar-item"><a href="{{url('add/item')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Item </span></a></li>
                    <li class="sidebar-item"><a href="{{url('item/category')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Item Category </span></a></li>
                    <li class="sidebar-item"><a href="{{url('item/store')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Item Store </span></a></li>
                    <li class="sidebar-item"><a href="{{url('item/supplier')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Item Supplier </span></a></li>
                    <!-- <li class="sidebar-item"><a href="{{url('add/staff/member')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Staff Member </span></a></li> -->
                </ul>
            </li> --}}

            {{-- <li class="sidebar-item"><a href="{{url('user.project')}}" class="sidebar-link"><i
                        class="fa fa-tasks "></i><span class="hide-menu">Projects</span></a></li> --}}

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-graduation-cap"
                        aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Student Information</a>
                <ul aria-expanded="false" class="nav child_menu">

                    <li class="sidebar-item"><a href="{{url('all/student/list')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Student list</span></a></li>
                    <li class="sidebar-item"><a href="{{route('admissions.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Admissions</span></a></li>
                    <li class="sidebar-item"><a href="{{route('OnlineAdmissions')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Online Admission</span></a>
                    </li>
                </ul>
            </li>


            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                        class="fa fa-money" aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Fee
                    Collection </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{url('view/fee/collection')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Collect Fee </span></a></li>
                    <li class="sidebar-item"><a href="{{ url('student/list/fee/collection') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Class Wise Fee Collect
                            </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Search Fee Payment </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Structutre </span></a></li>
                    <li class="sidebar-item"><a href="{{route('feetypes.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Type </span></a></li>
                    <li class="sidebar-item"><a href="{{route('days.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Discount </span></a></li>
                </ul>
            </li>

            {{-- <li class="sidebar-item"><a href="{{url('user.salary')}}" class="sidebar-link"><i
                        class="fa fa-money"></i><span class="hide-menu">Salary</span></a></li> --}}

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-credit-card "
                        aria-hidden="true"></i><span class="fa fa-chevron-down"> </span> Groups</a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{route('faculties.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Student Group </span></a></li>
                    <li class="sidebar-item"><a href="{{route('departments.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Class Group</span></a></li>

                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                        class="fa fa-google-wallet" aria-hidden="true"></i><span class="fa fa-chevron-down"></span>
                    Reports </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{ route('Reports') }}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> All Reports </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('getstudentInormation') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Student Reports </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('Finance') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Finance Reports </span></a></li>
                    <!-- <li class="sidebar-item"><a href="{{ route('getFeeReport') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Finance Reports </span></a></li> -->
                    <li class="sidebar-item"><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Search Fee Payment </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{{ route('studentFees.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Structutre </span></a></li>
                    <li class="sidebar-item"><a href="{{route('levels.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> User Log </span></a></li>
                    <li class="sidebar-item"><a href="{{route('days.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Discount </span></a></li>
                    <li class="sidebar-item"><a href="{{route('shifts.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Human Resources </span></a></li>
                    <li class="sidebar-item"><a href="{{route('times.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Examination </span></a></li>
                    <li class="sidebar-item"><a href="{{route('times.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Online Examination </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{{route('AttendaceReport')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Attendance </span></a></li>
                    <li class="sidebar-item"><a href="{{route('academics.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Academics </span></a></li>
                    <li class="sidebar-item"><a href="{{route('semesters.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Grade </span></a></li>
                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                        class="fa fa-puzzle-piece" aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Front
                    CMS </a>
                <ul aria-expanded="false" class="nav child_menu">
                    
                    <li class="sidebar-item"><a href="{{ route('front_cms.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Theme Setting </span></a></li>
                                <li class="sidebar-item"><a href="{{ route('event.create') }}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> School Event </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('getFeeReport') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Gallary </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('news.create') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> News </span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{route('media.index')}}" aria-expanded="false"><i
                                class="fa fa-cloud-download"></i><span class="hide-menu">Media Manager</span></a></li>
                    {{-- <li class="sidebar-item"><a href="{{ route('studentFees.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Pages </span></a></li> --}}
                    {{-- <li class="sidebar-item"><a href="{{route('levels.index')}}" class="sidebar-link"><i --}}
                                {{-- class="mdi mdi-note-plus"></i><span class="hide-menu"> Menu </span></a></li> --}}
                    <li class="sidebar-item"><a href="{{route('banner.create')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Banner Menu </span></a></li>
                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                        class="fa fa-certificate" aria-hidden="true"></i><span class="fa fa-chevron-down"></span>
                    Certificates </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <!-- <li class="sidebar-item"><a href="{{ route('Reports') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Student Certificate </span></a></li> -->
                    <li class="sidebar-item"><a href="{{ route('design_certiifcate.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Design Certificates </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{{ url('generate/certificate') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Generate Certificate </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{{ route('design_certificates.list') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Certificates List</span></a></li>
                    <li class="sidebar-item"><a href="{{ route('student_idCard.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Design ID Card </span></a></li>
                    <li class="sidebar-item"><a href="{{url('generate/id_card')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Generate ID Card </span></a></li>
                    <!-- <li class="sidebar-item"><a href="{{route('banner.create')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Banner Menu </span></a></li> -->
                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-th-large custom"></i></i><span
                        class="fa fa-chevron-down"> </span> Exam Management</a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{url('exam/create')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Create Exam </span></a></li>
                    <li class="sidebar-item"><a href="{{url('exam/list')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Exam List</span></a></li>

                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-file " aria-hidden="true"></i><span
                        class="fa fa-chevron-down"> </span> Exam Questions </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{url('question/list')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Question List</span></a></li>
                    <li class="sidebar-item"><a href="{{url('paper/generate')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Generate Question Paper
                            </span></a></li>

                </ul>
            </li>


            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-credit-card "
                        aria-hidden="true"></i><span class="fa fa-chevron-down"> </span> Teachers</a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{route('teachers.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Teacher </span></a></li>
                    <li class="sidebar-item"><a href="{{url('teachers/list')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Teacher List</span></a></li>

                </ul>
            </li>

            {{-- <li class="sidebar-item"><a href="{{url('calendar')}}" class="sidebar-link"><i class="fa fa-calendar"
                        aria-hidden="true"></i><span class="hide-menu"> Calendar </span></a></li>

            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                    href="{{url('download')}}" aria-expanded="false"><i class="fa fa-cloud-download"></i><span
                        class="hide-menu">Downloads</span></a></li>
 --}}

        </ul>
    </div>


    <div class="menu_section">
        <h3>Live On</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-cogs"></i> Settings <span class="fa fa-chevron-down"></span></a>
                {{-- <li class="sidebar-item"> <span class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="fa fa-cogs " aria-hidden="true"> </i> <span class="hide-menu"> Settings</span></span> --}}
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{url('profile')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> My profile </span></a></li>
                    <li class="sidebar-item"><a href="{{url('change.password')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Change Password </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{{route('users.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add User </span></a></li>

                    <li class="sidebar-item"><a href="{{url('institute')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> School Settings </span></a></li>

                    <li class="sidebar-item"><a href="{{url('gpa')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> School Gpa Settings </span></a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-clone"></i>Layouts <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                    <li><a href="fixed_footer.html">Fixed Footer</a></li>
                </ul>
            </li>

            {{-- <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="page_403.html">403 Error</a></li>
          <li><a href="page_404.html">404 Error</a></li>
          <li><a href="page_500.html">500 Error</a></li>
          <li><a href="plain_page.html">Plain Page</a></li>
          <li><a href="login.html">Login Page</a></li>
          <li><a href="pricing_tables.html">Pricing Tables</a></li>
        </ul>
      </li> --}}
            {{-- <li><a><i class="fa fa-sitemap"></i> Multilevel Menu <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="#level1_1">Level One</a>
            <li><a>Level One<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li class="sub_menu"><a href="level2.html">Level Two</a>
                </li>
                <li><a href="#level2_1">Level Two</a>
                </li>
                <li><a href="#level2_2">Level Two</a>
                </li>
              </ul>
            </li>
            <li><a href="#level1_2">Level One</a>
            </li>
        </ul>
      </li>     --}}
            {{-- <li><a href="javascript:void(0)"><i class="fa fa-laptop"></i> Landing Page <span class="label label-success pull-right">Coming Soon</span></a></li> --}}
        </ul>
    </div>

</div>
@endif

<!-- TEACHERS ACCESS -->
@if(Auth::user()->role_id == 14)
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
    <div class="menu_section">
        <h3>Accountant </h3>
        <ul class="nav side-menu">
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false"><i
                        class="fa fa-money" aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Fee
                    Collection </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{url('view/fee/collection')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Collect Fee </span></a></li>
                    <li class="sidebar-item"><a href="{{ url('student/list/fee/collection') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Class Wise Fee Collect
                            </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Search Fee Payment </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Structutre </span></a></li>
                    <li class="sidebar-item"><a href="{{route('feetypes.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Type </span></a></li>
                    <li class="sidebar-item"><a href="{{route('days.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Discount </span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@endif


<!-- TEACHERS ACCESS -->
@if(Auth::user()->group == 'Teacher')

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">

            <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{url('/home')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                class="hide-menu">Dashboard</span></a></li>
                    {{-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{url('dashboard2')}}" aria-expanded="false"><i
                                class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard 2</span></a></li>
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{url('dashboard3')}}" aria-expanded="false"><i
                                class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard 3</span></a></li> --}}
                </ul>
            </li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-calendar"
                        aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Attendance </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{!! url('mark-teacher-attendance') !!}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Take Attendance </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{!! url('attendance/list') !!}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Attendance List </span></a>
                    </li>
                    <!-- <li class="sidebar-item"><a href="{{url('salary')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Salary </span></a></li>
              <li class="sidebar-item"><a href="{{url('county.home')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Country </span></a></li> -->
                </ul>
            </li>

            <li class="sidebar-item"><a href="{!! url('enter-subject-detail') !!}" class="sidebar-link"><i
                        class="fa fa-newspaper-o"></i><span class="hide-menu"> Assigned Subjects </span></a></li>
            <li class="sidebar-item"><a href="{!! url('studentsincharge') !!}" class="sidebar-link"><i
                        class="fa fa-users"></i><span class="hide-menu"> All Students </span></a></li>


            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-retweet"
                        aria-hidden="true"></i><span class="fa fa-chevron-down"></span> HomeWorks </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{!! url('send-class-homework') !!}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Create HomeWork </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{!! url('homework-list') !!}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> HomeWork List </span></a></li>
                    <!-- <li class="sidebar-item"><a href="{{url('salary')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Salary </span></a></li>
              <li class="sidebar-item"><a href="{{url('county.home')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Country </span></a></li> -->
                </ul>
            </li>

            <li class="sidebar-item"><a href="{!!  url('generate-teacher-timetable')  !!}" class="sidebar-link"><i
                        class="fa fa-table"></i><span class="hide-menu"> TimeTable </span></a></li>

            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-external-link"
                        aria-hidden="true"></i><span class="fa fa-chevron-down"></span> Exams </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{ url('mark/entry') }}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Enter Exam Marks </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{{ url('get/mark/list') }}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Mark List </span></a></li>
                    <!-- <li class="sidebar-item"><a href="{{url('salary')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Salary </span></a></li>
              <li class="sidebar-item"><a href="{{url('county.home')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Country </span></a></li> -->
                </ul>
            </li>

            @if (App\Models\ClassSchedule::count() > 0) {
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-fax" aria-hidden="true"></i><span
                        class="fa fa-chevron-down"></span> Results </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{ url('teacher/gradesheet') }}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Result Card </span></a></li>
                    <!-- <li class="sidebar-item"><a href="{{ url('get/mark/list') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Mark List </span></a></li>
              <li class="sidebar-item"><a href="{{url('salary')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Salary </span></a></li>
              <li class="sidebar-item"><a href="{{url('county.home')}}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Country </span></a></li> -->
                </ul>
            </li>
            @endif

            {{-- <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="fa fa-money" aria-hidden="true"></i><span
                        class="fa fa-chevron-down"></span> Salaries </a>
                <ul aria-expanded="false" class="nav child_menu">
                    <li class="sidebar-item"><a href="{{ route('teacherSalaries.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Teacher Salaries </span></a>
                    </li>
                    <li class="sidebar-item"><a href="{{ route('salaryTypes.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Salary Types </span></a></li>

                </ul>
            </li> --}}
        </ul>
    </div>
</div>

@endif