<div class="x_content">
    {!! Form::open(['route' => 'create-class-homework', 'enctype' => 'multipart/form-data']) !!}
    @csrf
    <style class="cp-pen-styles"></style>
    @foreach($class_assign as $grade)
    <input type="hidden" name="class_code" id="id_class" value="{{$grade->class_code}}" class="form-control"
        placeholder="Enter Class ">
    <input type="hidden" name="subject_id" id="id_subject_id" value="{{$grade->subject_id}}" class="form-control"
        placeholder="Enter Subject ">
    <input type="hidden" name="grade" id="id_grade" value="{{$grade->semester_id}}" class="form-control"
        placeholder="Enter Subject ">
    <input type="hidden" name="teacher_id" id="id_teacher_id" value="{{$grade->teacher_id}}" class="form-control"
        placeholder="Enter Subject ">
    <input type="hidden" name="school_id" id="school_id" value="{{auth()->user()->school->id}}" class="form-control"
        placeholder="Enter Subject ">

    @endforeach
    <div class="x_panel">
        <div class="body">
            <textarea id="ckeditor" name="body"></textarea>
        </div>

        <!-- <textarea name="body" id="descr" style="display:none;"></textarea> -->
        <div class="wrap-custom-file">
            <input type="file" name="homework_file" id="homework_file" accept=".gif, .jpg, .png" />
            <label for="homework_file">
                <span>File Upload</span>
                <i class="fa fa-plus-circle"></i>
            </label>
        </div>
        <!-- <input type="file" class="form-control" name="homework_file" id="homework_file"> -->
        <br>

        <div class="ln_solid"></div>

        <div class="form-group">
            <div class="control-group col-md-6">
                <div class="controls">
                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                        <div class="form-line">
                            <input name="start_date" id="start_date" type="text" class="form-control has-feedback-left"
                                id="single_cal4" placeholder="Start Date" aria-describedby="inputSuccess2Status4"
                                autocomplete="off">
                        </div>
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                    </div>
                </div>
            </div>
            <div class="control-group col-md-6">
                <div class="controls">
                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                        <div class="form-line">
                            <input name="end_date" id="end_date" type="text" class="form-control has-feedback-left"
                                id="single_cal5" placeholder="End Date" aria-describedby="inputSuccess2Status5"
                                autocomplete="off">
                        </div>
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status5" class="sr-only">(success)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-3">
                <div class="demo-switch-title">Status</div>
                <div class="switch">
                    <label><input type="checkbox" name="status" id="status"><span
                            class="lever switch-col-teal"></span></label>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <!-- <div class="col-md-12" name="status" id="status"> -->
    <!-- {!! Form::label('status', 'Status:') !!} -->
    <!-- <label class="checkbox-inline">
                {!! Form::hidden('status', 0) !!}
                {!! Form::checkbox('status', '1', null, ['class' => 'flat'] ) !!} Status
            </label> -->

    <!-- </div> -->
    <!-- </div> -->
    <div class="modal-footer">
        <a href="{{url()->previous()}}" class="btn btn-danger btn-round"> Cancel</a>
        <button type="submit" class="btn bg-teal btn-round"> Create Homework </button>
    </div>
    </form>
</div>
</div>
</div>
</div>

<script
    src='//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js'>
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.16/vue.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.3.4/tinymce.min.js'></script>
<script>
$(function() {

    // tinymce directive
    Vue.directive('tinymce-editor', {
        twoWay: true,
        bind: function() {
            var self = this;
            tinymce.init({
                selector: '#editor',
                setup: function(editor) {

                    // init tinymce
                    editor.on('init', function() {
                        tinymce.get('editor').setContent(self.value);
                    });

                    // when typing keyup event
                    editor.on('keyup', function() {

                        // get new value
                        var new_value = tinymce.get('editor').getContent(self
                            .value);

                        // set model value
                        self.set(new_value)
                    });
                }
            });
        },
        update: function(newVal, oldVal) {
            // set val and trigger event
            $(this.el).val(newVal).trigger('keyup');
        }

    })

    new Vue({
        el: '#tinymce-form',
        data: {
            content: ' '
        }
    })

})

$(document).ready(function() {
    //{{---------------------Show Start Date-------------------}}  

    $('#start_date').datetimepicker({
        format: 'Y-m-d',
        useCurrent: false,
        timepicker: false
    });
    //  {{----------------------------Show End Date---------------------}}  
    $('#end_date').datetimepicker({
        format: 'Y-m-d',
        useCurrent: false,
        timepicker: false
        // autoComplete: false
    });

})

$('#status').on('change', function() {
    var test = $(this).prop('checked') === true ? 1 : 0;
    $('#status').val(test);
});

$(function() {
    //CKEditor
    CKEDITOR.replace('ckeditor');
    CKEDITOR.config.height = 160;

    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 160,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '../../plugins/tinymce';
});
//# sourceURL=pen.js
</script>
<!-- </body></html> -->