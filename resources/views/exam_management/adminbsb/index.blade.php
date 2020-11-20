
<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>EXAM MANAGEMENT </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <a class="btn bg-teal btn-round" data-toggle="modal" data-target="#createExam"> Create Exam</a>
    </div>
    <br><br>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">

                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">
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

                <div class="pull-right">
                <a href="{{url('pdf-download-users')}}" class="btn btn  btn-x"> 
                <i class="fa fa-file-pdf-o text-red" style="color:red"></i> PDF </a>

                <a href="{{url('export-excel-xlsx-users')}}" class="btn btn  btn-x"> 
                <i class="fa fa-file-excel-o text-green" style="color:green"></i> Excel </a>

                <a href="{{url('pdf-download-users')}}" class="btn btn  btn-x"> 
                <i class="fa fa-file-word-o text-blue" style="color:blue"></i> Word </a>

                <a href="#" onclick="window.print();" class="btn btn  btn-x"> 
                <i class="fa fa-print text-light-blue" style="color:default"></i> Print </a>
                </div>
                <div class="clearfix"></div>
                    @include('exam_management.table')
                    
           {{-- <form action="{{route('admissions.store')}}" method="post" enctype="multipart/form-data"> --}}
                    <!-- @csrf -->
              
                 @include('exam_management.adminbsb.examCreate')
                  {!! Form::close() !!}
            </div>
        <div class="text-center">
          
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>


    @section('js')

    <script>
        $(document).ready(function(){
            alert(1)
            $('.js-exportable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        })
    </script>

    @stop

