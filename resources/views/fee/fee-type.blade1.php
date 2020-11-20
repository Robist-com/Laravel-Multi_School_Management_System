
<div class="table-responsive">
    <table class="table table-striped jambo_table bulk_action" id="show-fee-type" style="margin-top: -12px;">

                      
                          <thead>
                          <tr>
                              <th>Grade</th> 
                              <th>Fee Type</th>
                              <th>Fee($)</th>
                              <th>Total Fee Amount</th>
                              <th>Paid Amount($)</th>
                              <th>Balance Amount($)</th>
                          </tr>
                          </thead>
                          @foreach($fee_structure1 as $fee_struct)
                          <tr>
                          <td>
                          <input type="text" class="form-control" style=" border:none; text-align:center; font-weight:bold;" id="grade_name" value="{{$fee_struct->semester_name}}" readonly>
                          <input type="hidden" name="fee_id" class="form-control" style=" border:none; text-align:center; font-weight:bold;" id="grade_name" value="{{$fee_struct->fee_structure_id}}" readonly>
                          <input type="hidden" name="level_id1" class="form-control" style=" border:none; text-align:center; font-weight:bold;" id="grade_name" value="{{$fee_struct->fee_structure_id}}" readonly>
                          </td>     
                          <td>
                          <input type="text" style="text-align:center; border:none" class="form-control"  value="{{$fee_struct->fee_type}}" id="admissionFee" readonly="">
                          </td> 
                          <td>
                          <input type="text" name="semester_id1" style="text-align:right; border:none" class="form-control" value="{{$fee_struct->semesterFee}}" id="semesterFee" readonly="">
                          </td>       
                          <td>
                          <input type="text" style="text-align:right; border:none" class="form-control" name="amount" value="" id="totalFee" readonly="">
                          </td>  
                          @endforeach
                      
                          <td>
                          <input type="text" class="form-control" style="text-align:right" name="paid_amount" id="Paid" required>
                          </td>
                      
                          <td>
                          <input type="text" class="form-control" style="text-align:right; border:none" name="balance" id="balance" readonly>
                          </td>
                          </tr>
                      
                          <thead>
                          <tr>
                          <th colspan="2">Remark</th>
                          <th colspan="5">Description</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                          <td colspan="2">
                          <input type="text" name="remark" class="form-control" id="remark">
                          </td>
                          <td colspan="5">
                          <input type="text" name="description" class="form-control" id="description">
                          </td>
                          </tr>
                          </tbody>
                          </div>
                          </div>
                            </table>
                            </div>