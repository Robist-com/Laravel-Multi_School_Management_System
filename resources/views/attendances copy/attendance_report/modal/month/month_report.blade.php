<!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="monthReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header-store">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h5 class="modal-title" id="exampleModalLongTitle">Monthly Attendance Report</h5>
        </div>
        <div class="modal-body">
            <form action="{{url('/monthly_attendance')}}" method="get">
                
                <input type="text" class="form-control" name="monthly_date" id="month" placeholder="Month">
            
            </div>
            <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print Report</button>
        </div>
        </form>

        <div class="modal-body">
            <div class="panel-default">
                <div class="panel-heading">
                    <h3>Month and Year Report</h3>
                </div>
                <div class="panel-body">
            <form action="{{url('/monthly_attendance')}}" method="get">
                <div class="row">
                <div class="form-group">
                <div class="col-md-6">
                  <input type="text" class="form-control" name="monthly_date" id="monthly_date" placeholder="Month">
                </div>
                <div class="col-md-6">
                <input type="text" class="form-control" name="yearly_date" id="yearly_date" placeholder="Year">
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print Report</button>
        </div>
        </form>
      </div>
    </div>
  </div>