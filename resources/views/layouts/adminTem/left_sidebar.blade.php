@if(Auth::user()->group == "Admin")
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
            <div class="email">john.doe@example.com</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li> <a id="logout_btn" href="#" data-confirm="Are you sure want to logout {{auth()->user()->name}} ?">
                    <i class="material-icons">input</i> Sign Out</a></li> 

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="index.html">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="pages/typography.html">
                    <i class="material-icons">text_fields</i>
                    <span>Typography</span>
                </a>
            </li>
            <li>
                <a href="pages/helper-classes.html">
                    <i class="material-icons">layers</i>
                    <span>Helper Classes</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">widgets</i>
                    <span>Widgets</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Cards</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/widgets/cards/basic.html">Basic</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/colored.html">Colored</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/no-header.html">No Header</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Infobox</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-2.html">Infobox-2</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-3.html">Infobox-3</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-4.html">Infobox-4</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-5.html">Infobox-5</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">swap_calls</i>
                    <span>User Interface (UI)</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/ui/alerts.html">Alerts</a>
                    </li>
                    <li>
                        <a href="pages/ui/animations.html">Animations</a>
                    </li>
                    <li>
                        <a href="pages/ui/badges.html">Badges</a>
                    </li>

                    <li>
                        <a href="pages/ui/breadcrumbs.html">Breadcrumbs</a>
                    </li>
                    <li>
                        <a href="pages/ui/buttons.html">Buttons</a>
                    </li>
                    <li>
                        <a href="pages/ui/collapse.html">Collapse</a>
                    </li>
                    <li>
                        <a href="pages/ui/colors.html">Colors</a>
                    </li>
                    <li>
                        <a href="pages/ui/dialogs.html">Dialogs</a>
                    </li>
                    <li>
                        <a href="pages/ui/icons.html">Icons</a>
                    </li>
                    <li>
                        <a href="pages/ui/labels.html">Labels</a>
                    </li>
                    <li>
                        <a href="pages/ui/list-group.html">List Group</a>
                    </li>
                    <li>
                        <a href="pages/ui/media-object.html">Media Object</a>
                    </li>
                    <li>
                        <a href="pages/ui/modals.html">Modals</a>
                    </li>
                    <li>
                        <a href="pages/ui/notifications.html">Notifications</a>
                    </li>
                    <li>
                        <a href="pages/ui/pagination.html">Pagination</a>
                    </li>
                    <li>
                        <a href="pages/ui/preloaders.html">Preloaders</a>
                    </li>
                    <li>
                        <a href="pages/ui/progressbars.html">Progress Bars</a>
                    </li>
                    <li>
                        <a href="pages/ui/range-sliders.html">Range Sliders</a>
                    </li>
                    <li>
                        <a href="pages/ui/sortable-nestable.html">Sortable & Nestable</a>
                    </li>
                    <li>
                        <a href="pages/ui/tabs.html">Tabs</a>
                    </li>
                    <li>
                        <a href="pages/ui/thumbnails.html">Thumbnails</a>
                    </li>
                    <li>
                        <a href="pages/ui/tooltips-popovers.html">Tooltips & Popovers</a>
                    </li>
                    <li>
                        <a href="pages/ui/waves.html">Waves</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Forms</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/forms/basic-form-elements.html">Basic Form Elements</a>
                    </li>
                    <li>
                        <a href="pages/forms/advanced-form-elements.html">Advanced Form Elements</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-examples.html">Form Examples</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-validation.html">Form Validation</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-wizard.html">Form Wizard</a>
                    </li>
                    <li>
                        <a href="pages/forms/editors.html">Editors</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">view_list</i>
                    <span>Tables</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/tables/normal-tables.html">Normal Tables</a>
                    </li>
                    <li>
                        <a href="pages/tables/jquery-datatable.html">Jquery Datatables</a>
                    </li>
                    <li>
                        <a href="pages/tables/editable-table.html">Editable Tables</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">perm_media</i>
                    <span>Medias</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/medias/image-gallery.html">Image Gallery</a>
                    </li>
                    <li>
                        <a href="pages/medias/carousel.html">Carousel</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">pie_chart</i>
                    <span>Charts</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/charts/morris.html">Morris</a>
                    </li>
                    <li>
                        <a href="pages/charts/flot.html">Flot</a>
                    </li>
                    <li>
                        <a href="pages/charts/chartjs.html">ChartJS</a>
                    </li>
                    <li>
                        <a href="pages/charts/sparkline.html">Sparkline</a>
                    </li>
                    <li>
                        <a href="pages/charts/jquery-knob.html">Jquery Knob</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">content_copy</i>
                    <span>Example Pages</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/examples/profile.html">Profile</a>
                    </li>
                    <li>
                        <a href="pages/examples/sign-in.html">Sign In</a>
                    </li>
                    <li>
                        <a href="pages/examples/sign-up.html">Sign Up</a>
                    </li>
                    <li>
                        <a href="pages/examples/forgot-password.html">Forgot Password</a>
                    </li>
                    <li>
                        <a href="pages/examples/blank.html">Blank Page</a>
                    </li>
                    <li>
                        <a href="pages/examples/404.html">404 - Not Found</a>
                    </li>
                    <li>
                        <a href="pages/examples/500.html">500 - Server Error</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">map</i>
                    <span>Maps</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/maps/google.html">Google Map</a>
                    </li>
                    <li>
                        <a href="pages/maps/yandex.html">YandexMap</a>
                    </li>
                    <li>
                        <a href="pages/maps/jvectormap.html">jVectorMap</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">trending_down</i>
                    <span>Multi Level Menu</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="javascript:void(0);">
                            <span>Menu Item</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span>Menu Item - 2</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Level - 2</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Level - 3</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Level - 4</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="pages/changelogs.html">
                    <i class="material-icons">update</i>
                    <span>Changelogs</span>
                </a>
            </li>
            <li class="header">LABELS</li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-red">donut_large</i>
                    <span>Important</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-amber">donut_large</i>
                    <span>Warning</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-light-blue">donut_large</i>
                    <span>Information</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
@endif

<!-- OWNER ACCESS -->
@if(Auth::user()->group == "Owner")
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
        @if(auth()->user()->group == "Admin")
        @foreach(App\Institute:: where('school_id' , null)->get() as $key => $institu)
        @if(auth()->user()->image != '')
        <img src="{{ asset('admin_images/' .auth()->user()->image) }}" alt="..."
            class="img-circle profile_img"  width="48" height="48" alt="User">
        @else
        <img src="{{ asset('institute_logo/' .$institu->image) }}" alt="..."
            class="img-circle profile_img"  width="48" height="48" alt="User">
        @endif
        @endforeach
        @else
        @foreach(App\Institute:: where('school_id' , auth()->user()->school->id)->get() as $key =>
        $inst)
        @if(auth()->user()->image != '')
        <img src="{{ asset('admin_images/' .auth()->user()->image) }}" alt="..."
            class="img-circle profile_img"  width="48" height="48" alt="User">
        @else
        <img src="{{ asset('institute_logo/' .$inst->image) }}" alt="..."
            class="img-circle profile_img"  width="48" height="48" alt="User">
        @endif
        @endforeach
        @endif
        </div>
           <?php  ?>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name}}</div>
            <div class="email">{{ Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li> <a id="logout_btn" href="#" data-confirm="Are you sure want to logout {{auth()->user()->name}} ?">
                    <i class="material-icons">input</i> Sign Out</a></li> 

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="{{url('/home')}}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">work</i>
                    <span>Front Office</span>
                </a>
                <ul class="ml-menu">
                    <li><a href="form.html">Front Office</a></li>
                    <li><a href="form_advanced.html">Admission Enquiry</a></li>
                    <li><a href="{{route('contact_us.index')}}">Complain</a></li>
                    <li><a href="form_wizards.html">Setup Front Office</a></li>
                    <li><a href="form_upload.html">Form Upload</a></li>
                    <li><a href="form_buttons.html">Form Buttons</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">school</i>
                    <span>Academics</span>
                </a>
                <ul class="ml-menu">
                    @if(in_array('class_add',$permision))
                    <li ><a href="{{route('classes.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Classes </span></a></li>
                    @endif
                    {{-- @if(in_array('batch_add',$permision))--}}
                    <li ><a href="{{route('batches.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Session </span></a></li>
                    {{-- @endif  --}}

                    @if(in_array('subject_add',$permision))
                    <li ><a href="{{route('courses.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Subject </span></a></li>
                    @endif

                    @if(in_array('level_add',$permision))
                    <li ><a href="{{route('levels.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Level </span></a></li>
                    @endif

                    @if(in_array('day_add',$permision))
                    <li ><a href="{{route('days.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Days </span></a></li>
                    @endif

                    @if(in_array('shift_add',$permision))
                    <li ><a href="{{route('shifts.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Shifts </span></a></li>
                    @endif

                    @if(in_array('class_add',$permision))
                    <li ><a href="{{route('times.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Times </span></a></li>
                    @endif
                    @if(in_array('classroom_add',$permision))
                    <li ><a href="{{route('classRooms.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Rooms </span></a></li>
                    @endif

                    @if(in_array('class_add',$permision))
                    <li ><a href="{{route('academics.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Academics </span></a></li>
                    @endif
                    @if(in_array('grade_add',$permision))
                    <li ><a href="{{route('semesters.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Grade </span></a></li>
                    @endif
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">person_add</i>
                    <span>Student Information</span>
                </a>
                <ul class="ml-menu">
                <li ><a href="{{url('all/student/list')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Student list</span></a></li>
                    <li ><a href="{{route('admissions.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Admissions</span></a></li>
                    <li ><a href="{{route('OnlineAdmissions')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Online Admission</span></a>
                    </li>
                </ul>
            </li>

            <li> 

                    <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">payments</i>
                    <span>Fee Collection</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{url('view/fee/collection')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Collect Fee </span></a></li>
                    <li ><a href="{{ url('student/list/fee/collection') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Class Wise Fee Collect
                            </span></a></li>
                    <li ><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Search Fee Payment </span></a>
                    </li>
                    <li ><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Structutre </span></a></li>
                    <li ><a href="{{route('feetypes.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Type </span></a></li>
                    <li ><a href="{{route('days.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Discount </span></a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">person_add</i>
                    <span>Teachers Information</span>
                </a>
                <ul class="ml-menu">
                <li ><a href="{{url('all/student/list')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Student list</span></a></li>
                    <li ><a href="{{route('admissions.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Admissions</span></a></li>
                    <li ><a href="{{route('OnlineAdmissions')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Online Admission</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">person_add</i>
                    <span>Staff Information</span>
                </a>
                <ul class="ml-menu">
                <li ><a href="{{url('all/student/list')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Student list</span></a></li>
                    <li ><a href="{{route('admissions.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Admissions</span></a></li>
                    <li ><a href="{{route('OnlineAdmissions')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Online Admission</span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{route('roles.index')}}">
                    <i class="material-icons">monetization_on</i>
                    <span>Salary</span>
                </a>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">groups</i>
                    <span>Groups</span>
                </a>
                <ul class="ml-menu">
                <li ><a href="{{route('faculties.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Student Group </span></a></li>
                    <li ><a href="{{route('departments.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Class Group</span></a></li>
                </ul>
            </li>

            <li>
                <a href="{{route('roles.index')}}">
                    <i class="material-icons">vpn_key</i>
                    <span>Role</span>
                </a>
            </li>

            <li>
                <a href="{{route('permissions.index')}}">
                    <i class="material-icons">lock_open</i>
                    <span>Permissions</span>
                </a>
            </li>

            @if(in_array('school_view',$permision) || in_array('school_add',$permision) ||
            in_array('school_update',$permision) || in_array('school_delete',$permision))

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">business</i>
                    <span>School</span>
                </a>
                <ul class="ml-menu">
                    @if(in_array('school_view',$permision))
                    <li ><a href="{{ route('school.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Manage School </span></a></li>
                    @endif
                    @if(in_array('school_delete',$permision))
                    <li ><a href="{{ url('manage') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Structutre </span></a></li>
                    @endif
                </ul>
            </li>
            @endif

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">event_available</i>
                    <span>Attendance</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{!! route('attendances.index') !!}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Take Attendance </span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">schedule</i>
                    <span>Schedule</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{route('classSchedules.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Class Schedules </span></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">attach_money</i>
                    <span>Income</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{route('income.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Income </span></a></li>
                    <li ><a href="{{route('incometype.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Income Types </span></a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">credit_card</i>
                    <span>Expenses</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{route('expenses.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Expense </span></a></li>
                    <li ><a href="{{route('expensestype.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Expense Type </span></a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">library_books</i>
                    <span>Library</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{route('book.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Book List </span></a></li>
                    <li ><a href="{{route('librarymember.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Issue Return </span></a></li>
                    <li ><a href="{{url('add/librarymember')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Member </span></a></li>
                    <!-- <li ><a href="{{url('add/staff/member')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Staff Member </span></a></li> -->
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">store</i>
                    <span>Inventory</span>
                </a>
                <ul class="ml-menu">
                <li ><a href="{{url('issue/item')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Issue Item </span></a></li>
                    <li ><a href="{{url('add/item/stock')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Item Stock</span></a></li>
                    <li ><a href="{{url('add/item')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Item </span></a></li>
                    <li ><a href="{{url('item/category')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Item Category </span></a></li>
                    <li ><a href="{{url('item/store')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Item Store </span></a></li>
                    <li ><a href="{{url('item/supplier')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Item Supplier </span></a></li>
                    <!-- <li ><a href="{{url('add/staff/member')}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Add Staff Member </span></a></li> -->
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">leaderboard</i>
                    <span>Reports</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{ route('Reports') }}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> All Reports </span></a></li>
                    <li ><a href="{{ route('getstudentInormation') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Student Reports </span></a></li>
                    <li ><a href="{{ route('Finance') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Finance Reports </span></a></li>
                    <!-- <li ><a href="{{ route('getFeeReport') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Finance Reports </span></a></li> -->
                    <li ><a href="{{ route('feeStructures.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Search Fee Payment </span></a>
                    </li>
                    <li ><a href="{{ route('studentFees.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Structutre </span></a></li>
                    <li ><a href="{{route('levels.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> User Log </span></a></li>
                    <li ><a href="{{route('days.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Fee Discount </span></a></li>
                    <li ><a href="{{route('shifts.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Human Resources </span></a></li>
                    <li ><a href="{{route('times.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Examination </span></a></li>
                    <li ><a href="{{route('times.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Online Examination </span></a>
                    </li>
                    <li ><a href="{{route('AttendaceReport')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Attendance </span></a></li>
                    <li ><a href="{{route('academics.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Academics </span></a></li>
                    <li ><a href="{{route('semesters.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Grade </span></a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">flip_to_front</i>
                    <span>Front CMS</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{ route('event.create') }}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> School Event </span></a></li>
                    <li ><a href="{{ route('getFeeReport') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Gallary </span></a></li>
                    <li ><a href="{{ route('news.create') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> News </span></a></li>
                    <li > <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{route('media.index')}}" aria-expanded="false"><span class="hide-menu">Media Manager</span></a></li>
                    <li ><a href="{{ route('studentFees.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Pages </span></a></li>
                    <li ><a href="{{route('levels.index')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Menu </span></a></li>
                    <li ><a href="{{route('banner.create')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Banner Menu </span></a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">star</i>
                    <span>Certificates</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{ route('design_certiifcate.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Design Certificates </span></a>
                    </li>
                    <li ><a href="{{ url('generate/certificate') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Generate Certificate </span></a>
                    </li>
                    <li ><a href="{{ route('design_certificates.list') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Certificates List</span></a></li>
                    <li ><a href="{{ route('student_idCard.index') }}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Design ID Card </span></a></li>
                    <li ><a href="{{url('generate/id_card')}}" class="sidebar-link"><i
                                class="mdi mdi-note-plus"></i><span class="hide-menu"> Generate ID Card </span></a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">pages</i>
                    <span>Exam Management</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{url('exam/create')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Create Exam </span></a></li>
                    <li ><a href="{{url('exam/list')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Exam List</span></a></li>

                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">web_asset</i>
                    <span>Exam Questions</span>
                </a>
                <ul class="ml-menu">
                    <li ><a href="{{url('exam/create')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Create Exam </span></a></li>
                    <li ><a href="{{url('exam/list')}}" class="sidebar-link"><i
                                class="mdi mdi-note-outline"></i><span class="hide-menu"> Exam List</span></a></li>

                </ul>
            </li>


            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-light-blue">cloud_download</i>
                    <span>Download Center</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; {{$template->establish}}<a href="javascript:void(0);">{{$template->name}}</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
@endif


<!-- TEACHERS ACCESS -->
@if(Auth::user()->group == 'Teacher')
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
            <div class="email">john.doe@example.com</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li> <a id="logout_btn" href="#" data-confirm="Are you sure want to logout {{auth()->user()->name}} ?">
                    <i class="material-icons">input</i> Sign Out </a></li> 

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="{{url('/home')}}">
                    <i class="material-icons">home 1</i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">event</i>
                    <span>dashboard2</span>
                </a>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">event</i>
                    <span>Attendance</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{!! url('mark-teacher-attendance') !!}" class="menu-toggle">
                            <span>Take Attendance</span>
                        </a>
                    </li>
                    <li>
                        <a href="{!! url('attendance/list') !!}" class="menu-toggle">
                            <span>Attendance List</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{!! url('enter-subject-detail') !!}">
                    <i class="material-icons">update</i>
                    <span>Assigned Subjects</span>
                </a>
            </li>

            <li>
                <a href="{!! url('studentsincharge') !!}">
                    <i class="material-icons">update</i>
                    <span>All Students</span>
                </a>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">swap_calls</i>
                    <span>HomeWorks</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{!! url('send-class-homework') !!}">Create HomeWork</a>
                    </li>
                    <li>
                        <a href="{!! url('homework-list') !!}">HomeWork List</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Exams</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="{{ url('mark/entry') }}">Enter Exam Marks</a>
                    </li>
                    <li>
                        <a href="{{ url('get/mark/list') }}">Mark List</a>
                    </li>
                   
                </ul>
            </li>

            <li>
                <a href="{!!  url('generate-teacher-timetable')  !!}">
                    <i class="material-icons">update</i>
                    <span>TimeTable</span>
                </a>
            </li>

            <li>
                <a href="{{ url('teacher/gradesheet') }}">
                    <i class="material-icons">update</i>
                    <span>Results</span>
                </a>
            </li>

            <li>
                <a href="{{ route('teacherSalaries.index') }}">
                    <i class="material-icons">update</i>
                    <span>Salary</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
@endif

<!-- ACCOUNTANT ACCESS -->
@if(Auth::user()->group == "Accountant")
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
            <div class="email">john.doe@example.com</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li> <a id="logout_btn" href="#" data-confirm="Are you sure want to logout {{auth()->user()->name}} ?">
                    <i class="material-icons">input</i> Sign Out</a></li> 

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="index.html">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="pages/typography.html">
                    <i class="material-icons">text_fields</i>
                    <span>Typography</span>
                </a>
            </li>
            <li>
                <a href="pages/helper-classes.html">
                    <i class="material-icons">layers</i>
                    <span>Helper Classes</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">widgets</i>
                    <span>Widgets</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Cards</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/widgets/cards/basic.html">Basic</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/colored.html">Colored</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/no-header.html">No Header</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Infobox</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-2.html">Infobox-2</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-3.html">Infobox-3</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-4.html">Infobox-4</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-5.html">Infobox-5</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">swap_calls</i>
                    <span>User Interface (UI)</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/ui/alerts.html">Alerts</a>
                    </li>
                    <li>
                        <a href="pages/ui/animations.html">Animations</a>
                    </li>
                    <li>
                        <a href="pages/ui/badges.html">Badges</a>
                    </li>

                    <li>
                        <a href="pages/ui/breadcrumbs.html">Breadcrumbs</a>
                    </li>
                    <li>
                        <a href="pages/ui/buttons.html">Buttons</a>
                    </li>
                    <li>
                        <a href="pages/ui/collapse.html">Collapse</a>
                    </li>
                    <li>
                        <a href="pages/ui/colors.html">Colors</a>
                    </li>
                    <li>
                        <a href="pages/ui/dialogs.html">Dialogs</a>
                    </li>
                    <li>
                        <a href="pages/ui/icons.html">Icons</a>
                    </li>
                    <li>
                        <a href="pages/ui/labels.html">Labels</a>
                    </li>
                    <li>
                        <a href="pages/ui/list-group.html">List Group</a>
                    </li>
                    <li>
                        <a href="pages/ui/media-object.html">Media Object</a>
                    </li>
                    <li>
                        <a href="pages/ui/modals.html">Modals</a>
                    </li>
                    <li>
                        <a href="pages/ui/notifications.html">Notifications</a>
                    </li>
                    <li>
                        <a href="pages/ui/pagination.html">Pagination</a>
                    </li>
                    <li>
                        <a href="pages/ui/preloaders.html">Preloaders</a>
                    </li>
                    <li>
                        <a href="pages/ui/progressbars.html">Progress Bars</a>
                    </li>
                    <li>
                        <a href="pages/ui/range-sliders.html">Range Sliders</a>
                    </li>
                    <li>
                        <a href="pages/ui/sortable-nestable.html">Sortable & Nestable</a>
                    </li>
                    <li>
                        <a href="pages/ui/tabs.html">Tabs</a>
                    </li>
                    <li>
                        <a href="pages/ui/thumbnails.html">Thumbnails</a>
                    </li>
                    <li>
                        <a href="pages/ui/tooltips-popovers.html">Tooltips & Popovers</a>
                    </li>
                    <li>
                        <a href="pages/ui/waves.html">Waves</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Forms</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/forms/basic-form-elements.html">Basic Form Elements</a>
                    </li>
                    <li>
                        <a href="pages/forms/advanced-form-elements.html">Advanced Form Elements</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-examples.html">Form Examples</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-validation.html">Form Validation</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-wizard.html">Form Wizard</a>
                    </li>
                    <li>
                        <a href="pages/forms/editors.html">Editors</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">view_list</i>
                    <span>Tables</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/tables/normal-tables.html">Normal Tables</a>
                    </li>
                    <li>
                        <a href="pages/tables/jquery-datatable.html">Jquery Datatables</a>
                    </li>
                    <li>
                        <a href="pages/tables/editable-table.html">Editable Tables</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">perm_media</i>
                    <span>Medias</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/medias/image-gallery.html">Image Gallery</a>
                    </li>
                    <li>
                        <a href="pages/medias/carousel.html">Carousel</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">pie_chart</i>
                    <span>Charts</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/charts/morris.html">Morris</a>
                    </li>
                    <li>
                        <a href="pages/charts/flot.html">Flot</a>
                    </li>
                    <li>
                        <a href="pages/charts/chartjs.html">ChartJS</a>
                    </li>
                    <li>
                        <a href="pages/charts/sparkline.html">Sparkline</a>
                    </li>
                    <li>
                        <a href="pages/charts/jquery-knob.html">Jquery Knob</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">content_copy</i>
                    <span>Example Pages</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/examples/profile.html">Profile</a>
                    </li>
                    <li>
                        <a href="pages/examples/sign-in.html">Sign In</a>
                    </li>
                    <li>
                        <a href="pages/examples/sign-up.html">Sign Up</a>
                    </li>
                    <li>
                        <a href="pages/examples/forgot-password.html">Forgot Password</a>
                    </li>
                    <li>
                        <a href="pages/examples/blank.html">Blank Page</a>
                    </li>
                    <li>
                        <a href="pages/examples/404.html">404 - Not Found</a>
                    </li>
                    <li>
                        <a href="pages/examples/500.html">500 - Server Error</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">map</i>
                    <span>Maps</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/maps/google.html">Google Map</a>
                    </li>
                    <li>
                        <a href="pages/maps/yandex.html">YandexMap</a>
                    </li>
                    <li>
                        <a href="pages/maps/jvectormap.html">jVectorMap</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">trending_down</i>
                    <span>Multi Level Menu</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="javascript:void(0);">
                            <span>Menu Item</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span>Menu Item - 2</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Level - 2</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Level - 3</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Level - 4</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="pages/changelogs.html">
                    <i class="material-icons">update</i>
                    <span>Changelogs</span>
                </a>
            </li>
            <li class="header">LABELS</li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-red">donut_large</i>
                    <span>Important</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-amber">donut_large</i>
                    <span>Warning</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-light-blue">donut_large</i>
                    <span>Information</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
@endif


<!-- LIBRAIAN ACCESS -->
@if(Auth::user()->group == 'Librian')
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
            <div class="email">john.doe@example.com</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li> <a id="logout_btn" href="#" data-confirm="Are you sure want to logout {{auth()->user()->name}} ?">
                    <i class="material-icons">input</i> Sign Out</a></li> 
                    
                    
                    <!-- <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">input</i></a></li> -->
                </ul>
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="index.html">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="pages/typography.html">
                    <i class="material-icons">text_fields</i>
                    <span>Typography</span>
                </a>
            </li>
            <li>
                <a href="pages/helper-classes.html">
                    <i class="material-icons">layers</i>
                    <span>Helper Classes</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">widgets</i>
                    <span>Widgets</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Cards</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/widgets/cards/basic.html">Basic</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/colored.html">Colored</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/no-header.html">No Header</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Infobox</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-2.html">Infobox-2</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-3.html">Infobox-3</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-4.html">Infobox-4</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-5.html">Infobox-5</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">swap_calls</i>
                    <span>User Interface (UI)</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/ui/alerts.html">Alerts</a>
                    </li>
                    <li>
                        <a href="pages/ui/animations.html">Animations</a>
                    </li>
                    <li>
                        <a href="pages/ui/badges.html">Badges</a>
                    </li>

                    <li>
                        <a href="pages/ui/breadcrumbs.html">Breadcrumbs</a>
                    </li>
                    <li>
                        <a href="pages/ui/buttons.html">Buttons</a>
                    </li>
                    <li>
                        <a href="pages/ui/collapse.html">Collapse</a>
                    </li>
                    <li>
                        <a href="pages/ui/colors.html">Colors</a>
                    </li>
                    <li>
                        <a href="pages/ui/dialogs.html">Dialogs</a>
                    </li>
                    <li>
                        <a href="pages/ui/icons.html">Icons</a>
                    </li>
                    <li>
                        <a href="pages/ui/labels.html">Labels</a>
                    </li>
                    <li>
                        <a href="pages/ui/list-group.html">List Group</a>
                    </li>
                    <li>
                        <a href="pages/ui/media-object.html">Media Object</a>
                    </li>
                    <li>
                        <a href="pages/ui/modals.html">Modals</a>
                    </li>
                    <li>
                        <a href="pages/ui/notifications.html">Notifications</a>
                    </li>
                    <li>
                        <a href="pages/ui/pagination.html">Pagination</a>
                    </li>
                    <li>
                        <a href="pages/ui/preloaders.html">Preloaders</a>
                    </li>
                    <li>
                        <a href="pages/ui/progressbars.html">Progress Bars</a>
                    </li>
                    <li>
                        <a href="pages/ui/range-sliders.html">Range Sliders</a>
                    </li>
                    <li>
                        <a href="pages/ui/sortable-nestable.html">Sortable & Nestable</a>
                    </li>
                    <li>
                        <a href="pages/ui/tabs.html">Tabs</a>
                    </li>
                    <li>
                        <a href="pages/ui/thumbnails.html">Thumbnails</a>
                    </li>
                    <li>
                        <a href="pages/ui/tooltips-popovers.html">Tooltips & Popovers</a>
                    </li>
                    <li>
                        <a href="pages/ui/waves.html">Waves</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Forms</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/forms/basic-form-elements.html">Basic Form Elements</a>
                    </li>
                    <li>
                        <a href="pages/forms/advanced-form-elements.html">Advanced Form Elements</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-examples.html">Form Examples</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-validation.html">Form Validation</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-wizard.html">Form Wizard</a>
                    </li>
                    <li>
                        <a href="pages/forms/editors.html">Editors</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">view_list</i>
                    <span>Tables</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/tables/normal-tables.html">Normal Tables</a>
                    </li>
                    <li>
                        <a href="pages/tables/jquery-datatable.html">Jquery Datatables</a>
                    </li>
                    <li>
                        <a href="pages/tables/editable-table.html">Editable Tables</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">perm_media</i>
                    <span>Medias</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/medias/image-gallery.html">Image Gallery</a>
                    </li>
                    <li>
                        <a href="pages/medias/carousel.html">Carousel</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">pie_chart</i>
                    <span>Charts</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/charts/morris.html">Morris</a>
                    </li>
                    <li>
                        <a href="pages/charts/flot.html">Flot</a>
                    </li>
                    <li>
                        <a href="pages/charts/chartjs.html">ChartJS</a>
                    </li>
                    <li>
                        <a href="pages/charts/sparkline.html">Sparkline</a>
                    </li>
                    <li>
                        <a href="pages/charts/jquery-knob.html">Jquery Knob</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">content_copy</i>
                    <span>Example Pages</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/examples/profile.html">Profile</a>
                    </li>
                    <li>
                        <a href="pages/examples/sign-in.html">Sign In</a>
                    </li>
                    <li>
                        <a href="pages/examples/sign-up.html">Sign Up</a>
                    </li>
                    <li>
                        <a href="pages/examples/forgot-password.html">Forgot Password</a>
                    </li>
                    <li>
                        <a href="pages/examples/blank.html">Blank Page</a>
                    </li>
                    <li>
                        <a href="pages/examples/404.html">404 - Not Found</a>
                    </li>
                    <li>
                        <a href="pages/examples/500.html">500 - Server Error</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">map</i>
                    <span>Maps</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/maps/google.html">Google Map</a>
                    </li>
                    <li>
                        <a href="pages/maps/yandex.html">YandexMap</a>
                    </li>
                    <li>
                        <a href="pages/maps/jvectormap.html">jVectorMap</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">trending_down</i>
                    <span>Multi Level Menu</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="javascript:void(0);">
                            <span>Menu Item</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span>Menu Item - 2</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Level - 2</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Level - 3</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Level - 4</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="pages/changelogs.html">
                    <i class="material-icons">update</i>
                    <span>Changelogs</span>
                </a>
            </li>
            <li class="header">LABELS</li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-red">donut_large</i>
                    <span>Important</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-amber">donut_large</i>
                    <span>Warning</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-light-blue">donut_large</i>
                    <span>Information</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
@endif

<!-- RECEPTIONIST ACCESS -->
@if(Auth::user()->group == "Receptionist")
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="images/user.png" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">John Doe</div>
            <div class="email">john.doe@example.com</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li> <a id="logout_btn" href="#" data-confirm="Are you sure want to logout {{auth()->user()->name}} ?">
                    <i class="material-icons">input</i> Sign Out</a></li> 

                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    @csrf
                </form>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="index.html">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <li>
                <a href="pages/typography.html">
                    <i class="material-icons">text_fields</i>
                    <span>Typography</span>
                </a>
            </li>
            <li>
                <a href="pages/helper-classes.html">
                    <i class="material-icons">layers</i>
                    <span>Helper Classes</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">widgets</i>
                    <span>Widgets</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Cards</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/widgets/cards/basic.html">Basic</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/colored.html">Colored</a>
                            </li>
                            <li>
                                <a href="pages/widgets/cards/no-header.html">No Header</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Infobox</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-2.html">Infobox-2</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-3.html">Infobox-3</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-4.html">Infobox-4</a>
                            </li>
                            <li>
                                <a href="pages/widgets/infobox/infobox-5.html">Infobox-5</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">swap_calls</i>
                    <span>User Interface (UI)</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/ui/alerts.html">Alerts</a>
                    </li>
                    <li>
                        <a href="pages/ui/animations.html">Animations</a>
                    </li>
                    <li>
                        <a href="pages/ui/badges.html">Badges</a>
                    </li>

                    <li>
                        <a href="pages/ui/breadcrumbs.html">Breadcrumbs</a>
                    </li>
                    <li>
                        <a href="pages/ui/buttons.html">Buttons</a>
                    </li>
                    <li>
                        <a href="pages/ui/collapse.html">Collapse</a>
                    </li>
                    <li>
                        <a href="pages/ui/colors.html">Colors</a>
                    </li>
                    <li>
                        <a href="pages/ui/dialogs.html">Dialogs</a>
                    </li>
                    <li>
                        <a href="pages/ui/icons.html">Icons</a>
                    </li>
                    <li>
                        <a href="pages/ui/labels.html">Labels</a>
                    </li>
                    <li>
                        <a href="pages/ui/list-group.html">List Group</a>
                    </li>
                    <li>
                        <a href="pages/ui/media-object.html">Media Object</a>
                    </li>
                    <li>
                        <a href="pages/ui/modals.html">Modals</a>
                    </li>
                    <li>
                        <a href="pages/ui/notifications.html">Notifications</a>
                    </li>
                    <li>
                        <a href="pages/ui/pagination.html">Pagination</a>
                    </li>
                    <li>
                        <a href="pages/ui/preloaders.html">Preloaders</a>
                    </li>
                    <li>
                        <a href="pages/ui/progressbars.html">Progress Bars</a>
                    </li>
                    <li>
                        <a href="pages/ui/range-sliders.html">Range Sliders</a>
                    </li>
                    <li>
                        <a href="pages/ui/sortable-nestable.html">Sortable & Nestable</a>
                    </li>
                    <li>
                        <a href="pages/ui/tabs.html">Tabs</a>
                    </li>
                    <li>
                        <a href="pages/ui/thumbnails.html">Thumbnails</a>
                    </li>
                    <li>
                        <a href="pages/ui/tooltips-popovers.html">Tooltips & Popovers</a>
                    </li>
                    <li>
                        <a href="pages/ui/waves.html">Waves</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">assignment</i>
                    <span>Forms</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/forms/basic-form-elements.html">Basic Form Elements</a>
                    </li>
                    <li>
                        <a href="pages/forms/advanced-form-elements.html">Advanced Form Elements</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-examples.html">Form Examples</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-validation.html">Form Validation</a>
                    </li>
                    <li>
                        <a href="pages/forms/form-wizard.html">Form Wizard</a>
                    </li>
                    <li>
                        <a href="pages/forms/editors.html">Editors</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">view_list</i>
                    <span>Tables</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/tables/normal-tables.html">Normal Tables</a>
                    </li>
                    <li>
                        <a href="pages/tables/jquery-datatable.html">Jquery Datatables</a>
                    </li>
                    <li>
                        <a href="pages/tables/editable-table.html">Editable Tables</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">perm_media</i>
                    <span>Medias</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/medias/image-gallery.html">Image Gallery</a>
                    </li>
                    <li>
                        <a href="pages/medias/carousel.html">Carousel</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">pie_chart</i>
                    <span>Charts</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/charts/morris.html">Morris</a>
                    </li>
                    <li>
                        <a href="pages/charts/flot.html">Flot</a>
                    </li>
                    <li>
                        <a href="pages/charts/chartjs.html">ChartJS</a>
                    </li>
                    <li>
                        <a href="pages/charts/sparkline.html">Sparkline</a>
                    </li>
                    <li>
                        <a href="pages/charts/jquery-knob.html">Jquery Knob</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">content_copy</i>
                    <span>Example Pages</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/examples/profile.html">Profile</a>
                    </li>
                    <li>
                        <a href="pages/examples/sign-in.html">Sign In</a>
                    </li>
                    <li>
                        <a href="pages/examples/sign-up.html">Sign Up</a>
                    </li>
                    <li>
                        <a href="pages/examples/forgot-password.html">Forgot Password</a>
                    </li>
                    <li>
                        <a href="pages/examples/blank.html">Blank Page</a>
                    </li>
                    <li>
                        <a href="pages/examples/404.html">404 - Not Found</a>
                    </li>
                    <li>
                        <a href="pages/examples/500.html">500 - Server Error</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">map</i>
                    <span>Maps</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="pages/maps/google.html">Google Map</a>
                    </li>
                    <li>
                        <a href="pages/maps/yandex.html">YandexMap</a>
                    </li>
                    <li>
                        <a href="pages/maps/jvectormap.html">jVectorMap</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle">
                    <i class="material-icons">trending_down</i>
                    <span>Multi Level Menu</span>
                </a>
                <ul class="ml-menu">
                    <li>
                        <a href="javascript:void(0);">
                            <span>Menu Item</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <span>Menu Item - 2</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <span>Level - 2</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Menu Item</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Level - 3</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span>Level - 4</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="pages/changelogs.html">
                    <i class="material-icons">update</i>
                    <span>Changelogs</span>
                </a>
            </li>
            <li class="header">LABELS</li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-red">donut_large</i>
                    <span>Important</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-amber">donut_large</i>
                    <span>Warning</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="material-icons col-light-blue">donut_large</i>
                    <span>Information</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
@endif

@section('js')

<script>
$(document).ready(function(){
    // alert(1)
})
</script>

@stop