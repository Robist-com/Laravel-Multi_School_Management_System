<div class="top_nav">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="{{ asset('/uploads/gallery/' .Auth::user()->image) }}" alt="">{{ Auth::user()->first_name. ' '.Auth::user()->last_name }}
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <li><a href="{{route('profile')}}"> Profile</a></li>
              <li>
                <a href="javascript:;">
                  <span class="badge bg-red pull-right">50%</span>
                  <span>Settings</span>
                </a>
              </li>
              <li><a href="javascript:;">Help</a></li>
              <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
            </ul>
          </li>
          <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
            @csrf
        </form>

          <li role="presentation" class="dropdown">
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-envelope-o"></i>
              <span class="badge bg-green">6</span>
            </a>
            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
              <li>
                <a>
                  <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                  <span>
                    <span>John Smith</span>
                    <span class="time">3 mins ago</span>
                  </span>
                  <span class="message">
                    Film festivals used to be do-or-die moments for movie makers. They were where...
                  </span>
                </a>
              </li>
              <li>
                <a>
                  <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                  <span>
                    <span>John Smith</span>
                    <span class="time">3 mins ago</span>
                  </span>
                  <span class="message">
                    Film festivals used to be do-or-die moments for movie makers. They were where...
                  </span>
                </a>
              </li>
              <li>
                <a>
                  <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                  <span>
                    <span>John Smith</span>
                    <span class="time">3 mins ago</span>
                  </span>
                  <span class="message">
                    Film festivals used to be do-or-die moments for movie makers. They were where...
                  </span>
                </a>
              </li>
              <li>
                <a>
                  <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                  <span>
                    <span>John Smith</span>
                    <span class="time">3 mins ago</span>
                  </span>
                  <span class="message">
                    Film festivals used to be do-or-die moments for movie makers. They were where...
                  </span>
                </a>
              </li>
              <li>
                <div class="text-center">
                  <a>
                    <strong>See All Alerts</strong>
                    <i class="fa fa-angle-right"></i>
                  </a>
                </div>
              </li>
            </ul>
          </li>

          <li class="dropdown language">
          <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#">
            <?php $value = config('lang.locale'); ?>
              <img src="{{ asset('ev-assets/backend/img/flags/'.$value.'.png') }}" alt="" width='18' height='13' alt="">
              <!-- <span class="username">English US</span> -->
              <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
              <li><a href="{{ url('admin/language/ar') }}"><img src="{{ asset('ev-assets/backend/img/flags/ar.png') }}" width='18' height='13' alt=""> Arabic</a></li>
              <li><a href="{{ url('admin/language/bl') }}"><img src="{{ asset('ev-assets/backend/img/flags/bl.png') }}" width='18' height='13' alt=""> Bengali</a></li>
              <li><a href="{{ url('admin/language/ch') }}"><img src="{{ asset('ev-assets/backend/img/flags/ch.png') }}" width='18' height='13' alt=""> Chinese</a></li>
              <li><a href="{{ url('admin/language/en') }}"><img src="{{ asset('ev-assets/backend/img/flags/en.png') }}" alt=""> English US</a></li>
              <li><a href="{{ url('admin/language/fr') }}"><img src="{{ asset('ev-assets/backend/img/flags/fr.png') }}" alt=""> French</a></li>
              <li><a href="{{ url('admin/language/de') }}"><img src="{{ asset('ev-assets/backend/img/flags/de.png') }}" alt=""> German</a></li>
              <li><a href="{{ url('admin/language/hi') }}"><img src="{{ asset('ev-assets/backend/img/flags/hi.png') }}" width='18' height='13' alt=""> Hindi</a></li>
              <li><a href="{{ url('admin/language/id') }}"><img src="{{ asset('ev-assets/backend/img/flags/id.png') }}" width='18' height='13' alt=""> Indonesian</a></li>
              <li><a href="{{ url('admin/language/it') }}"><img src="{{ asset('ev-assets/backend/img/flags/it.png') }}" width='18' height='13' alt=""> Italian</a></li>
              <li><a href="{{ url('admin/language/ro') }}"><img src="{{ asset('ev-assets/backend/img/flags/ro.png') }}" width='18' height='13' alt=""> Romanian</a></li>
              <li><a href="{{ url('admin/language/ru') }}"><img src="{{ asset('ev-assets/backend/img/flags/ru.png') }}" alt=""> Russian</a></li>
              <li><a href="{{ url('admin/language/es') }}"><img src="{{ asset('ev-assets/backend/img/flags/es.png') }}" alt=""> Spanish</a></li>
              <li><a href="{{ url('admin/language/th') }}"><img src="{{ asset('ev-assets/backend/img/flags/th.png') }}" width='18' height='13' alt=""> Thai</a></li>
              <li><a href="{{ url('admin/language/tk') }}"><img src="{{ asset('ev-assets/backend/img/flags/tk.png') }}" width='18' height='13' alt=""> Turkish</a></li>
           
          </ul>
      </li>

    </ul>
      </nav>
    </div>
  </div>