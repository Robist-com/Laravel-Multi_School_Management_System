<!-- Name Field -->
<div class="row">
<div class=" col-lg-6">
   <div class="input-group">
   <span class="input-group-addon">Full Name</span>
   {!! Form::text('name', null, ['class' => 'form-control']) !!} 
   </div>
   <br>
   </div>

<!-- Email Field -->
<div class=" col-lg-6">
<div class="input-group">
   <span class="input-group-addon">@Email</span>
    {!! Form::email('email', null, ['class' => 'form-control']) !!} 
</div>
<br>
</div>

<!-- Role Id Field -->
<div class=" col-lg-6">
<div class="input-group">
<span class="input-group-addon">Roles</span>
    <select name="role_id" id="role_id" class="form-control select_2_single">
    @foreach($roles as $key => $role)
    <option value="{{$role->role_id}}"> {{$role->name}}</option>
    @endforeach
    </select>
</div>
<br>
</div>

<!-- Password Field -->
<div class=" col-lg-6">
<div class="input-group">
   <span class="input-group-addon">Password</span>
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
</div>
</div>

@section('scripts')
<script>
 $(document).ready(function(){

    $('.js-switch').change(function () {
        let status = $(this).prop('checked') === true ? 1 : 0;
        let userId = $(this).data('id');
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ url('user/status/update') }}',
            data: {'status': status, 'user_id': userId},
            success: function (data) {
                console.log(data.message);
                // success: function (data) {
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
// }
            }
        });
    });
    // alert('roleId')
@foreach($users as $user)
$("#roleid{{$user->id}}").change(function () {
 var roleId = $("#roleid{{$user->id}}").val();
 var userid = $("#userid{{$user->id}}").val();
// alert(userid)

    $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ url('user/role/update') }}',
        data: {'role_id': roleId, 'user_id': userid},
        success: function (data) {
 
            console.log(data.message);
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);

            location.reload();
        }
    });
});
@endforeach
});
</script>
@endsection