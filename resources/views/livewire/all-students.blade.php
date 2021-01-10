{{-- <div> --}}
  <div class="card">
       {{ $search }}
      <div class="row">
          <div class="form-group">
              <input type="text" wire:model="search" class="form-control">
          </div>
      </div>
      <div class="card-header"><h4>All Students</h4></div>
      <div class="card-body">
           <table class="table table-striped jambo_table bulk_action">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Roll</th>
                      <th>Name</th>
                      <th>School</th>
                      <th>Grade</th>
                  </tr>
              </thead>
              <tbody>
                 @foreach ($students as $key => $student)
                    <tr>
                        <td>{{ $key+1}}</td>
                        <td style="text-align: left !important"><img width="50" class="round"  src="{{ $student->image != '' ? asset('student_images/' .$student->image) : asset('student_images/profile.jpg') }}" }} alt=""> {{ $student->username}}</td>
                        <td style="text-align: left !important">{{ $student->first_name .' '. $student->last_name }}</td>
                        <td style="text-align: left !important">{{ $student->name}}</td>
                        <td style="text-align: left !important">{{ $student->level}}</td>
                    </tr>
                @endforeach
              </tbody>
              {{-- {{ $students->links() }} --}}
          </table>
      </div>
  {{-- </div> --}}
{{-- </div> --}}
