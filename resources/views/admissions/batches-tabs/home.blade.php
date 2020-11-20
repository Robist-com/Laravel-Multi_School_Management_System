
<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th class="column-title">Image</th>
            <th class="column-title">Full Name</th>
            <th class="column-title">Student Group</th> 
            <th class="column-title">Class Group</th> 
            <th class="column-title">Batch</th> 
            <th class="column-title">Gender</th> 
            <!-- <th class="column-title">School Name</th>  -->
            
        </tr>
    </thead>
 
    <tfoot>
        <tr>
            <th></th>
            <th class="column-title">Image</th>
            <th class="column-title">Full Name</th>
            <th class="column-title">Student Group</th> 
            <th class="column-title">Class Group</th> 
            <th class="column-title">Batch</th> 
            <th class="column-title">Gender</th> 
            <!-- <th class="column-title">School Name</th>  -->
        </tr>
    </tfoot>
</table>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<style>
    td.details-control {
    background: url('.../resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('.../resources/details_close.png') no-repeat center center;
}
</style>

@section('scripts')

<script>
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