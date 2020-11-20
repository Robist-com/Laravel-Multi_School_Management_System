<div class="accordian-body collapse " id="semesterDetail{{$semester->id}}">
<!-- {{ $key==0 ? 'in' : null}} -->
    <table> 
        <thead>

            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Semester</th>
                <th style="text-align: center;">Course</th>
                <th style="text-align: center;">Department</th>
                <th style="text-align: center;">Level</th>
                <th style="text-align: center;">Action</th>

            </tr>
        </thead>
        <tbody>

            <tr>
                <td></td>
                <td>{{$semester->semester_name}}</td>
                <td>{{$semester->department_name}}</td>
                <td>{{$semester->course_name}}</td>
                <td>{{$semester->level}}</td>
                
                <td>
                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-edit" title="Edit"></i></a>
                    <a href="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" title="Delete"></i></a>
                    <a href="" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print" title="Print"></i></a>
                </td>
            </tr>

        </tbody>
    </table>
</div>