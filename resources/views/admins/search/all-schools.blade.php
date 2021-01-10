@extends('layouts.new-layouts.admin_app')
@section('content')

  <div class="card">
      <div class="row">
         
           <div class="col-md-12">
             <form action="" autocomplete="off">
               <label for="">Search by Roll no / school First Name / school Last Name</label>
           <div class="input-group">
            <input type="text" name="search" placeholder="Search by Roll or Name" value="{{ Request('search') }}" class="form-control" aria-label="...">
            <div class="input-group-btn">
              <button class="btn btn-info "><i class="fa fa-search"></i> search</button>
            </div>
            </form>
             <div class="input-group-btn">
               <a href="{{route('admin\search.index')}}" class="btn btn-warning"><i class="fa fa-refresh"></i> reset</a>
            </div>
          </div>
         </div>
          </div>
      </div>
      {{-- <div class="card-header"><h4>All schools</h4></div> --}}
      <div class="card-body">
        @if (Request('search'))
           <table class="table table-striped jambo_table bulk_action">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Logo</th>
                      <th>Location</th>
                      <th>School</th>
                      <th>Status</th>
                      <th colspan="6">Entrolled Sctudents</th>
                  </tr>
              </thead>
              <tbody>
                 @foreach ($schools as $key => $school)
                    <tr>
                        <td>{{ $key+1}}</td>
                        <td style="text-align: left !important"><img width="50" class="round"  src="{{ $school->image != '' ? asset('institute_logo/' .$school->image) : asset('institute_logo/default_logo.jpg') }}" }} alt=""> {{ $school->username}}</td>
                        <td style="text-align: left !important">{{ $school->address }}</td>
                        <td style="text-align: left !important">{{ $school->name}}</td>
                        <td style="text-align: left !important">{{ $school->is_active == 1 ? 'Is Active' : 'Not Active'}}</td>
                        <td style="text-align: center !important">{{ App\Models\Admission::where('school_id', $school->id)->count()}}</td>
                        <td style="text-align: left !important">
                        <div class="btn-group pull-right">
                          <a href="#" class="btn btn-info"><i class="fa fa-print"></i> </a>
                          <a href="#" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> </a>
                        </div>
                        </td>
                    </tr>
                @endforeach
              </tbody>
              {{-- @else
                 <td colspan="6"> <h4 style="text-align: center">No Data Found</h4></td>
                @endif --}}
          </table>
          
      @else
          <h4 style="text-align: center">No Data....</h4>
      @endif
      </div>
  {{-- </div> --}}
</div>


@endsection