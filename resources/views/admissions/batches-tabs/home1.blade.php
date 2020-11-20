
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<h3>  OFFLINE ADMISSION TABLE </h3>
        <div class="page-title">
            <ol class="breadcrumb breadcrumb-bg-teal align-right">
                <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
                <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
                <li class="active"> <a href="{{url()->previous()}}" > <i class="material-icons">arrow_back</i>
                Return</a></li>
            </ol>
            <a href="{{route('admissions.create')}}"><button type="submit" class="btn btn-teal bg-teal btn-sm  pull-left" ><i class="fa fa-plus-circle"></i> Add New Admission</button></a>
            
        </div>

<br><br>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                             
                            
                            </h2>
                            <br>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                        role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                        <th></th>
                                        <th class="column-title">Roll</th>
                                        <th class="column-title">Full Name</th>
                                        <th class="column-title">Student Group</th> 
                                        <th class="column-title">Class Group</th> 
                                        <th class="column-title">Batch</th> 
                                        <th class="column-title">Gender</th> 
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th></th>
                                        <th class="column-title">Roll</th>
                                        <th class="column-title">Full Name</th>
                                        <th class="column-title">Student Group</th> 
                                        <th class="column-title">Class Group</th> 
                                        <th class="column-title">Batch</th> 
                                        <th class="column-title">Gender</th> 
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<style>
    td.details-control {
    background: url({{asset('resources/details_open.png')}}) no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url({{asset('resources/details_close.png')}}) no-repeat center center;
}
</style>

@section('js')

<script>

  $(document).ready(function(){
    //   alert(1)
  })  
    /* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="10" cellspacing="0" border="0" style="padding-left:50px;">'+
        
        '<tr>'+
            '<td>Email:</td>'+
            '<td>'+d.email+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>School Name:</td>'+
            '<td>'+d.school_name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Date of Birth:</td>'+
            '<td>'+d.dob+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Phone Number:</td>'+
            '<td>'+d.phone+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Address:</td>'+
            '<td>'+d.address+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Current Address:</td>'+
            '<td>'+d.current_address+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Nationality:</td>'+
            '<td>'+d.nationality+'</td>'+
        '</tr>'+

        '<tr>'+
            '<td>Passport:</td>'+
            '<td>'+d.passport+'</td>'+
        '</tr>'+

        '<tr>'+
            '<td>Registration Date:</td>'+
            '<td>'+d.dateregistered+'</td>'+
        '</tr>'+
        
        '<tr>'+
            '<td>Father name:</td>'+
            '<td>'+d.father_name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Father Phone number:</td>'+
            '<td>'+d.father_phone+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Father ocupation:</td>'+
            '<td>'+d.father_ocupation+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Mother name:</td>'+
            '<td>'+d.mother_name+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Mother Phone number:</td>'+
            '<td>'+d.mother_phone+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Mother ocupation:</td>'+
            '<td>'+d.mother_ocupation+'</td>'+
        '</tr>'+
        
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
}
 
$(document).ready(function() {
    var table = $('#example').DataTable( {
        "ajax": {url:"{{ route('admissions.index') }}", 
                 "type:" : 'GET'
                //  "beforeSend": () => {loader.show()},
                //  "complete" : () => {loader.hide()}
        },
        
        "columns": [
            {
                "class":          'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { "data": "roll_no" },
            { "data": "full_name"},
            { "data": "faculty_name" },
            { "data": "department_name" },
            { "data": "batch" },
            { "data": "gender" },
            // { "data": "school_name" }

           
            // { "data": null, orderable:false,defaultContent:'' }
        ],
        "order": [[1, 'asc']]
    } );
     
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).parents('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
} );


</script>

@endsection