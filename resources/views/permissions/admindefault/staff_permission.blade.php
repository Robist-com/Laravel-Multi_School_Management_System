<div class="clear"></div><br>
  <form role="form" action="{{route('permissions.store')}}" method="post" enctype="multipart/form-data">
    @csrf
     <div class="form-group pull-right">
    <button type="submit" id="btnsave" class="btn btn-dark">Save Permission</button>
  </div>
    <span>Check all</span> <input type="checkbox" class="check" id="checkAll" name="permission_type" >
      <div class="row">
       @foreach ($permission_all->where('permission_group', 'admin') as $key => $item)
        <input type="hidden" name="admin" id="" value="admin">
        <input type="hidden" id="todo" name="permission_type[{{ $key }}]"  value="no">
       <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
          @if ($item->permission == 'school')
    <div class=" col-md-3" style="margin-bottom:5%">
    <table id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>School Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                {{-- @foreach ($permission_all->where('permission_group', 'admin') as $key => $item) --}}
                <tr>
                
                <td ><span class="fa fa-university"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td >
                    {{-- <input type="text" name="" id="" value="{{  $item->id }}"> --}}
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked @endif >
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>
  <br>
  @elseif($item->permission == 'student')
  <div class=" col-md-3 my-3">
      <table style="margin-bottom:5%" id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
            <thead id="permissionsHead">
            <tr class="doNotFilter">
              <th>Student Permission</th>
              <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
            </tr>
          </thead>
            <tbody id="permissionsBody">
                  <tr>
                  <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                  <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                    <td>
                    
                    <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                    <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                    <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                    <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                  </td>
                    </tr>
          </tbody>
      </table>
    </div>

    @elseif($item->permission == 'teacher')
  <div class=" col-md-3 my-3" style="margin-bottom:1%">
      <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
            <thead id="permissionsHead">
            <tr class="doNotFilter">
              <th>Teacher Permission</th>
              <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
            </tr>
          </thead>
            <tbody id="permissionsBody">
                  <tr>
                  <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                  <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                    <td>
                    
                    <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                    <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                    <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                    <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                  </td>
                    </tr>
          </tbody>
      </table>
    </div>

    @elseif($item->permission == 'student')
  <div class=" col-md-3 my-3" style="margin-bottom:1%">
      <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Student Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>
  
    @elseif($item->permission == 'attendance')
  <div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Attendance Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

      @elseif($item->permission == 'class')
  <div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Class Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

        @elseif($item->permission == 'classroom')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>ClassRoom Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

       @elseif($item->permission == 'level')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Level Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

        @elseif($item->permission == 'section')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Section Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>
@elseif($item->permission == 'subject')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Subject Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

          @elseif($item->permission == 'gpa')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Gpa Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

          @elseif($item->permission == 'exam')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Exams Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

  
          @elseif($item->permission == 'shift')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Shifts Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>
  
          @elseif($item->permission == 'day')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Days Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>
  
          @elseif($item->permission == 'grade')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Grades Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

            @elseif($item->permission == 'paper')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Papers Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>
            @elseif($item->permission == 'mark')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Marks Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>
            @elseif($item->permission == 'gradesheet')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Grade Sheet  Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

              @elseif($item->permission == 'class_of')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Class Off   Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

              @elseif($item->permission == 'holiday')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Holiday  Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

              @elseif($item->permission == 'report')
<div class=" col-md-3 my-3" style="margin-bottom:1%">
    <table  id="listFilterPermission" class="listFilterContainer permissionsTable" cellspacing="0" cellpadding="0">
          <thead id="permissionsHead">
          <tr class="doNotFilter">
            <th>Report Permission</th>
            <th><div id="view" class="permissionTag" data-perm="view"><span class="fa fa-key"></span></div></div></th>
          </tr>
        </thead>
          <tbody id="permissionsBody">
                <tr>
                <?php  $permission_name = str_replace('_', ' ', $item->permission_name); ?>
                <td ><span class="fa fa-graduation-cap"></span><span contenteditable="false" class="userName">{{ Str::ucfirst($permission_name)  }}</span></td>
                  <td>
                  
                  <input type="checkbox" class="check" id="todo" name="permission_type[{{ $key }}]" @if($item->permission_type == 'yes') checked  value="yes" @endif >
                  <input type="hidden" id="todo" name="permission[{{ $key }}]" value="{{ $item->permission }}">
                  <input type="hidden" id="todo" name="permission_group[{{ $key }}]" value="{{ $item->permission_group }}">
                  <input type="hidden" id="todo" name="permission_name[{{ $key }}]" value="{{ $item->permission_name }}">
                </td>
                  </tr>
        </tbody>
    </table>
  </div>

  @endif

  @endforeach
</div>
 <div class="form-group">
    <button type="submit" id="btnsave" class="btn btn-dark">Save Permission</button>
 </div>
  </form>
