<style type="text/css">

        .table-fee{
            border:none;
        }
        .table-fee tr , td, th{
            border:none;
        }
</style>

<div class="modal fade" id="createFeeOpup" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="row">
            <div class="panel panel-default">
            <div class="panel-heading">
            <b><i class="glyphicon glyphicon-apple"></i>Create School Fee</b>
        </div>
    {{------------------------------------------}}
        
        <form action="{{ route('createFee')}}" method="POST" id="frmFee">
        <div class="panel-body">
        <div class="table-responsive">

    {{----------Start Table--------------}}

            <table class="table-fee">
            
                <tr>
                    <td><label><b>Fee Type</b></label></td>
                    <td>
                        <select class="form-control" name="fee_type_id" id="fee_type_id" disabled>
                                @foreach($feetypes as $key => $ft)
                                        <option value="{{$ft->fee_type_id}}">{{$ft->fee_type}}</option>
                                @endforeach
                        </select>
                    </td>
                </tr>


                 <tr>
                 <td><label><b>Fee Heading</b></label></td>
                    <td>
                        <input type="text" name="fee_heading" id="fee_heading" value="Fees" disabled>
                    </td>
                 </tr>

                  <tr>
                 <td><b>Academic Year</b></td>
                    <td>
                    </td>
                 </tr>

                  <tr>
                 <td> <b>Program</b></td>
                    <td>
                    </td>
                 </tr>

                  <tr>
                 <td> <b>Level</b></td>
                    <td>
                    </td>
                 </tr>

                    <tr>
                 <td> <b>School Fee <span>($)</span></b></td>
                    <td>
                        <input type="text" name="amount" id="amount" autocomplete="off" class="form-control" placeholder="Amount" required>
                    </td>
                 </tr>
                 
            </table>

            {{--------------End Table---------------------------}}
        </div>
        </div>

        <div class="panel-footer">
            <input type="submit" class="btn btn-default" value="Create Fee">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
        </div>

        </form>
        {{----------End Form------------------------}}

    </div>
    </div>
    </div>
</div>