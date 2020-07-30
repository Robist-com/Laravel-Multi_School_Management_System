@if(Session::has('success'))
        <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong> {{Session::get('success')}}</strong>
        </div>
        @endif