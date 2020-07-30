<style>
        .{pull
            text-align:center;
            border: 1px solid;
        }
        
        th{
            text-align:center;
        }
        table{
           align-content: center
        }
</style>
   <!-- Table row -->
   <div class="row">
        <div class="col-xs-12 table-responsive" style="margin-left: 40px;">
          <table class="table table-striped" style="margin-left:8px;">
            <thead>
            @foreach($teachers as $teacher)
            <tr class="show">
            <td><img src="{{asset('teacher_images/' .$teacher->image)}}" alt="" 
                class="rounded-circle" width="50" height="50" style="border-radius:50%; vertical-alight:middle;"></td>
                <td>
             <!-- <img class="profile-user-img img-responsive img-circle pull-left"  > -->

							<th scope="col"><?php $i; ?></th>
						
							<!-- <tr><th scope="col">Roll No </th> <td> </td></tr> -->
							<tr><th scope="col">Full Name </th> <td>{!! $teacher->first_name !!} {!! $teacher->last_name !!} </td></tr>
							<tr><th scope="col">nationality</th> <td> {!! $teacher->nationality !!}</td></tr>
							<tr><th scope="col">Dirth of Birth</th> <td>{!! $teacher->dob !!} </td></tr>
							<tr><th scope="col">Gender </th> <td> @if($teacher->gender == 0) Male @else Female @endif</td></tr>
							<!-- <tr><th scope="col">Phone</th> <td> </td></tr> -->
							<tr><th scope="col">Phone</th> <td>{!! $teacher->phone !!} </td></tr>
							<tr><th scope="col">Email </th> <td> {!! $teacher->email !!}</td></tr>
							<tr><th scope="col">Address </th> <td> {!! $teacher->address !!}</td></tr>
							<tr><th scope="col">passport </th> <td>{!! $teacher->passport !!} </td></tr>
							<tr><th scope="col">Status </th> <td> @if($teacher->status == 0) Single  @else  Married @endif</td></tr>
                            </tr>
							</table>
                            @endforeach
            </tbody>
        </div>
        <!-- /.col -->
      </div>
