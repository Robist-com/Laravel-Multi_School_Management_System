<style>
.dropdown-menu {
    min-width: 50px !important;
    margin-left: -100px !important;
}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <h3>LIBRARY </h3>
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <a href="{{route('book.add')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a>
    </div>
    <br><br>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">

        <div class="header">
            @if(isset($book))
            <h2>Update Book</h2>
            @elseif(isset($add_book))
            <h2>Add Book</h2>
            @else
            <h2> Book List</h2>
            @endif
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

            @if(isset($add_book))
            @if(isset($book))
            {!! Form::model($book, ['route' => ['book.update', $book->id], 'method' => 'post', 'class' =>
            'form-horizontal form-label-left', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            @else
            {!! Form::open(['route' => 'book.store', 'class' => 'form-horizontal form-label-left', 'enctype' =>
            'multipart/form-data']) !!}
            @csrf
            @endif

            @if(auth()->user()->group == "Admin")
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control bootstrap-select" name="school_id" id="school_id">
                        <option>Choose School</option>
                        @foreach (auth()->user()->school->all() as $school)
                        <option value="{{ $school->id }}"
                            @if(isset($book)){{$book->school_id == $school->id ? 'selected' : ''}} @endif>
                            {{$school->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @else
            <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
            @endif

            <div class="form-group row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Book Title <b style="color:red">*</b></label>
                    <div class="form-line">
                        <input type="text" name="book_title" id="book_title" class="form-control" @if(isset($book))
                            value="{{$book->book_title}}" @endif autocomplete="off">
                    </div>
                </div>
                <!-- </div> 

                    <div class="form-group"> -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Book Number <b style="color:red">*</b></label>
                    <div class="form-line">
                        <input type="text" name="book_number" id="book_number" class="form-control" @if(isset($book))
                            value="{{$book->book_number}}" @endif autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">ISBN Number<b style="color:red">*</b></label>
                    <div class="form-line">
                        <input type="text" name="isbn_number" id="isbn_number" class="form-control" @if(isset($book))
                            value="{{$book->isbn_number}}" @endif autocomplete="off">
                    </div>
                </div>
                <!-- </div> 

                    <div class="form-group"> -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Publisher<b style="color:red">*</b></label>
                    <div class="form-line">
                        <input type="text" name="publisher" id="publisher" class="form-control" @if(isset($book))
                            value="{{$book->publisher}}" @endif autocomplete="off">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Author<b style="color:red">*</b></label>
                    <div class="form-line">
                        <input type="text" name="author" id="author" class="form-control" @if(isset($book))
                            value="{{$book->author}}" @endif autocomplete="off">
                    </div>
                </div>
                <!-- </div> 

                    <div class="form-group"> -->
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Subject<b style="color:red">*</b></label>
                    <div class="form-line">
                        <input type="text" name="subject" id="subject" class="form-control" @if(isset($book))
                            value="{{$book->subject}}" @endif autocomplete="off">
                    </div>
                </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="">Rac Number <b style="color:red">*</b></label>
                        <div class="form-line">
                            <input type="text" name="rac_number" id="rac_number" class="form-control" @if(isset($book))
                                value="{{$book->rac_number}}" @endif autocomplete="off">
                        </div>
                    </div>
                    <!-- </div>

                    <div class="form-group"> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="">Post Date <b style="color:red">*</b></label>
                        <div class="form-line">
                            <input type="text" name="post_date" id="date" class="form-control" @if(isset($book))
                                value="{{$book->post_date}}" @endif autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="">Book Qty <b style="color:red">*</b></label>
                        <div class="form-line">
                            <input type="number" name="book_qty" id="book_qty" class="form-control" @if(isset($book))
                                value="{{$book->book_qty}}" @endif autocomplete="off">
                        </div>
                    </div>
                    <!-- </div>

                    <div class="form-group"> -->
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label for="">Book Price <b style="color:red">*</b></label>
                        <div class="form-line">
                            <input type="number" name="book_price" id="book_price" class="form-control"
                                @if(isset($book)) value="{{$book->book_price}}" @endif autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label for=""> Description </label>
                        <div class="form-line">
                            {!! Form::textarea('description', null, ['class' => 'form-control border', 'cols' =>
                            40, 'rows' =>2, ''=> ' Description', 'autocomplete' => 'off']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <select name="status" id="status" class="form-control bootstrap-select">
                            @if(isset($book))
                            <option value="on" @if($book->status == 'on') selected @endif> Active</option>
                            <option value="off" @if($book->status == 'off') selected @endif> In Active</option>
                            @else
                            <option value="on"> Active</option>
                            <option value="off"> In Active</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    @if(isset($book))
                    {!! Form::submit('Save Changes', ['class' => 'btn bg-teal']) !!}
                    @else
                    <button type="submit" class="btn btn-round bg-teal">Save</button>
                    @endif
                </div>

                {!! Form::close() !!}

            </div>
            @endif
        </div>

        @if(isset($book_list))
        <div class="body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr class="headings">

                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Title">
                                Title</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Number">
                                Number</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top"
                                title="Book ISBN Number">
                                ISBN#</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Publisher">
                                Publisher</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Author">
                                Author</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Subject">
                                Subject</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top"
                                title="Book Rack Number">
                                Rack#</th>
                            <th class="column-title" data-toggle="tooltip" data-placement="top"
                                title="Book Total Quantity and Price">
                                Qty</th>
                            <!-- <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book In Stock">in
                                Stock</th> -->
                            <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Price">
                                price</th>
                            <!-- <th class="column-title" data-toggle="tooltip" data-placement="top" title="Book Added Date"> -->
                                <!-- Date</th> -->
                            <th class="column-title no-link last" data-toggle="tooltip" data-placement="top"
                                title="Book Operations"><span class="nobr">Action</span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($book_list as $book)
                        <tr class="even pointer">
                            <td class="">{!! $book->book_title !!}</td>
                            <td class="">{!! $book->book_number !!}</td>
                            <td class="">{!! $book->isbn_number !!}</td>
                            <td class="">{!! $book->publish !!}</td>
                            <td class="">{!! $book->author !!}</td>
                            <td class="">{!! $book->subject !!}</td>
                            <td class="">{!! $book->rac_number !!}</td>
                            <td class="">{!! $book->book_qty !!}</td>
                            <!-- <td class="">{!! $book->available !!}</td> -->
                            <td class="">{!! $book->book_price !!}</td>

                            <td colspan="3">
                                {!! Form::open(['route' => ['expensestype.delete', $book->id],
                                'method' =>
                                'delete', 'id' => 'delete_form']) !!}

                                <div class="btn-group">

                                    <button type="button" class="btn bg-pink dropdown-toggle" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        ACTION <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">

                                        <li>
                                            <a href="{!! url('print-faculty-single', [$book->id]) !!} " target="_blank">
                                                <i class="glyphicon glyphicon-print"></i> Print</a>
                                        </li>

                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a data-book_id="{{$book->id}}"
                                                data-book_qty="{{$book->book_qty}}"
                                                data-available="{{$book->available}}"
                                                data-book_price="{{$book->book_price}}"
                                                data-rac_number="{{$book->rac_number}}"
                                                data-subject="{{$book->subject}}"
                                                data-author="{{$book->author}}"
                                                data-publish="{{$book->publish}}"
                                                data-isbn_number="{{$book->isbn_number}}"
                                                data-book_number="{{$book->book_number}}"
                                                data-book_title="{{$book->book_title}}"
                                                data-date="{{$book->date}}"
                                                data-book_description="{{$book->book_description}}"
                                                data-created_at="{{$book->created_at}}"
                                                data-updated_at="{{$book->updated_at}}" data-toggle="modal"
                                                data-target="#book-show" >
                                                <i class="glyphicon glyphicon-eye-open"></i> View</a>

                                        </li>

                                        <li role="separator" class="divider"></li>

                                        <li>
                                            <a href="{!! route('book.edit', [$book->id]) !!}">
                                                <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                        </li>

                                        <li role="separator" class="divider"></li>

                                        <li>

                                            <a id="delete_link" href="#"
                                                data-confirm="Are you sure want to delete {{$book->book_title}} ?"><i
                                                    class="material-icons">delete_forever</i> Delete</a>
                                        </li>

                                    </ul>
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="modal fade" id="expense-type" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="fa fa-head">Add New Expense Type</span> </h4>
            </div>
            <form action="{{route('expensestype.store')}}" method="POST" id="frm-level-create"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    @if(auth()->user()->group == "Admin")
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <select class="form-control" name="school_id" id="school_id">
                                <option>Choose School</option>
                                @foreach (auth()->user()->school->all() as $school)
                                <option value="{{ $school->id }}"
                                    @if(isset($book)){{$book->school_id == $school->id ? 'selected' : ''}} @endif>
                                    {{$school->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @else
                    <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}">
                    @endif
                    <!-- Level Field -->
                    <div class="form-group">
                        <label for="">Expense Type <b style="color:red">*</b></label>
                        {!! Form::text('type', null, ['class' => 'form-control', '' => 'Enter Expense
                        Type']) !!}
                    </div>
                    <!-- Submit Field -->
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                    {!! Form::submit('Create Expense Type', ['class' => 'btn btn-success']) !!}
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ----------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" id="book-show" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" >
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><span class="fa fa-level-up">Book Details</span> </h4>
            </div>
                <div class="modal-body" style="background:#EEEEEE">

                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Book Title</label>
                    <input type="hidden" name="" id="book_id" class="form-control" disabled>
                    <input type="text" name="" id="book_title_view" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Book Number</label>
                    <input type="text" name="" id="book_number_view" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Isbn Number</label>
                    <input type="text" name="" id="book_isbn_view" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Publisher</label>
                    <input type="text" name="" id="book_publisher_view" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Book Author</label>
                    <input type="text" name="" id="book_author_view" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Subject</label>
                    <input type="text" name="" id="book_subject_view" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Rack Number</label>
                    <input type="text" name="" id="book_rack_number_view" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Book Quantity</label>
                    <input type="text" name="" id="book_qty_view" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Book Price</label>
                    <input type="text" name="" id="book_price_view" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Book Availablity</label>
                    <input type="text" name="" id="book_available_view" class="form-control" disabled>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="form-line">
                    <label for="">Book Description</label>
                    <input type="text" name="" id="book_description_view" class="form-control" disabled>
                    </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                    <!-- {!! Form::submit('Create Level', ['class' => 'btn btn-success']) !!} -->
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@section('js')

<script>
$('#date').datetimepicker({
    format: 'Y-m-d',
    timepicker:false
});

// {{--------------------------Level Side-------------------------}} 
$('#level-edit').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget)
    var level = button.data('level')
    var course_id = button.data('course_id')
    var level_description = button.data('level_description')
    var level_id = button.data('level_id')

    var modal = $(this)

    modal.find('.modal-title').text('EDIT LEVEL INFORMATION');
    modal.find('.modal-body #level').val(level);
    modal.find('.modal-body #course_id').val(course_id);
    modal.find('.modal-body #level_description').val(level_description);
    modal.find('.modal-body #level_id').val(level_id);
});


// {{--------------------------Level view Side-------------------------}} 
$('#book-show').on('show.bs.modal', function(event) {
  
    var button = $(event.relatedTarget)
    var book_title = button.data('book_title')
    var book_qty = button.data('book_qty')
    var available = button.data('available')
    var book_price = button.data('book_price')
    var rac_number = button.data('rac_number')
    var subject = button.data('subject')
    var author = button.data('author')
    var publish = button.data('publish')
    var isbn_number = button.data('isbn_number')
    var date = button.data('date')
    var book_description = button.data('book_description')
    var book_id = button.data('book_id')

    // alert(book_title)
    var modal = $(this)

    modal.find('.modal-title').text('VIEW BOOK INFORMATIONS');
    modal.find('.modal-body #book_title_view').val(book_title);
    modal.find('.modal-body #book_qty_view').val(book_qty);
    modal.find('.modal-body #book_available_view').val(available);
    modal.find('.modal-body #book_price_view').val(book_price);
    modal.find('.modal-body #book_rack_number_view').val(rac_number);
    modal.find('.modal-body #book_subject_view').val(subject);
    modal.find('.modal-body #book_author_view').val(author);
    modal.find('.modal-body #book_publisher_view').val(publish);
    modal.find('.modal-body #book_isbn_view').val(isbn_number);
    modal.find('.modal-body #book_date_view').val(date);
    modal.find('.modal-body #book_description_view').val(book_description);
    modal.find('.modal-body #book_id').val(book_id);
});

var deleteLinks = document.querySelectorAll('#delete_link');

for (var i = 0; i < deleteLinks.length; i++) {
    deleteLinks[i].addEventListener('click', function(event) {
        event.preventDefault();

        var choice = confirm(this.getAttribute('data-confirm'));

        if (choice) {
            document.getElementById("delete_form").submit(); //form id
        }
    });
}

//  Exportable table
$('.js-exportable').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
});
</script>

@endsection