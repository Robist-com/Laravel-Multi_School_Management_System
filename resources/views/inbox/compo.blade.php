<div class="modal fade" id="COMPOSE" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
aria-hidden="true">
    <div class="modal-dialog " style="width:60%">
        <div class="modal-content">
            <div class="modal-header-dark">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><span class="fa fa-envolop">New Message</span> </h4>
            </div>
            <form action="{{route('levels.store')}}" method="POST" id="frm-level-create">
            <div class="modal-body">
                <div class="pnael">
                    <div class="panel-body">
            <div class="col-md-12">
                <input type="text"   class="form-control "  placeholder="Recipients " >
           </div>
           <hr>
           <br><br>
           <div class="col-md-12">
            <input type="text" class="form-control" placeholder="subject">
       </div>
           <br><br>

           <div class="col-md-12">
             <textarea name="editor1"></textarea>
           </div>
        </div>
    </div>
</div>
<div class="modal-footer">
<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
<div class="btn-group pull-left">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        send <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li ><a  style='color:red;' href="#">Mail</a></li>
        <li><a href="#">Contacts</a></li>
        <li><a href="#">Tasks</a></li>
    </ul>
</div>
</div>
</form>
 </div>
</div>
</div>

{{-- @section('scripts')



@endsection --}}
