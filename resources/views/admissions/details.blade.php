
<style>
.color{
    background-color:silver
}
</style>
<div class="accordian-body collapse " id="demo{{$key}}">
<div class="panel panel-default1 jambo_table">
    <div class="panel-heading">
        <h6 style="font-weight:bold; color:red" class="pull"> <b style="color:black">{!! $admission->first_name !!} {!! $admission->last_name !!}</b> Details</h6>
    </div>
    <div class="table-responsive">
    <div class="panel-body">
    <table class="table table-striped jambo_table bulk_action">
        <thead class="color">

            <tr>
                <th style="text-align: center;" class="color">Father</th>
                <th style="text-align: center;" class="color">F-Phone</th>
                <th style="text-align: center;" class="color">Mother</th>
                <th style="text-align: center;" class="color">Email</th>
                <th style="text-align: center;" class="color">Dob</th>
                <th style="text-align: center;" class="color">Phone</th>
                <th style="text-align: center;" class="color">Address</th>
                <th style="text-align: center;" class="color">Current</th>
                <th style="text-align: center;" class="color">Nationality</th>
                <th style="text-align: center;" class="color">Passport</th>
                <th style="text-align: center;" class="color">Date</th>
                <th style="text-align: center;" class="color">Action</th>

            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="text-align: center;">{{$admission->father_name}}</td>
                <td style="text-align: center;">{{$admission->father_phone}}</td>
                <td style="text-align: center;">{{$admission->mother_name}}</td>
                <td style="text-align: center;">{{$admission->email}}</td>
                <td style="text-align: center;">{{date('d-m-Y', strtotime($admission->dob))}}</td>
                <td style="text-align: center;">{{$admission->phone}}</td>
                <td style="text-align: center;">{{$admission->address}}</td>
                <td style="text-align: center;">{{$admission->current_address}}</td>
                <td style="text-align: center;">{{$admission->nationality}}</td>
                <td style="text-align: center;">{{$admission->passport}}</td>
                <td style="text-align: center;">{{date('d-m-Y', strtotime($admission->dateregistered))}}</td>

                <td style="text-align: center;width:112px;">
                <a href="{!! url('print-admission-single', [$admission->id]) !!} " title="Print" target="_blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                <!-- <a href="{!! url('fee-collection-payment', [$admission->id]) !!} " title="Print" target="_blank" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-tag"></i></a> -->
                
                <a href="{!! route('admissions.edit', [$admission->id]) !!}" title="Edit" class='btn btn-primary btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                </td>

            </tr>
          
        </tbody>
    </table>
</div>
</div>
</div>
</div>