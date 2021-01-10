{{-- <form action="{{ route('updateSchool', $school->id) }}" method="post"> --}}
  {{-- @method('put')
  @csrf --}}
  <div class="card">
  <div class="card-header"> Edit School Info</div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
        <label for="">School Name</label>
        <input type="text" name="name" value="{{ $school->name }}" class="form-control">
      </div>
      </div>
        <div class="col-md-6">
        <div class="form-group">
        <label for="">School Email</label>
        <input type="text" name="email" id="" value="{{ $school->email }}" class="form-control">
      </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
        <label for="">Owner name</label>
        <input type="text" readonly name="" id="" value="{{ auth()->user()->name }}" class="form-control">
      </div>
      </div>
       <div class="col-md-6">
        <div class="form-group">
        <label for="">Description</label>
        <textarea name="description" class="form-control" cols="30" rows="3">{{ $school->description }}</textarea>
      </div>
      </div>
      <div class="col-md-6">
      <div class="form-group" >
      <label>{{ $school->is_active == 1 ? "Is active" : 'Is not active' }}</label><br>
      <input disabled type="checkbox" name="is_active" value="1" {{ $school->is_active == 1 ? 'checked'  : ''}} class="flat">
      <input readonly type="hidden" name="is_active" id="" value="0" class="flat">
    </div>
    </div>
    {{-- <button class="btn btn-success btn-sm pull-right" > Update </button> --}}
    </div>
  </div>
</div>

{{-- </form> --}}