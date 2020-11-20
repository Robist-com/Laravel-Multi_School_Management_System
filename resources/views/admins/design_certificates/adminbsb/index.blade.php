<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"
    @section('content') <div class="content">

<div class="clearfix"></div>

@include('flash::message')


@if (session()->has('success'))
<div class="alert alert-success" style="font-size:30px; font-weight:bold">
    {!! session()->get('success')!!}
    <span aria-hidden="true">&times;</span><span class="sr-only">close</span>
</div>
@endif

<div class="clearfix"></div>

<div class="clearfix"></div>

    <style>
    .tooltip-inner {
        max-width: 700px !important;
        Background: #2A3F54 !important;
        /* color: #000 !important; */
    }

    #datatable-buttons thead,
    #datatable-buttons th {
        text-align: center;
    }

    /* .example{} */

    input[type='checkbox'].example {
        position: relative;
        left: -999em;
        /* Hide the real checkbox */
        cursor: pointer;
        max-width: 00px !important
    }
    </style>

<?php $id = 1 ?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <!-- <h3> CREATE A CERTIFICATE </h3> -->

        @if(isset($add_book))
        <h2>Add card_templateEdit</h2>
        @elseif(isset($book_update))
        <h2>Update Book</h2>
        @else
        <h3>DESIGN CERTIFICATE</h3>
        @endif
    <div class="page-title">
        <ol class="breadcrumb breadcrumb-bg-teal align-right">
            <li><a href="{{url('home')}}"><i class="material-icons">home</i> Home</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">library_books</i> Library</a></li>
            <li><a href="javascript:void(0);"><i class="material-icons">archive</i> Data</a></li>
            <li class="active"> <a href="{{url()->previous()}}"> <i class="material-icons">arrow_back</i>
                    Return</a></li>
        </ol>
        <!-- <a href="{{route('expenses.index')}}" class="btn bg-teal btn-sm  pull-left"><i class="material-icons">add</i>
            Add</a> -->
    </div>
    <br><br>

        <!-- Multiple Items To Be Open -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        {!! Form::model($visitors, array( 'route' => array('visitor.truncate'),'method'
                                        => 'DELETE')) !!}
                                        <button type="submit" class="btn btn-danger" type="button"><i
                                                class="fa fa-remove"></i> Truncate Table </button>
                                        <button class="btn btn-warning"><a
                                                href="{{route('design_certiifcate.show', [$id])}}" target="_balnk"
                                                style="color:#ffff"><i class="fa fa-preview"></i>Preview
                                                Certificate</a></button>
                                        <button class="btn btn-info" type="button"><a href="{{route('sample')}}"
                                                target="_blank" style="color:#ffff">Sample Certificate</a></button>
                                        {!! Form::close()!!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- <a href=""  data-toggle="modal" data-target="#return_book">sample</a> -->

                                    <div class="modal fade" id="return_book" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" style="width:100%">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title"><span class="fa fa-head"></span> </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" name="" id="card_id">
                                                    <img src="{{asset('school_images/signature/certificate_frame3.png')}}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
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
                        @if(isset($card_templateEdit))
                        {!! Form::model($card_templateEdit, ['route' => ['student_idCard.update',
                        $card_templateEdit->id],
                        'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' =>
                        'multipart/form-data'])
                        !!}
                        @csrf
                        @else
                        {!! Form::open(['route' => 'design_certiifcate.store', 'class' => 'form-horizontal
                        form-label-left',
                        'enctype' => 'multipart/form-data', 'onsubmit' => ' myValidation();']) !!}
                        @csrf
                        @endif
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                                    <div class="panel-group full-body" id="accordion_19" role="tablist"
                                        aria-multiselectable="true">
                                        <div class="panel panel-col-pink1">
                                        <div class="demo-switch">
                                            <div class="switch">
                                                <label>For Student<input type="checkbox" @if(request('teacher')=='student' ) checked @endif name="certificate_to" value="student"  checked><span class="lever"></span></label>
                                            </div>
                                            <div class="switch">
                                                <label>For Staff<input type="checkbox"  @if(request('teacher')=='staff' ) checked @endif name="certificate_to" value="staff"><span class="lever"></span></label>
                                            </div>
                                            <div class="switch">
                                                <label>For Others<input type="checkbox" @if(request('others')=='staff' ) checked @endif name="certificate_to" value="others"><span class="lever"></span></label>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-3 mt-5">
                                        <label class="switch-label switch">
                                            <input type="checkbox" class="switch" 
                                                checked name="certificate_to" data-toggle="toggle" data-on="For Student"
                                                data-off="Not For Student" data-onstyle="success" data-offstyle="danger"
                                                value="student">
                                        </label>
                                    </div> -->

                                        <!-- <div class="col-md-3">
                                        <label class="switch-label">
                                            <input type="checkbox" class="switch"
                                                name="certificate_to" data-toggle="toggle" data-on="For Staff"
                                                data-off="Not For Staff" data-onstyle="success" data-offstyle="danger"
                                                value="staff">
                                        </label>
                                    </div> -->

                                        <!-- <div class="col-md-3">
                                            <input type="checkbox" class="switch1" 
                                                name="certificate_to" data-toggle="toggle" data-on="For Others"
                                                data-off="Not For Others" data-onstyle="success" data-offstyle="danger" value="others">
                                    </div> -->
                                            <div class="panel-heading panel-col-pink" role="tab" id="headingOne_19">
                                                <h4 class="panel-title ">
                                                    <a role="button" data-toggle="collapse" href="#collapseOne_19"
                                                        aria-expanded="true" aria-controls="collapseOne_19">
                                                        <i class="material-icons pull-right">add</i> create
                                                        Item #1
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne_19" class="panel-collapse collapse " role="tabpanel"
                                                aria-labelledby="headingOne_19">
                                                <div class="panel-body ">
                                                    <div class="x_content ">
                                                        <div class="col-md-12 ">
                                                            <label for="" id="frame_message1"
                                                                style="color:red; font-family:times new roman; font-transform:uppercase"></label>
                                                            <input type="text" name="certificate_type"
                                                                id="certificate_type" class="form-control"
                                                                placeholder="Certificate Type"
                                                                style="margin-left:1px; font-transform:capitalize">
                                                        </div>
                                                        <div id="hide_content">
                                                            <div class="col-xs-3">
                                                                <ul class="nav nav-tabs tabs-left">
                                                                    <li class="active"><a href="#school_sample"
                                                                            data-toggle="tab">Certificate Sample &nbsp;
                                                                            <b style="color:green"
                                                                                id="school_sample_select"></b></a>
                                                                    </li>
                                                                    <li><a href="#school_frame"
                                                                            data-toggle="tab">Certificate Frame &nbsp;
                                                                            <b style="color:green"
                                                                                id="school_frame_select"></b></a>
                                                                    </li>
                                                                    <li><a href="#school_background"
                                                                            data-toggle="tab">Certificate Background
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_background_select"></b></a>
                                                                    </li>
                                                                    <li><a href="#school_name"
                                                                            data-toggle="tab">Certificate School Name
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_name_select"></b></a>
                                                                    </li>
                                                                    <li><a href="#school_logo"
                                                                            data-toggle="tab">Certificate School Logo
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_logo_select"></b></a>
                                                                    </li>
                                                                    <li><a href="#school_address"
                                                                            data-toggle="tab">Certificate School Address
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_address_select"></b></a>
                                                                    </li>
                                                                    <li><a href="#school_title"
                                                                            data-toggle="tab">Certificate Title &nbsp;
                                                                            <b style="color:green"
                                                                                id="school_title_select"></b> &nbsp; <b
                                                                                class="" id="req_title"> </b></a>
                                                                    </li>
                                                                    <li><a href="#school_certify"
                                                                            data-toggle="tab">Certificate Certify Note
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_certify_select"></b> &nbsp;
                                                                            <b class="" id="req_certify"> </b></a>
                                                                    </li>
                                                                    <li><a href="#school_holder"
                                                                            data-toggle="tab">Certificate Holder Name
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_holder_select"></b></a>
                                                                    </li>
                                                                    <li><a href="#school_information"
                                                                            data-toggle="tab">Certificate Information
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_info_select"></b> &nbsp; <b
                                                                                class="" id="req_info"> </b></a>
                                                                    </li>
                                                                    <li><a href="#school_issue"
                                                                            data-toggle="tab">Certificate Issue Date
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_issue_select"></b> &nbsp; <b
                                                                                class="" id="req_issue"> </b></a>
                                                                    </li>
                                                                    <li><a href="#school_signature1"
                                                                            data-toggle="tab">Certificate Signature 1
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_signature1_select"></b></a>
                                                                    </li>
                                                                    <li><a href="#school_signature2"
                                                                            data-toggle="tab">Certificate Signature 2
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_signature2_select"></b></a>
                                                                    </li>
                                                                    <li class="school_signature3"><a
                                                                            href="#school_signature3"
                                                                            data-toggle="tab">Certificate Signature 3
                                                                            &nbsp; <b style="color:green"
                                                                                id="school_signature3_select"></b> </a>
                                                                    </li>
                                                                </ul>
                                                            </div>

                                                            @if(auth()->user()->group == "Admin")
                                                            <div class="form-group">
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                    <select class="form-control" name="school_id"
                                                                        id="school_id">
                                                                        <option>Choose School</option>
                                                                        @foreach (auth()->user()->school->all() as
                                                                        $school)
                                                                        <option value="{{ $school->id }}"
                                                                            @if(isset($card_templateEdit)){{$card_templateEdit->school_id == $school->id ? 'selected' : ''}}
                                                                            @endif>
                                                                            {{$school->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <input type="hidden" name="school_id" id="school_id"
                                                                value="{{auth()->user()->school->id}}">
                                                            @endif

                                                            <div class="col-xs-9">
                                                                <!-- Tab panes -->
                                                                <div class="tab-content">
                                                                    <div
                                                                        style="color:red; font-family:times new roman; font-weight:bold; text-align:center; text-transform:uppercase">
                                                                        <b id="frame_message"></b></div>
                                                                    <div class="tab-pane active" id="school_sample">
                                                                        <img src="{{asset('school_images/signature/sample_certificate.jpg')}}"
                                                                            alt="" width=100%">
                                                                    </div>

                                                                    <div class="tab-pane " id="school_frame">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_frame_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="check_frame"
                                                                                                name="check_frame" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>

                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_frame_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            signature is manual, check
                                                                                            the
                                                                                            checkbox to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to uplaod signature.
                                                                                        </label>
                                                                                    </div>
                                                                                    <div id="certificate_frame_mess">
                                                                                        <i class="fas fa-crop fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">You can change
                                                                                            your frame size by applying
                                                                                            the css properties! or use
                                                                                            as default <b
                                                                                                style="color:red">[1085
                                                                                                x 760]</b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <thead class="certificate_frame_head">
                                                                                    <label for=""
                                                                                        id="certificate_frame_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i>
                                                                                        or leave default css are the
                                                                                        ones at the sample
                                                                                        template</label>
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_frame_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <th class="column-title"> Height
                                                                                        </th>
                                                                                        <th class="column-title"> Margin
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Padding</th>
                                                                                        <th class="column-title"> Size
                                                                                        </th>
                                                                                        <th class="column-title"> Repeat
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody class="certificate_frame_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_frame_width"
                                                                                                id="certificate_frame_width"
                                                                                                @if(request('certificate_frame_width')==''
                                                                                                ) value="1085px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_frame_height"
                                                                                                id="certificate_frame_height"
                                                                                                @if(request('certificate_frame_height')==''
                                                                                                ) value="760px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_frame_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_frame_margin')==''
                                                                                                ) value="30px auto"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_frame_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_frame_padding')==''
                                                                                                ) value="5mm" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_frame_float"
                                                                                                id=""
                                                                                                @if(request('certificate_frame_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_frame_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_frame_overflow')==''
                                                                                                ) value="hidden" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <thead
                                                                                        class="certificate_frame_head1">
                                                                                        <tr>
                                                                                            <th data-toggle="tooltip"
                                                                                                data-placement="top"
                                                                                                title="Card Title">
                                                                                                <span
                                                                                                    class="checkboxdesign">
                                                                                                    <label
                                                                                                        class="checkboxdesign">
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            class="checkboxdesign CheckBoxContent"
                                                                                                            id="add_frame_css1" />
                                                                                                        <span
                                                                                                            class="checkboxdesign-target"></span>
                                                                                                    </label>
                                                                                                </span>
                                                                                                Text Align
                                                                                            </th>
                                                                                            <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_frame_css1"></label>  <label for="" class="column-title">Frame Width</label></th> -->
                                                                                            <th class="column-title">
                                                                                                Text Indent</th>
                                                                                            <th class="column-title">
                                                                                                Text Decoration</th>
                                                                                            <th class="column-title">
                                                                                                Text Transform</th>
                                                                                            <th class="column-title">
                                                                                                Vertical Align</th>
                                                                                            <th class="column-title">
                                                                                                Latter Spacing</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                <tbody class="certificate_frame_body1">
                                                                                    <td class="col-md-2">
                                                                                        <select
                                                                                            name="certificate_frame_text_align"
                                                                                            id="" class="form-control">
                                                                                            <option value="">select
                                                                                            </option>
                                                                                            <option value="center">
                                                                                                center</option>
                                                                                            <option value="left">left
                                                                                            </option>
                                                                                            <option value="right">right
                                                                                            </option>
                                                                                            <option value="justify">
                                                                                                justify</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_text_indent"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_text_indent')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_text_decoration"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_text_decoration')==''
                                                                                            ) value="none" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <select
                                                                                            name="certificate_frame_text_transform"
                                                                                            id="" class="form-control">
                                                                                            <option value="">select
                                                                                            </option>
                                                                                            <option value="uppercase">
                                                                                                uppercase</option>
                                                                                            <option value="capitalize">
                                                                                                capitalize</option>
                                                                                            <option value="lowercase">
                                                                                                lowercase</option>
                                                                                        </select>
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_vertical_align"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_vertical_align')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_latter_spacing"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_latter_spacing')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                </tbody>
                                                                                <thead class="certificate_frame_head2">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_frame_css2" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Font Family
                                                                                        </th>
                                                                                        <th class="column-title">Font
                                                                                            Weight</th>
                                                                                        <th class="column-title">Font
                                                                                            Size</th>
                                                                                        <th class="column-title">Line
                                                                                            Height</th>
                                                                                        <th class="column-title">Word
                                                                                            Spacing</th>
                                                                                        <th class="column-title">White
                                                                                            Space</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="certificate_frame_body2">
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_font_family"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_font_family')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_font_weight"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_font_weight')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_font_size"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_font_size')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_line_height"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_line_height')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_word_spacing"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_word_spacing')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_white_space"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_white_space')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>

                                                                                    <thead
                                                                                        class="certificate_frame_head3">
                                                                                        <tr>
                                                                                            <th title="Card Title">
                                                                                                Border</th>
                                                                                            <th class="column-title">
                                                                                                Border Width</th>
                                                                                            <th class="column-title">
                                                                                                Border Style</th>
                                                                                            <th class="column-title">
                                                                                                Border Color</th>
                                                                                            <th class="column-title">
                                                                                                Border Radius</th>
                                                                                            <th class="column-title">Box
                                                                                                Shadow</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                <tbody class="certificate_frame_body3">
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_border"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_border')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_border_width"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_border_width')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_border_style"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_border_style')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_color"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_color')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_border_radius"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_border_radius')==''
                                                                                            ) value="2px" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_frame_box_shadow"
                                                                                            id=""
                                                                                            @if(request('certificate_frame_box_shadow')==''
                                                                                            ) value=".5px .5px 7px #000"
                                                                                            @endif class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>

                                                                    </div>

                                                                    <div class="tab-pane" id="school_background">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="frame_background_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="frame_background"
                                                                                                name="cheese"
                                                                                                value="yes" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="frame_background_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            background is empty, check
                                                                                            to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to uplaod background image
                                                                                            or color.
                                                                                        </label>
                                                                                    </div>
                                                                                    <div id="frame_background_mess">
                                                                                        <i class="fas fa-fill fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">You can apply the
                                                                                            css properties! or use as
                                                                                            default <b
                                                                                                style="color:red">[No
                                                                                                Background]</b>
                                                                                        </label>
                                                                                    </div>
                                                                                    <br>
                                                                                    <thead
                                                                                        class="frame_background_head">
                                                                                        <div>
                                                                                            <input type="file"
                                                                                                name="certificate_background_image"
                                                                                                id="select_bg_img"
                                                                                                class="form-control">
                                                                                        </div>
                                                                                        <br>
                                                                                        <label for=""
                                                                                            id="frame_background_add_css">Add
                                                                                            CSS <i
                                                                                                class="fa fa-css3 fa-lg"
                                                                                                style="color:#238AE6"
                                                                                                aria-hidden="true"></i>
                                                                                            or leave default css are the
                                                                                            ones at the sample
                                                                                            template</label>
                                                                                        <tr>
                                                                                            <th data-toggle="tooltip"
                                                                                                data-placement="top"
                                                                                                title="Card Title">
                                                                                                <span
                                                                                                    class="checkboxdesign">
                                                                                                    <label
                                                                                                        class="checkboxdesign">
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            class="checkboxdesign CheckBoxContent"
                                                                                                            id="add_frame_background_css" />
                                                                                                        <span
                                                                                                            class="checkboxdesign-target"></span>
                                                                                                    </label>
                                                                                                </span>
                                                                                                Width
                                                                                            </th>
                                                                                            <th class="column-title">
                                                                                                Height</th>
                                                                                            <th class="column-title">
                                                                                                Margin</th>
                                                                                            <th class="column-title">
                                                                                                Padding</th>
                                                                                            <th class="column-title">
                                                                                                Size</th>
                                                                                            <th class="column-title">
                                                                                                Repeat</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody
                                                                                        class="frame_background_body">
                                                                                        <tr>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_background_width"
                                                                                                    id=""
                                                                                                    @if(request('certificate_background_width')==''
                                                                                                    ) value="1085px"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_background_height"
                                                                                                    id=""
                                                                                                    @if(request('certificate_background_height')==''
                                                                                                    ) value="760px"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_background_margin"
                                                                                                    id=""
                                                                                                    @if(request('certificate_background_margin')==''
                                                                                                    ) value="30px auto"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_background_padding"
                                                                                                    id=""
                                                                                                    @if(request('certificate_background_padding')==''
                                                                                                    ) value="5mm" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_background_size"
                                                                                                    id=""
                                                                                                    @if(request('certificate_background_size')==''
                                                                                                    ) value="cover"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <select
                                                                                                    name="certificate_background_repeat"
                                                                                                    id=""
                                                                                                    class="form-control">
                                                                                                    <option value="">
                                                                                                        select</option>
                                                                                                    <option
                                                                                                        value="repeat">
                                                                                                        repeat</option>
                                                                                                    <option
                                                                                                        value="no-repeat">
                                                                                                        no-repeat
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="repeat-x">
                                                                                                        repeat-x
                                                                                                    </option>
                                                                                                    <option
                                                                                                        value="repeat">
                                                                                                        space</option>
                                                                                                    <option
                                                                                                        value="repeat">
                                                                                                        round</option>
                                                                                                </select>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                    <thead
                                                                                        class="frame_background_head1">
                                                                                        <tr>
                                                                                            <th title="Card Title">
                                                                                                Color</th>
                                                                                            <th class="column-title">
                                                                                                Overflow</th>
                                                                                            <th class="column-title">
                                                                                                Opacity</th>
                                                                                            <th class="column-title">Box
                                                                                                shadow</th>
                                                                                            <th class="column-title">
                                                                                                Border Radius</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody
                                                                                        class="frame_background_body1">
                                                                                        <tr>
                                                                                            <td class="col-md-2">
                                                                                                <input type="color"
                                                                                                    name="certificate_background_color"
                                                                                                    id=""
                                                                                                    @if(request('certificate_background_color')==''
                                                                                                    ) value="#ffffff"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_background_overflow"
                                                                                                    id=""
                                                                                                    @if(request('certificate_background_overflow')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_background_opacity"
                                                                                                    id=""
                                                                                                    @if(request('certificate_background_opacity')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_background_box_shadow"
                                                                                                    id=""
                                                                                                    @if(request('certificate_background_box_shadow')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_background_border_radius"
                                                                                                    id=""
                                                                                                    @if(request('certificate_background_border_radius')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <div class="tab-pane" id="school_name">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_school_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_school_name"
                                                                                                name="certificate_company_name" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>

                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_school_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            certificate will use the
                                                                                            default settings clcik to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to add custom settings.
                                                                                        </label>
                                                                                    </div>
                                                                                    <div id="certificate_school_mess">
                                                                                        <!-- <i class="fab fa-acquisitions-incorporated"></i> -->
                                                                                        <i class="fab fa-acquisitions-incorporated fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">You can add size
                                                                                            by applying the css
                                                                                            properties! or use as
                                                                                            default <b
                                                                                                style="color:red"></b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <thead
                                                                                    class="certificate_school_name_head">
                                                                                    <label for=""
                                                                                        id="certificate_school_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i>
                                                                                        or leave default css are the
                                                                                        ones at the sample
                                                                                        template</label>
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_name_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <th class="column-title"> Height
                                                                                        </th>
                                                                                        <th class="column-title"> Margin
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Padding</th>
                                                                                        <th class="column-title"> Size
                                                                                        </th>
                                                                                        <th class="column-title"> Repeat
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_school_name_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_width"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_height"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_margin')==''
                                                                                                ) value="5px 0 0 0"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_padding')==''
                                                                                                ) value="35px 0 0 0"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_float"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <thead
                                                                                        class="certificate_company_name_head1">
                                                                                        <tr>
                                                                                </tbody>
                                                                                <thead
                                                                                    class="certificate_school_name_head1">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_name_css1" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Text Align
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_name_css1"></label>  <label for="" class="column-title"> Text Align</label></th> -->
                                                                                        <th class="column-title">Text
                                                                                            Indent</th>
                                                                                        <th class="column-title">Text
                                                                                            Decoration</th>
                                                                                        <th class="column-title">Text
                                                                                            Transform</th>
                                                                                        <th class="column-title">
                                                                                            Vertical Align</th>
                                                                                        <th class="column-title">Latter
                                                                                            Spacing</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_school_name_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_text_align"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_text_align')==''
                                                                                                ) value="center" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_text_indent"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_text_indent')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_text_decoration"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_text_decoration')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_text_transform"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_text_transform')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_vertical_align"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_vertical_align')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_latter_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_latter_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                </tbody>
                                                                                <thead
                                                                                    class="certificate_school_name_head2">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_name_css2" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Font Family
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_name_css2"></label>  <label for="" class="column-title">Font Family</label></th> -->
                                                                                        <th class="column-title">Font
                                                                                            Weight</th>
                                                                                        <th class="column-title">Font
                                                                                            Size</th>
                                                                                        <th class="column-title">Line
                                                                                            Height</th>
                                                                                        <th class="column-title">Word
                                                                                            Spacing</th>
                                                                                        <th class="column-title">White
                                                                                            Space</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_school_name_body2">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_font_family"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_font_family')==''
                                                                                                ) value="serif" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_font_weight"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_font_weight')==''
                                                                                                ) value="bold" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_font_size"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_font_size')==''
                                                                                                ) value="44px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_line_height"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_line_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_word_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_word_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_display"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_display')==''
                                                                                                ) value="block" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                                <thead
                                                                                    class="certificate_school_name_head3">
                                                                                    <tr>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_name_css2"></label>  <label for="" class="column-title">Font Family</label></th> -->
                                                                                        <th title="Card Title">Border
                                                                                        </th>
                                                                                        <th class="column-title">Border
                                                                                            Width</th>
                                                                                        <th class="column-title">Border
                                                                                            Style</th>
                                                                                        <th class="column-title">Border
                                                                                            Color</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                        <th class="column-title">Box
                                                                                            Shodow</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_school_name_body3">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_border"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_border')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_border_width"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_border_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_border_style"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_border_style')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_color"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_color')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_name_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_company_name_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>

                                                                    </div>

                                                                    <div class="tab-pane" id="school_logo">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_logo_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_logo"
                                                                                                name="certificate_logo" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>

                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_logo_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            logo will use the system
                                                                                            logo, check
                                                                                            to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to uplaod logo. or use
                                                                                            default
                                                                                        </label>
                                                                                    </div>
                                                                                    <div id="certificate_logo_mess">
                                                                                        <i class="fas fa-logo fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">You can add logo
                                                                                            size by applying the css
                                                                                            properties! or use as
                                                                                            default <b
                                                                                                style="color:red">[110px
                                                                                                X 110px]</b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <thead class="certificate_logo_head">
                                                                                    <input type="file"
                                                                                        name="select_logo_img"
                                                                                        id="select_logo_img"
                                                                                        class="form-control">
                                                                                    <br>
                                                                                    <label for=""
                                                                                        id="certificate_logo_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i>
                                                                                        or leave default css are the
                                                                                        ones at the sample
                                                                                        template</label>
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_logo_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <th class="column-title"> Height
                                                                                        </th>
                                                                                        <th class="column-title"> Margin
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Padding</th>
                                                                                        <th class="column-title"> Size
                                                                                        </th>
                                                                                        <th class="column-title"> Repeat
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="certificate_logo_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_logo_width"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_width')==''
                                                                                                ) value="110px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_logo_height"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_height')==''
                                                                                                ) value="110px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_logo_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_margin')==''
                                                                                                )
                                                                                                value="0 300px 0 500px"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_logo_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_padding')==''
                                                                                                ) value="5px 0 0 0"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_logo_float"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_logo_display"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_display')==''
                                                                                                ) value="block" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>

                                                                                </tbody>
                                                                                <thead class="certificate_logo_head1">
                                                                                    <tr>
                                                                                        <th title="Card Title"> Color
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Overflow</th>
                                                                                        <th class="column-title">
                                                                                            Opacity</th>
                                                                                        <th class="column-title">Box
                                                                                            shadow</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="certificate_logo_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="color"
                                                                                                name="certificate_logo_color"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_color')==''
                                                                                                ) value="#ffffff" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_logo_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_logo_opacity"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_opacity')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_logo_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_logo_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_logo_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <div class="tab-pane" id="school_address">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">

                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_address_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_address"
                                                                                                name="certificate_company_address" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>

                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_address_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            address is the system
                                                                                            address, check
                                                                                            to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to add address. or use
                                                                                            default
                                                                                        </label>
                                                                                    </div>
                                                                                    <div id="certificate_address_mess">
                                                                                        <i class="fas fa-map-marked-alt fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">You can add
                                                                                            address size by applying the
                                                                                            css properties! or use as
                                                                                            default <b
                                                                                                style="color:red"></b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <thead class="certificate_address_head">
                                                                                    <label for=""
                                                                                        id="certificate_address_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i>
                                                                                        or leave default css are the
                                                                                        ones at the sample
                                                                                        template</label>
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_address_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <th class="column-title"> Height
                                                                                        </th>
                                                                                        <th class="column-title"> Margin
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Padding</th>
                                                                                        <th class="column-title"> Size
                                                                                        </th>
                                                                                        <th class="column-title"> Repeat
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody class="certificate_address_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_width"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_height"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_margin')==''
                                                                                                ) value=" " @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_padding')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_float"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_address_head1">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_address_css1" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Text Align
                                                                                        </th>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title"><label
                                                                                                class="fa fa-plus-circle fa-lg"
                                                                                                style="color:#1ABB9C; cursor:pointer;"><input
                                                                                                    type="checkbox"
                                                                                                    style="display:none"
                                                                                                    class=" checkboxdesign"
                                                                                                    id="add_address_css1"></label>
                                                                                            <label for=""
                                                                                                class="column-title">
                                                                                                Text
                                                                                                Align</label></th>
                                                                                        <th class="column-title">Text
                                                                                            Indent</th>
                                                                                        <th class="column-title">Text
                                                                                            Decoration</th>
                                                                                        <th class="column-title">Text
                                                                                            Transform</th>
                                                                                        <th class="column-title">
                                                                                            Vertical Align</th>
                                                                                        <th class="column-title">Latter
                                                                                            Spacing</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_address_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_text_align"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_text_align')==''
                                                                                                ) value="center" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_text_indent"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_text_indent')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_text_decoration"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_text_decoration')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_text_transform"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_text_transform')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_vertical_align"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_vertical_align')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_latter_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_latter_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_address_head2">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_address_css2" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Font Family
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_address_css2"></label>  <label for="" class="column-title"> Font Family</label></th> -->
                                                                                        <th class="column-title">Font
                                                                                            Weight</th>
                                                                                        <th class="column-title">Font
                                                                                            Size</th>
                                                                                        <th class="column-title">Line
                                                                                            Height</th>
                                                                                        <th class="column-title">Word
                                                                                            Spacing</th>
                                                                                        <th class="column-title">Display
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_address_body2">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_font_family"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_font_family')==''
                                                                                                ) value="serif" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_font_weight"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_font_weight')==''
                                                                                                ) value="normal" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_font_size"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_font_size')==''
                                                                                                ) value="0 0 0 0" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_line_height"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_line_height')==''
                                                                                                ) value="0 0 0 0" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_word_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_word_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_display"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_display')==''
                                                                                                ) value="block" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_address_head3">
                                                                                    <tr>
                                                                                        <th title="Card Title">Border
                                                                                        </th>
                                                                                        <th class="column-title">Border
                                                                                            Width</th>
                                                                                        <th class="column-title">Border
                                                                                            Style</th>
                                                                                        <th class="column-title">Border
                                                                                            Color</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                        <th class="column-title">Box
                                                                                            Shodow</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_address_body3">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_border"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_border')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_border_width"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_border_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_border_style"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_border_style')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_color"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_color')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_company_address_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_company_address_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <div class="tab-pane" id="school_title">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_title_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_title"
                                                                                                name="certificate_company_title" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>

                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_title_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            title will use the system
                                                                                            title, check
                                                                                            to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to add title. or use default
                                                                                        </label>
                                                                                    </div>
                                                                                    <div id="certificate_title_mess">
                                                                                        <i class="fas fa-title fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">You can add title
                                                                                            size by applying the css
                                                                                            properties! or use as
                                                                                            default <b
                                                                                                style="color:red">[font
                                                                                                Bold]</b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <thead class="certificate_title_head">
                                                                                    <textarea
                                                                                        name="certificate_title_text"
                                                                                        id="certificate_title_content"
                                                                                        cols="5" rows="5"
                                                                                        class="form-control certificate_title_content"
                                                                                        placeholder="Enter Certificate Title            Example [CERTIFICATE OF APPRECIATION]"></textarea>
                                                                                    <br>
                                                                                    <label for=""
                                                                                        id="certificate_title_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i>
                                                                                        or leave default css are the
                                                                                        ones at the sample
                                                                                        template</label>
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_title_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <th class="column-title"> Height
                                                                                        </th>
                                                                                        <th class="column-title"> Margin
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Padding</th>
                                                                                        <th class="column-title"> Size
                                                                                        </th>
                                                                                        <th class="column-title"> Repeat
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="certificate_title_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_width"
                                                                                                id=""
                                                                                                @if(request('certificate_title_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_height"
                                                                                                id=""
                                                                                                @if(request('certificate_title_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_title_margin')==''
                                                                                                ) value="0 0 35px 0"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_title_padding')==''
                                                                                                ) value="35px 0 0 0"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_float"
                                                                                                id=""
                                                                                                @if(request('certificate_title_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_title_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead class="certificate_title_head1">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_title_css1" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Text Align
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_title_css1"></label>  <label for="" class="column-title"> Text Align</label></th> -->
                                                                                        <th class="column-title">Text
                                                                                            Indent</th>
                                                                                        <th class="column-title">Text
                                                                                            Decoration</th>
                                                                                        <th class="column-title">Text
                                                                                            Transform</th>
                                                                                        <th class="column-title">
                                                                                            Vertical Align</th>
                                                                                        <th class="column-title">Latter
                                                                                            Spacing</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody class="certificate_title_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_text_align"
                                                                                                id=""
                                                                                                @if(request('certificate_title_text_align')==''
                                                                                                ) value="center" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_text_indent"
                                                                                                id=""
                                                                                                @if(request('certificate_title_text_indent')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_text_decoration"
                                                                                                id=""
                                                                                                @if(request('certificate_title_text_decoration')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_text_transform"
                                                                                                id=""
                                                                                                @if(request('certificate_title_text_transform')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_vertical_align"
                                                                                                id=""
                                                                                                @if(request('certificate_title_vertical_align')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_latter_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_title_latter_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead class="certificate_title_head2">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_title_css2" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Font Family
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_title_css2"></label>  <label for="" class="column-title"> Font Family</label></th> -->
                                                                                        <th class="column-title">Font
                                                                                            Weight</th>
                                                                                        <th class="column-title">Font
                                                                                            Size</th>
                                                                                        <th class="column-title">Line
                                                                                            Height</th>
                                                                                        <th class="column-title">Word
                                                                                            Spacing</th>
                                                                                        <th class="column-title">Display
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody class="certificate_title_body2">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_font_family"
                                                                                                id=""
                                                                                                @if(request('certificate_title_font_family')==''
                                                                                                ) value="serif" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_font_weight"
                                                                                                id=""
                                                                                                @if(request('certificate_title_font_weight')==''
                                                                                                ) value="bold" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_font_size"
                                                                                                id=""
                                                                                                @if(request('certificate_title_font_size')==''
                                                                                                ) value="30px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_line_height"
                                                                                                id=""
                                                                                                @if(request('certificate_title_line_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_word_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_title_word_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_font_display"
                                                                                                id=""
                                                                                                @if(request('certificate_title_font_display')==''
                                                                                                ) value="block" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead class="certificate_title_head3">
                                                                                    <tr>
                                                                                        <th title="Card Title">Border
                                                                                        </th>
                                                                                        <th class="column-title">Border
                                                                                            Width</th>
                                                                                        <th class="column-title">Border
                                                                                            Style</th>
                                                                                        <th class="column-title">Border
                                                                                            Color</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                        <th class="column-title">Box
                                                                                            Shodow</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="certificate_title_body3">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_border"
                                                                                                id=""
                                                                                                @if(request('certificate_title_border')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_border_width"
                                                                                                id=""
                                                                                                @if(request('certificate_title_border_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_border_style"
                                                                                                id=""
                                                                                                @if(request('certificate_title_border_style')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_color"
                                                                                                id=""
                                                                                                @if(request('certificate_title_color')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_title_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_title_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_title_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <div class="tab-pane" id="school_certify">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_certify_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_certify"
                                                                                                name="certificate_company_certify" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>

                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_certify_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            certify will use the system
                                                                                            certify, check
                                                                                            to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to add certify. or use
                                                                                            default
                                                                                        </label>
                                                                                    </div>
                                                                                    <div id="certificate_certify_mess">
                                                                                        <i class="fas fa-certify fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">You can add
                                                                                            certify size by applying the
                                                                                            css properties! or use as
                                                                                            default <b
                                                                                                style="color:red">[110px
                                                                                                X 110px]</b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <thead class="certificate_certify_head">
                                                                                    <textarea
                                                                                        name="certificate_certify_content"
                                                                                        id="certificate_certify_content"
                                                                                        cols="5" rows="5"
                                                                                        class="form-control certificate_certify_content"
                                                                                        placeholder="Enter Certify note            Example [THIS IS TO CERTIFY THAT] "></textarea>
                                                                                    <br>
                                                                                    <label for=""
                                                                                        id="certificate_certify_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i>
                                                                                        or leave default css are the
                                                                                        ones at the sample
                                                                                        template</label>
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card certify">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_certify_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <th class="column-title"> Height
                                                                                        </th>
                                                                                        <th class="column-title"> Margin
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Padding</th>
                                                                                        <th class="column-title"> Size
                                                                                        </th>
                                                                                        <th class="column-title"> Repeat
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="certificate_certify_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_width"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_height"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_margin')==''
                                                                                                ) value="0 0 0 0" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_padding')==''
                                                                                                ) value="0 0 0 0" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_float"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_certify_head1">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_certify_css1" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Text Align
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_certify_css1"></label>  <label for="" class="column-title"> Text Align</label></th> -->
                                                                                        <th class="column-title">Text
                                                                                            Indent</th>
                                                                                        <th class="column-title">Text
                                                                                            Decoration</th>
                                                                                        <th class="column-title">Text
                                                                                            Transform</th>
                                                                                        <th class="column-title">
                                                                                            Vertical Align</th>
                                                                                        <th class="column-title">Latter
                                                                                            Spacing</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_certify_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_text_align"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_text_align')==''
                                                                                                ) value="center" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_text_indent"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_text_indent')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_text_decoration"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_text_decoration')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_text_transform"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_text_transform')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_vertical_align"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_vertical_align')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_latter_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_latter_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_certify_head2">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_certify_css2" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Font Family
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_certify_css2"></label>  <label for="" class="column-title"> Font Family</label></th> -->
                                                                                        <th class="column-title">Font
                                                                                            Weight</th>
                                                                                        <th class="column-title">Font
                                                                                            Size</th>
                                                                                        <th class="column-title">Line
                                                                                            Height</th>
                                                                                        <th class="column-title">Word
                                                                                            Spacing</th>
                                                                                        <th class="column-title">Display
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_certify_body2">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_font_family"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_font_family')==''
                                                                                                ) value="serif" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_font_weight"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_font_weight')==''
                                                                                                ) value="normal" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_font_size"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_font_size')==''
                                                                                                ) value="20px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_line_height"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_line_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_word_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_word_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_display"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_display')==''
                                                                                                ) value="block" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_certify_head3">
                                                                                    <tr>
                                                                                        <th title="Card Title">Border
                                                                                        </th>
                                                                                        <th class="column-title">Border
                                                                                            Width</th>
                                                                                        <th class="column-title">Border
                                                                                            Style</th>
                                                                                        <th class="column-title">Border
                                                                                            Color</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                        <th class="column-title">Box
                                                                                            Shodow</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_certify_body3">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_border"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_border')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_border_width"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_border_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_border_style"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_border_style')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_color"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_color')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_certify_title_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_certify_title_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>

                                                                    </div>

                                                                    <div class="tab-pane" id="school_holder">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_holdername_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_holdername"
                                                                                                name="certificate_company_holdername" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>

                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_holdername_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            holder name is disbaled,
                                                                                            check
                                                                                            to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to add holder name. or use
                                                                                            default
                                                                                        </label>
                                                                                    </div>
                                                                                    <div
                                                                                        id="certificate_holdername_mess">
                                                                                        <i class="fas fa-holdername fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">You can add size
                                                                                            by applying the css
                                                                                            properties! or use as
                                                                                            default <b
                                                                                                style="color:red">[Firstname
                                                                                                Lastname]</b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <thead
                                                                                    class="certificate_holdername_head">
                                                                                    <textarea
                                                                                        name="certificate_holdername_content"
                                                                                        id="certificate_holdername_content"
                                                                                        cols="5" rows="5"
                                                                                        class="form-control certificate_holdername_content"
                                                                                        placeholder="Enter holdername note            Example [THIS IS TO holdername THAT] "></textarea>
                                                                                    <br>
                                                                                    <label for=""
                                                                                        id="certificate_holdername_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i>
                                                                                        or leave default css are the
                                                                                        ones at the sample
                                                                                        template</label>
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card holdername">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_holdername_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <th class="column-title"> Height
                                                                                        </th>
                                                                                        <th class="column-title"> Margin
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Padding</th>
                                                                                        <th class="column-title"> Size
                                                                                        </th>
                                                                                        <th class="column-title"> Repeat
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_holdername_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_width"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_height"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_margin')==''
                                                                                                ) value="10px 0 10px 0"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_padding')==''
                                                                                                ) value="0 0 0 0" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_float"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_holdername_head1">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_holdername_css1" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Text Align
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_holdername_css1"></label>  <label for="" class="column-title"> Text Align</label></th> -->
                                                                                        <th class="column-title">Text
                                                                                            Indent</th>
                                                                                        <th class="column-title">Text
                                                                                            Decoration</th>
                                                                                        <th class="column-title">Text
                                                                                            Transform</th>
                                                                                        <th class="column-title">
                                                                                            Vertical Align</th>
                                                                                        <th class="column-title">Latter
                                                                                            Spacing</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_holdername_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_text_align"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_text_align')==''
                                                                                                ) value="center" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_text_indent"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_text_indent')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_text_decoration"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_text_decoration')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_text_transform"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_text_transform')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_vertical_align"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_vertical_align')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_latter_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_latter_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_holdername_head2">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_holdername_css2" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Font Family
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_holdername_css2"></label>  <label for="" class="column-title"> Font Family</label></th> -->
                                                                                        <th class="column-title">Font
                                                                                            Weight</th>
                                                                                        <th class="column-title">Font
                                                                                            Size</th>
                                                                                        <th class="column-title">Line
                                                                                            Height</th>
                                                                                        <th class="column-title">Word
                                                                                            Spacing</th>
                                                                                        <th class="column-title">Display
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_holdername_body2">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_font_family"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_font_family')==''
                                                                                                ) value="serif" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_font_weight"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_font_weight')==''
                                                                                                ) value="bold" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_font_size"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_font_size')==''
                                                                                                ) value="50px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_line_height"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_line_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_word_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_word_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_display"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_display')==''
                                                                                                ) value="block" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                                <thead
                                                                                    class="certificate_holdername_head3">
                                                                                    <tr>
                                                                                        <th title="Card Title">Border
                                                                                        </th>
                                                                                        <th class="column-title">Border
                                                                                            Width</th>
                                                                                        <th class="column-title">Border
                                                                                            Style</th>
                                                                                        <th class="column-title">Border
                                                                                            Color</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                        <th class="column-title">Box
                                                                                            Shodow</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_holdername_body3">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_border"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_border')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_border_width"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_border_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_border_style"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_border_style')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_color"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_color')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_holder_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_holder_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>

                                                                    </div>

                                                                    <div class="tab-pane" id="school_information">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_information_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_information"
                                                                                                name="certificate_company_information" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>

                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_information_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            information is empty, check
                                                                                            to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to add information. or use
                                                                                            default
                                                                                        </label>
                                                                                    </div>
                                                                                    <div
                                                                                        id="certificate_information_mess">
                                                                                        <i class="fas fa-information fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">You can add size
                                                                                            by applying the css
                                                                                            properties! or use as
                                                                                            default <b
                                                                                                style="color:red">[Certificate
                                                                                                Information]</b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <thead
                                                                                    class="certificate_information_head">
                                                                                    <textarea
                                                                                        name="certificate_information_text"
                                                                                        id="certificate_information_content"
                                                                                        cols="5" rows="5"
                                                                                        class="form-control certificate_information_content"
                                                                                        placeholder="Enter Certificate Information            Example [ABOUT THE ACHEIVEMENT OF THE HOLDER]"></textarea>
                                                                                    <br>
                                                                                    <label for=""
                                                                                        id="certificate_information_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i>
                                                                                        or leave default css are the
                                                                                        ones at the sample
                                                                                        template</label>
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card information">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_information_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <th class="column-title"> Height
                                                                                        </th>
                                                                                        <th class="column-title"> Margin
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Padding</th>
                                                                                        <th class="column-title"> Size
                                                                                        </th>
                                                                                        <th class="column-title"> Repeat
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_information_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_width"
                                                                                                id=""
                                                                                                @if(request('certificate_information_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_height"
                                                                                                id=""
                                                                                                @if(request('certificate_information_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_information_margin')==''
                                                                                                ) value="5px 0 0 0"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_information_padding')==''
                                                                                                )
                                                                                                value="0px 120px 0px 160px	"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_float"
                                                                                                id=""
                                                                                                @if(request('certificate_information_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_information_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_information_head1">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_information_css1" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Text Align
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_information_css1"></label>  <label for="" class="column-title"> Text Align</label></th> -->
                                                                                        <th class="column-title">Text
                                                                                            Indent</th>
                                                                                        <th class="column-title">Text
                                                                                            Decoration</th>
                                                                                        <th class="column-title">Text
                                                                                            Transform</th>
                                                                                        <th class="column-title">
                                                                                            Vertical Align</th>
                                                                                        <th class="column-title">Latter
                                                                                            Spacing</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_information_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_text_align"
                                                                                                id=""
                                                                                                @if(request('certificate_information_text_align')==''
                                                                                                ) value="center" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_text_indent"
                                                                                                id=""
                                                                                                @if(request('certificate_information_text_indent')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_text_decoration"
                                                                                                id=""
                                                                                                @if(request('certificate_information_text_decoration')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_text_transform"
                                                                                                id=""
                                                                                                @if(request('certificate_information_text_transform')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_vertical_align"
                                                                                                id=""
                                                                                                @if(request('certificate_information_vertical_align')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_latter_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_information_latter_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_information_head2">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_information_css2" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Font Family
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_information_css2"></label>  <label for="" class="column-title"> Font Family</label></th> -->
                                                                                        <th class="column-title">Font
                                                                                            Weight</th>
                                                                                        <th class="column-title">Font
                                                                                            Size</th>
                                                                                        <th class="column-title">Line
                                                                                            Height</th>
                                                                                        <th class="column-title">Word
                                                                                            Spacing</th>
                                                                                        <th class="column-title">Display
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_information_body2">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_font_family"
                                                                                                id=""
                                                                                                @if(request('certificate_information_font_family')==''
                                                                                                ) value="serif" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_font_weight"
                                                                                                id=""
                                                                                                @if(request('certificate_information_font_weight')==''
                                                                                                ) value="normal" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_font_size"
                                                                                                id=""
                                                                                                @if(request('certificate_information_font_size')==''
                                                                                                ) value="22px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_line_height"
                                                                                                id=""
                                                                                                @if(request('certificate_information_line_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_word_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_information_word_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_display"
                                                                                                id=""
                                                                                                @if(request('certificate_information_white_space')==''
                                                                                                ) value="block" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_information_head3">
                                                                                    <tr>
                                                                                        <th title="Card Title">Border
                                                                                        </th>
                                                                                        <th class="column-title">Border
                                                                                            Width</th>
                                                                                        <th class="column-title">Border
                                                                                            Style</th>
                                                                                        <th class="column-title">Border
                                                                                            Color</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                        <th class="column-title">Box
                                                                                            Shodow</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_information_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_border"
                                                                                                id=""
                                                                                                @if(request('certificate_information_border')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_border_width"
                                                                                                id=""
                                                                                                @if(request('certificate_information_border_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_border_style"
                                                                                                id=""
                                                                                                @if(request('certificate_information_border_style')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_color"
                                                                                                id=""
                                                                                                @if(request('certificate_information_color')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_information_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_information_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_information_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>
                                                                    </div>

                                                                    <div class="tab-pane" id="school_issue">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_issue_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_issue_date"
                                                                                                name="certificate_company_information" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>

                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_issue_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            information is empty, check
                                                                                            to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to add information. or use
                                                                                            default
                                                                                        </label>
                                                                                    </div>
                                                                                    <div id="certificate_issue_mess">
                                                                                        <i class="fas fa-information fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">You can add size
                                                                                            by applying the css
                                                                                            properties! or use as
                                                                                            default <b
                                                                                                style="color:red">[Certificate
                                                                                                Information]</b>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <thead
                                                                                    class="certificate_issue_date_head">
                                                                                    <input type="text"
                                                                                        name="certificate_issue_date_value"
                                                                                        id="certificate_issue_date_content"
                                                                                        class="form-control"
                                                                                        placeholder="select issue date"
                                                                                        autocomplate="off">
                                                                                    <br>
                                                                                    <label for=""
                                                                                        id="certificate_issue_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i>
                                                                                        or leave default css are the
                                                                                        ones at the sample
                                                                                        template</label>
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card information">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_issue_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <th class="column-title"> Height
                                                                                        </th>
                                                                                        <th class="column-title"> Margin
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Padding</th>
                                                                                        <th class="column-title"> Size
                                                                                        </th>
                                                                                        <th class="column-title"> Repeat
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_issue_date_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_width"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_height"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_margin')==''
                                                                                                ) value="5px 0 0 0"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_padding')==''
                                                                                                )
                                                                                                value="0px 120px 0px 160px"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_float"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_issue_date_head1">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_issue_css1" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Text Align
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_issue_css1"></label>  <label for="" class="column-title"> Text Align</label></th> -->
                                                                                        <th class="column-title">Text
                                                                                            Indent</th>
                                                                                        <th class="column-title">Text
                                                                                            Decoration</th>
                                                                                        <th class="column-title">Text
                                                                                            Transform</th>
                                                                                        <th class="column-title">
                                                                                            Vertical Align</th>
                                                                                        <th class="column-title">Latter
                                                                                            Spacing</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_issue_date_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_text_align"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_text_align')==''
                                                                                                ) value="center" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_text_indent"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_text_indent')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_text_decoration"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_text_decoration')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_text_transform"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_text_transform')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_vertical_align"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_vertical_align')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_latter_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_latter_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_issue_date_head2">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_issue_css2" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Font Family
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_issue_css2"></label>  <label for="" class="column-title"> Font Family</label></th> -->
                                                                                        <th class="column-title">Font
                                                                                            Weight</th>
                                                                                        <th class="column-title">Font
                                                                                            Size</th>
                                                                                        <th class="column-title">Line
                                                                                            Height</th>
                                                                                        <th class="column-title">Word
                                                                                            Spacing</th>
                                                                                        <th class="column-title">Display
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_issue_date_body2">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_font_family"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_font_family')==''
                                                                                                ) value="serif" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_font_weight"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_font_weight')==''
                                                                                                ) value="normal" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_font_size"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_font_size')==''
                                                                                                ) value="22px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_line_height"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_line_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_word_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_word_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_display"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_white_space')==''
                                                                                                ) value="block" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_issue_date_head3">
                                                                                    <tr>
                                                                                        <th title="Card Title">Border
                                                                                        </th>
                                                                                        <th class="column-title">Border
                                                                                            Width</th>
                                                                                        <th class="column-title">Border
                                                                                            Style</th>
                                                                                        <th class="column-title">Border
                                                                                            Color</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                        <th class="column-title">Box
                                                                                            Shodow</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_issue_date_body3">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_border"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_border')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_border_width"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_border_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_border_style"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_border_style')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_color"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_color')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_issue_date_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_issue_date_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>

                                                                    </div>

                                                                    <div class="tab-pane" id="school_signature1">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_signature1_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_signature1"
                                                                                                name="certificate_signature1" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_signature1_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a second signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            second signature person 1 is
                                                                                            disbaled, check the
                                                                                            checkbox to <b
                                                                                                style="color:red">Enable</b>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div
                                                                                        id="certificate_signature1_mess">
                                                                                        <i class="far fa-keyboard fa-lg"
                                                                                            style="color:blue;"> </i>
                                                                                        <label for="">Now you can add
                                                                                            the signature person
                                                                                            name!</label>
                                                                                    </div>
                                                                                </div>
                                                                                <thead
                                                                                    class="certificate_signature1_head">
                                                                                    <br>
                                                                                    <input type="text"
                                                                                        name="signature_person1_text"
                                                                                        placeholder="Enter Signature person Name     Example [Head Master] [Teacher] [Student]"
                                                                                        id="signature_person1"
                                                                                        class="form-control">
                                                                                    <br>
                                                                                    <label for=""
                                                                                        id="certificate_signature1_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i> or
                                                                                        leave default css are the ones
                                                                                        at the sample template</label>
                                                                                    <tr>
                                                                                        <th class="column-title1">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_signature1_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_signature2_css"></label>  <label for="" class="column-title"> Width</label></th> -->
                                                                                        <th class="column-title">Height
                                                                                        </th>
                                                                                        <th class="column-title">Margin
                                                                                        </th>
                                                                                        <th class="column-title">Padding
                                                                                        </th>
                                                                                        <th class="column-title">Float
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Overflow</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_signature1_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_width"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_height"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_margin')==''
                                                                                                ) value="10px 0 0 40px"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_padding')==''
                                                                                                ) value="22px 0 0 0"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_float"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_signature1_head1">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_signature1_css1" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Text Align
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_signature1_css1"></label>  <label for="" class="column-title"> Text Align</label></th> -->
                                                                                        <th class="column-title">Text
                                                                                            Indent</th>
                                                                                        <th class="column-title">Text
                                                                                            Decoration</th>
                                                                                        <th class="column-title">Text
                                                                                            Transform</th>
                                                                                        <th class="column-title">
                                                                                            Vertical Align</th>
                                                                                        <th class="column-title">Latter
                                                                                            Spacing</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_signature1_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_text_align"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_text_align')==''
                                                                                                ) value="center" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_text_indent"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_text_indent')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_text_decoration"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_text_decoration')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_text_transform"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_text_transform')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_vertical_align"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_vertical_align')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_latter_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_latter_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_signature1_head2">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_signature1_css2" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Font Family
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_signature1_css2"></label>  <label for="" class="column-title"> Font Family</label></th> -->
                                                                                        <th class="column-title">Font
                                                                                            Weight</th>
                                                                                        <th class="column-title">Font
                                                                                            Size</th>
                                                                                        <th class="column-title">Line
                                                                                            Height</th>
                                                                                        <th class="column-title">Word
                                                                                            Spacing</th>
                                                                                        <th class="column-title">White
                                                                                            Space</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_signature1_body2">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_font_family"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_font_family')==''
                                                                                                ) value="serif" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_font_weight"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_font_weight')==''
                                                                                                ) value="bold" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_font_size"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_font_size')==''
                                                                                                ) value="22px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_line_height"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_line_height')==''
                                                                                                ) value="22px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_word_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_word_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_white_space"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_white_space')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_signature1_head3">
                                                                                    <tr>
                                                                                        <th title="Card Title">Border
                                                                                        </th>
                                                                                        <th class="column-title">Border
                                                                                            Width</th>
                                                                                        <th class="column-title">Border
                                                                                            Style</th>
                                                                                        <th class="column-title">Border
                                                                                            Color</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                        <th class="column-title">Box
                                                                                            Shodow</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_signature1_body3">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_border"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_border')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_border_width"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_border_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_border_style"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_border_style')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_color"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_color')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature1_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_signature1_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>

                                                                        <div class="" id="signatureImg1">
                                                                            <table
                                                                                class="table table-striped table-bordered bulk_action "
                                                                                cellspacing="0" width="100%">
                                                                                <div class="col-md-2">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <i class="fas fa-signature fa-spin certificate_signature1_img_enable"
                                                                                                style="font-size:30px; cursor:pointer"></i>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_signature1img"
                                                                                                name="signature_enable_1" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_signature1_img_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a first signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            signature is manual, check
                                                                                            the
                                                                                            checkbox to <b
                                                                                                style="color:red">Enable</b>
                                                                                            to uplaod signature.
                                                                                        </label>
                                                                                    </div>
                                                                                    <div
                                                                                        id="certificate_signature1_img_mess">
                                                                                        <i class="fas fa-signature fa-lg"
                                                                                            style="color:rgb(42,63,84);">
                                                                                        </i>
                                                                                        <label for="">Now you can add
                                                                                            signature image! or leave it
                                                                                            as manual line
                                                                                            ------------------------------------</label>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <thead
                                                                                    class="certificate_signature1img_head">
                                                                                    <div>
                                                                                        <input type="file"
                                                                                            name="certificate_signature_img_1_url"
                                                                                            id="select_signature1_img"
                                                                                            class="form-control">
                                                                                    </div>
                                                                                    <br>
                                                                                    <label for=""
                                                                                        id="certificate_signature1_img_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i>
                                                                                        or leave default css are the
                                                                                        ones at the sample
                                                                                        template</label>
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_signature1img_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <th class="column-title"> Height
                                                                                        </th>
                                                                                        <th class="column-title"> Margin
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Padding</th>
                                                                                        <th class="column-title"> Size
                                                                                        </th>
                                                                                        <th class="column-title"> Repeat
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>


                                                                                <tbody
                                                                                    class="certificate_signature1img_body">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_width"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_width')==''
                                                                                                ) value="130px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_height"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_height')==''
                                                                                                ) value="70px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_margin')==''
                                                                                                ) value="0 0 0 0" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_padding')==''
                                                                                                ) value="0" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_font_size"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_font_size')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_repeat"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_repeat')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_signature1img_head1">
                                                                                    <tr>
                                                                                        <th title="Card Title"> Color
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Overflow</th>
                                                                                        <th class="column-title">
                                                                                            Opacity</th>
                                                                                        <th class="column-title">Box
                                                                                            shadow</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_signature1img_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_color"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_color')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_opacity"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_opacity')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_img_signature1_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_img_signature1_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane" id="school_signature2">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">

                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <span class="bigcheck">
                                                                                        <label class="bigcheck">
                                                                                            <b
                                                                                                id="certificate_signature2_enable"></b>
                                                                                            <input type="checkbox"
                                                                                                class="bigcheck CheckBoxContent"
                                                                                                id="certificate_signature2"
                                                                                                name="certificate_signature2" />
                                                                                            <span
                                                                                                class="bigcheck-target"></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-md-9"
                                                                                    style="margin-top:19px">
                                                                                    <div class=""
                                                                                        id="certificate_signature2_info">
                                                                                        <b class="fa fa-info-circle fa-lg"
                                                                                            style="color:#146B99;"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="right"
                                                                                            title=" Would you like to include a second signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                        <label for=""> By Default the
                                                                                            second signature person is
                                                                                            disbaled, check the
                                                                                            checkbox to <b
                                                                                                style="color:red">Enable</b>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div
                                                                                        id="certificate_signature2_mess">
                                                                                        <i class="far fa-keyboard fa-lg"
                                                                                            style="color:blue;"> </i>
                                                                                        <label for="">Now you can add
                                                                                            the signature person
                                                                                            name!</label>
                                                                                    </div>
                                                                                </div>
                                                                                <thead
                                                                                    class="certificate_signature2_head">
                                                                                    <br>
                                                                                    <input type="text"
                                                                                        name="signature_person2_text"
                                                                                        placeholder="Enter Signature person Name     Example [Head Master] [Teacher] [Student]"
                                                                                        id="signature_person2"
                                                                                        class="form-control">
                                                                                    <br>
                                                                                    <label for=""
                                                                                        id="certificate_signature2_add_css">Add
                                                                                        CSS <i class="fa fa-css3 fa-lg"
                                                                                            style="color:#238AE6"
                                                                                            aria-hidden="true"></i> or
                                                                                        leave default css are the ones
                                                                                        at the sample template</label>
                                                                                    <tr>
                                                                                        <th class="column-title1">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_signature2_css" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Width
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_signature2_css"></label>  <label for="" class="column-title"> Width</label></th> -->
                                                                                        <th class="column-title">Height
                                                                                        </th>
                                                                                        <th class="column-title">Margin
                                                                                        </th>
                                                                                        <th class="column-title">Padding
                                                                                        </th>
                                                                                        <th class="column-title">Float
                                                                                        </th>
                                                                                        <th class="column-title">
                                                                                            Overflow</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_signature2_body"
                                                                                    id="tbody">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_width"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_height"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_height')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_margin"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_margin')==''
                                                                                                ) value="0 0 0 200px"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_padding"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_padding')==''
                                                                                                ) value="22px 0 0 0"
                                                                                                @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_float"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_float')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_overflow"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_overflow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_signature2_head1">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_signature2_css1" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Text Align
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_signature2_css1"></label>  <label for="" class="column-title"> Text Align</label></th> -->
                                                                                        <th class="column-title">Text
                                                                                            Indent</th>
                                                                                        <th class="column-title">Text
                                                                                            Decoration</th>
                                                                                        <th class="column-title">Text
                                                                                            Transform</th>
                                                                                        <th class="column-title">
                                                                                            Vertical Align</th>
                                                                                        <th class="column-title">Latter
                                                                                            Spacing</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_signature2_body1">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_text_align"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_text_align')==''
                                                                                                ) value="center" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_text_indent"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_text_indent')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_text_decoration"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_text_decoration')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_text_transform"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_text_transform')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_vertical_align"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_vertical_align')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_latter_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_latter_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_signature2_head2">
                                                                                    <tr>
                                                                                        <th data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Card Title">
                                                                                            <span
                                                                                                class="checkboxdesign">
                                                                                                <label
                                                                                                    class="checkboxdesign">
                                                                                                    <input
                                                                                                        type="checkbox"
                                                                                                        class="checkboxdesign CheckBoxContent"
                                                                                                        id="add_signature2_css2" />
                                                                                                    <span
                                                                                                        class="checkboxdesign-target"></span>
                                                                                                </label>
                                                                                            </span>
                                                                                            Font Family
                                                                                        </th>
                                                                                        <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_signature2_css2"></label>  <label for="" class="column-title"> Font Family</label></th> -->
                                                                                        <th class="column-title">Font
                                                                                            Weight</th>
                                                                                        <th class="column-title">Font
                                                                                            Size</th>
                                                                                        <th class="column-title">Line
                                                                                            Height</th>
                                                                                        <th class="column-title">Word
                                                                                            Spacing</th>
                                                                                        <th class="column-title">White
                                                                                            Space</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody
                                                                                    class="certificate_signature2_body2">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_font_family"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_font_family')==''
                                                                                                ) value="serif" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_font_weight"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_font_weight')==''
                                                                                                ) value="bold" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_font_size"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_font_size')==''
                                                                                                ) value="22px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_line_height"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_line_height')==''
                                                                                                ) value="22px" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_word_spacing"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_word_spacing')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_white_space"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_white_space')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>

                                                                                <thead
                                                                                    class="certificate_signature2_head3">
                                                                                    <tr>
                                                                                        <th title="Card Title">Border
                                                                                        </th>
                                                                                        <th class="column-title">Border
                                                                                            Width</th>
                                                                                        <th class="column-title">Border
                                                                                            Style</th>
                                                                                        <th class="column-title">Border
                                                                                            Color</th>
                                                                                        <th class="column-title">Border
                                                                                            Radius</th>
                                                                                        <th class="column-title">Box
                                                                                            Shodow</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody
                                                                                    class="certificate_signature2_body3">
                                                                                    <tr>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_border"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_border')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_border_width"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_border_width')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_border_style"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_border_style')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_color"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_color')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_border_radius"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_border_radius')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                        <td class="col-md-2">
                                                                                            <input type="text"
                                                                                                name="certificate_signature2_box_shadow"
                                                                                                id=""
                                                                                                @if(request('certificate_signature2_box_shadow')==''
                                                                                                ) value="" @endif
                                                                                                class="form-control"
                                                                                                placeholder="top,  left,  bottom,  right ">
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>

                                                                        <div id="signatureImg2">
                                                                            <table
                                                                                class="table table-striped table-bordered bulk_action "
                                                                                cellspacing="0" width="100%">
                                                                                <div class="row">
                                                                                    <div class="col-md-2">
                                                                                        <span class="bigcheck">
                                                                                            <label class="bigcheck">
                                                                                                <i class="fas fa-signature fa-spin certificate_signature2_img_enable"
                                                                                                    style="font-size:30px; cursor:pointer"></i>
                                                                                                <input type="checkbox"
                                                                                                    class="bigcheck CheckBoxContent"
                                                                                                    id="certificate_signature2img"
                                                                                                    name="signature_enable_2" />
                                                                                                <span
                                                                                                    class="bigcheck-target"></span>
                                                                                            </label>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="col-md-9"
                                                                                        style="margin-top:19px">
                                                                                        <div class=""
                                                                                            id="certificate_signature2_img_info">
                                                                                            <b class="fa fa-info-circle fa-lg"
                                                                                                style="color:#146B99;"
                                                                                                data-toggle="tooltip"
                                                                                                data-placement="right"
                                                                                                title=" Would you like to include a second signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                            <label for=""> By Default
                                                                                                the signature is manual,
                                                                                                check the
                                                                                                checkbox to <b
                                                                                                    style="color:red">Enable</b>
                                                                                                to uplaod signature.
                                                                                            </label>
                                                                                        </div>
                                                                                        <div
                                                                                            id="certificate_signature2_img_mess">
                                                                                            <i class="fas fa-signature fa-lg"
                                                                                                style="color:rgb(42,63,84);">
                                                                                            </i>
                                                                                            <label for="">Now you can
                                                                                                add signature image! or
                                                                                                leave it as manual line
                                                                                                ------------------------------------</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <thead
                                                                                        class="certificate_signature2img_head">
                                                                                        <div>
                                                                                            <input type="file"
                                                                                                name="certificate_signature_img_2_url"
                                                                                                id="select_signature2_img"
                                                                                                class="form-control">
                                                                                        </div>
                                                                                        <br>
                                                                                        <label for=""
                                                                                            id="certificate_signature2_img_add_css">Add
                                                                                            CSS <i
                                                                                                class="fa fa-css3 fa-lg"
                                                                                                style="color:#238AE6"
                                                                                                aria-hidden="true"></i>
                                                                                            or leave default css are the
                                                                                            ones at the sample
                                                                                            template</label>
                                                                                        <tr>
                                                                                            <th data-toggle="tooltip"
                                                                                                data-placement="top"
                                                                                                title="Card Title">
                                                                                                <span
                                                                                                    class="checkboxdesign">
                                                                                                    <label
                                                                                                        class="checkboxdesign">
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            class="checkboxdesign CheckBoxContent"
                                                                                                            id="add_signature2img_css" />
                                                                                                        <span
                                                                                                            class="checkboxdesign-target"></span>
                                                                                                    </label>
                                                                                                </span>
                                                                                                Width
                                                                                            </th>
                                                                                            <th class="column-title">
                                                                                                Height</th>
                                                                                            <th class="column-title">
                                                                                                Margin</th>
                                                                                            <th class="column-title">
                                                                                                Padding</th>
                                                                                            <th class="column-title">
                                                                                                Size</th>
                                                                                            <th class="column-title">
                                                                                                Repeat</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody
                                                                                        class="certificate_signature2img_body">
                                                                                        <tr>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_width"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_width')==''
                                                                                                    ) value="	130px"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_height"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_height')==''
                                                                                                    ) value="70px"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_margin"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_margin')==''
                                                                                                    )
                                                                                                    value=" 0 50px 0 50px"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_padding"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_padding')==''
                                                                                                    ) value="0 0 0 0"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_size"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_size')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_repeat"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_repeat')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>

                                                                                    <thead
                                                                                        class="certificate_signature2img_head1">
                                                                                        <tr>
                                                                                            <th title="Card Title">
                                                                                                Color</th>
                                                                                            <th class="column-title">
                                                                                                Overflow</th>
                                                                                            <th class="column-title">
                                                                                                Opacity</th>
                                                                                            <th class="column-title">Box
                                                                                                shadow</th>
                                                                                            <th class="column-title">
                                                                                                Border Radius</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody
                                                                                        class="certificate_signature2img_body1">

                                                                                        <tr>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_color"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_color')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_overflow"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_overflow')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_opacity"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_opacity')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_box_shadow"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_box_shadow')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature2_border_radius"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature2_border_radius')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                            </table>
                                                                        </div>

                                                                    </div>

                                                                    <div class="tab-pane" id="school_signature3">
                                                                        <table
                                                                            class="table table-striped table-bordered bulk_action "
                                                                            cellspacing="0" width="100%">

                                                                            <div class="col-md-3">
                                                                                <span class="bigcheck">
                                                                                    <label class="bigcheck">
                                                                                        <b
                                                                                            id="certificate_signature3_enable"></b>
                                                                                        <input type="checkbox"
                                                                                            class="bigcheck CheckBoxContent"
                                                                                            id="certificate_signature3"
                                                                                            name="certificate_signature3" />
                                                                                        <span
                                                                                            class="bigcheck-target"></span>
                                                                                    </label>
                                                                                </span>
                                                                            </div>
                                                                            <div class="col-md-9"
                                                                                style="margin-top:19px">
                                                                                <div class=""
                                                                                    id="certificate_signature3_info">
                                                                                    <b class="fa fa-info-circle fa-lg"
                                                                                        style="color:#146B99;"
                                                                                        data-toggle="tooltip"
                                                                                        data-placement="right"
                                                                                        title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                    <label for=""> By Default the third
                                                                                        signature person is disbaled,
                                                                                        check the
                                                                                        checkbox to <b
                                                                                            style="color:red">Enable</b>
                                                                                    </label>
                                                                                </div>
                                                                                <div id="certificate_signature3_mess">
                                                                                    <i class="far fa-keyboard fa-lg"
                                                                                        style="color:blue;"> </i>
                                                                                    <label for="">Now you can add the
                                                                                        third signature person
                                                                                        name!</label>
                                                                                </div>
                                                                            </div>
                                                                            <thead class="certificate_signature3_head">
                                                                                <br>
                                                                                <input type="text"
                                                                                    name="signature_person3_text"
                                                                                    placeholder="Enter Signature person Name     Example [Head Master] [Teacher] [Student]"
                                                                                    id="signature_person3"
                                                                                    class="form-control">
                                                                                <br>
                                                                                <label for=""
                                                                                    id="certificate_signature3_add_css">Add
                                                                                    CSS <i class="fa fa-css3 fa-lg"
                                                                                        style="color:#238AE6"
                                                                                        aria-hidden="true"></i> or
                                                                                    leave default css are the ones at
                                                                                    the sample template</label>
                                                                                <tr>
                                                                                    <th class="column-title1">
                                                                                        <span class="checkboxdesign">
                                                                                            <label
                                                                                                class="checkboxdesign">
                                                                                                <input type="checkbox"
                                                                                                    class="checkboxdesign CheckBoxContent"
                                                                                                    id="add_signature3_css" />
                                                                                                <span
                                                                                                    class="checkboxdesign-target"></span>
                                                                                            </label>
                                                                                        </span>
                                                                                        Width
                                                                                    </th>
                                                                                    <!-- <th data-toggle="tooltip" data-placement="top" title="Card Title"><label class="fa fa-plus-circle fa-lg" style="color:#1ABB9C; cursor:pointer;"><input type="checkbox" style="display:none"  class=" checkboxdesign" id="add_signature2_css"></label>  <label for="" class="column-title"> Width</label></th> -->
                                                                                    <th class="column-title">Height</th>
                                                                                    <th class="column-title">Margin</th>
                                                                                    <th class="column-title">Padding
                                                                                    </th>
                                                                                    <th class="column-title">Float</th>
                                                                                    <th class="column-title">Overflow
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>

                                                                            <tbody class="certificate_signature3_body">
                                                                                <tr>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_width"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_width')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_height"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_height')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_margin"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_margin')==''
                                                                                            ) value="0 0 0 200px" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_padding"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_padding')==''
                                                                                            ) value="22px 0 0 0" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_float"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_float')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_overflow"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_overflow')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>

                                                                            <thead class="certificate_signature3_head1">
                                                                                <tr>
                                                                                    <th data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Card Title">
                                                                                        <span class="checkboxdesign">
                                                                                            <label
                                                                                                class="checkboxdesign">
                                                                                                <input type="checkbox"
                                                                                                    class="checkboxdesign CheckBoxContent"
                                                                                                    id="add_signature3_css1" />
                                                                                                <span
                                                                                                    class="checkboxdesign-target"></span>
                                                                                            </label>
                                                                                        </span>
                                                                                        Text Align
                                                                                    </th>
                                                                                    <th class="column-title">Text Indent
                                                                                    </th>
                                                                                    <th class="column-title">Text
                                                                                        Decoration</th>
                                                                                    <th class="column-title">Text
                                                                                        Transform</th>
                                                                                    <th class="column-title">Vertical
                                                                                        Align</th>
                                                                                    <th class="column-title">Latter
                                                                                        Spacing</th>
                                                                                </tr>
                                                                            </thead>

                                                                            <tbody class="certificate_signature3_body1">
                                                                                <tr>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_text_align"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_text_align')==''
                                                                                            ) value="center" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_text_indent"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_text_indent')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_text_decoration"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_text_decoration')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_text_transform"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_text_transform')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_vertical_align"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_vertical_align')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_latter_spacing"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_latter_spacing')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>

                                                                            <thead class="certificate_signature3_head2">
                                                                                <tr>
                                                                                    <th data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Card Title">
                                                                                        <span class="checkboxdesign">
                                                                                            <label
                                                                                                class="checkboxdesign">
                                                                                                <input type="checkbox"
                                                                                                    class="checkboxdesign CheckBoxContent"
                                                                                                    id="add_signature3_css2" />
                                                                                                <span
                                                                                                    class="checkboxdesign-target"></span>
                                                                                            </label>
                                                                                        </span>
                                                                                        Font Family
                                                                                    </th>
                                                                                    <th class="column-title">Font Weight
                                                                                    </th>
                                                                                    <th class="column-title">Font Size
                                                                                    </th>
                                                                                    <th class="column-title">Line Height
                                                                                    </th>
                                                                                    <th class="column-title">Word
                                                                                        Spacing</th>
                                                                                    <th class="column-title">White Space
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="certificate_signature3_body2">
                                                                                <tr>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_font_family"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_font_family')==''
                                                                                            ) value="serif" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_font_weight"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_font_weight')==''
                                                                                            ) value="bold" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_font_size"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_font_size')==''
                                                                                            ) value="22px" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_line_height"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_line_height')==''
                                                                                            ) value="22px" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_word_spacing"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_word_spacing')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_white_space"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_white_space')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                </tr>

                                                                            </tbody>
                                                                            <thead class="certificate_signature3_head3">
                                                                                <tr>
                                                                                    <th title="Card Title">Border</th>
                                                                                    <th class="column-title">Border
                                                                                        Width</th>
                                                                                    <th class="column-title">Border
                                                                                        Style</th>
                                                                                    <th class="column-title">Border
                                                                                        Color</th>
                                                                                    <th class="column-title">Border
                                                                                        Radius</th>
                                                                                    <th class="column-title">Box Shodow
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody class="certificate_signature3_body3">
                                                                                <tr>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_border"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_border')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_border_width"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_border_width')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_border_style"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_border_style')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_color"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_color')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_border_radius"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_border_radius')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                    <td class="col-md-2">
                                                                                        <input type="text"
                                                                                            name="certificate_signature3_box_shadow"
                                                                                            id=""
                                                                                            @if(request('certificate_signature3_box_shadow')==''
                                                                                            ) value="" @endif
                                                                                            class="form-control"
                                                                                            placeholder="top,  left,  bottom,  right ">
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                                                        <div id="signatureImg3">
                                                                            <table
                                                                                class="table table-striped table-bordered bulk_action "
                                                                                cellspacing="0" width="100%">
                                                                                <div class="row">
                                                                                    <div class="col-md-2">
                                                                                        <span class="bigcheck">
                                                                                            <label class="bigcheck">
                                                                                                <i class="fas fa-signature fa-spin certificate_signature3_img_enable"
                                                                                                    style="font-size:30px; cursor:pointer"></i>
                                                                                                <input type="checkbox"
                                                                                                    class="bigcheck CheckBoxContent"
                                                                                                    id="certificate_signature3img"
                                                                                                    name="signature_enable_3" />
                                                                                                <span
                                                                                                    class="bigcheck-target"></span>
                                                                                            </label>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="col-md-9"
                                                                                        style="margin-top:19px">
                                                                                        <div class=""
                                                                                            id="certificate_signature3_img_info">
                                                                                            <b class="fa fa-info-circle fa-lg"
                                                                                                style="color:#146B99;"
                                                                                                data-toggle="tooltip"
                                                                                                data-placement="right"
                                                                                                title=" Would you like to include a third signature person to the Certificate ? if [YES] please Check the checkbox else [NO] Uncheck the checkbox "></b>
                                                                                            <label for=""> By Default
                                                                                                the signature is manual,
                                                                                                check the
                                                                                                checkbox to <b
                                                                                                    style="color:red">Enable</b>
                                                                                                to uplaod signature.
                                                                                            </label>
                                                                                        </div>
                                                                                        <div
                                                                                            id="certificate_signature3_img_mess">
                                                                                            <i class="fas fa-signature fa-lg"
                                                                                                style="color:rgb(42,63,84);">
                                                                                            </i>
                                                                                            <label for="">Now you can
                                                                                                add signature image! or
                                                                                                leave it as manual line
                                                                                                ------------------------------------</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <thead
                                                                                        class="certificate_signature3img_head">
                                                                                        <div>
                                                                                            <input type="file"
                                                                                                name="certificate_signature_img_3_url"
                                                                                                id="select_signature3_img"
                                                                                                class="form-control">
                                                                                        </div>
                                                                                        <br>
                                                                                        <label for=""
                                                                                            id="certificate_signature3_img_add_css">Add
                                                                                            CSS <i
                                                                                                class="fa fa-css3 fa-lg"
                                                                                                style="color:#238AE6"
                                                                                                aria-hidden="true"></i>
                                                                                            or leave default css are the
                                                                                            ones at the sample
                                                                                            template</label>
                                                                                        <tr>
                                                                                            <th data-toggle="tooltip"
                                                                                                data-placement="top"
                                                                                                title="Card Title">
                                                                                                <span
                                                                                                    class="checkboxdesign">
                                                                                                    <label
                                                                                                        class="checkboxdesign">
                                                                                                        <input
                                                                                                            type="checkbox"
                                                                                                            class="checkboxdesign CheckBoxContent"
                                                                                                            id="add_signature3img_css" />
                                                                                                        <span
                                                                                                            class="checkboxdesign-target"></span>
                                                                                                    </label>
                                                                                                </span>
                                                                                                Width
                                                                                            </th>
                                                                                            <th class="column-title">
                                                                                                Height</th>
                                                                                            <th class="column-title">
                                                                                                Margin</th>
                                                                                            <th class="column-title">
                                                                                                Padding</th>
                                                                                            <th class="column-title">
                                                                                                Size</th>
                                                                                            <th class="column-title">
                                                                                                Repeat</th>
                                                                                        </tr>
                                                                                    </thead>


                                                                                    <tbody
                                                                                        class="certificate_signature3img_body">
                                                                                        <tr>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_width"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_width')==''
                                                                                                    ) value="130px"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_height"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_height')==''
                                                                                                    ) value="70px"
                                                                                                    @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_margin"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_margin')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_padding"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_padding')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_size"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_size')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_repeat"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_repeat')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                    <thead
                                                                                        class="certificate_signature3img_head1">
                                                                                        <tr>
                                                                                            <th title="Card Title">
                                                                                                Color</th>
                                                                                            <th class="column-title">
                                                                                                Overflow</th>
                                                                                            <th class="column-title">
                                                                                                Opacity</th>
                                                                                            <th class="column-title">Box
                                                                                                shadow</th>
                                                                                            <th class="column-title">
                                                                                                Border Radius</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody
                                                                                        class="certificate_signature3img_body1">
                                                                                        <tr>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_color"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_color')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_overflow"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_overflow')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_opacity"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_opacity')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_box_shadow"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_box_shadow')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                            <td class="col-md-2">
                                                                                                <input type="text"
                                                                                                    name="certificate_img_signature3_border_radius"
                                                                                                    id=""
                                                                                                    @if(request('certificate_img_signature3_border_radius')==''
                                                                                                    ) value="" @endif
                                                                                                    class="form-control"
                                                                                                    placeholder="top,  left,  bottom,  right ">
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div class="clearfix"></div>
                                                            <div class="modal-footer">
                                                                @if(isset($card_templateEdit))
                                                                {!! Form::submit('Save Changes', ['class' => 'btn
                                                                bg-teal']) !!}
                                                                @else
                                                                <button type="submit" id="create_certificateBtn"
                                                                    class="btn btn-round bg-teal btn-block btn-lg">Create
                                                                    Certificate </button>
                                                                @endif
                                                            </div>

                                                            {!! Form::close() !!}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Multiple Items To Be Open -->
            </div>

        </div>
    </div>
</div>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
@include('admins.design_certificates.certificate_design_css')
@endsection

@section('js')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
@include('admins.design_certificates.certificate_design_js')

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
@endsection