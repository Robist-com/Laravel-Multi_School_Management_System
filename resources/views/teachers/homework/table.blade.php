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

        <div id="alerts"></div>
        <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b
                        class="caret"></b></a>
                <ul class="dropdown-menu">
                </ul>
            </div>

            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i
                        class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a data-edit="fontSize 5">
                            <p style="font-size:17px">Huge</p>
                        </a>
                    </li>
                    <li>
                        <a data-edit="fontSize 3">
                            <p style="font-size:14px">Normal</p>
                        </a>
                    </li>
                    <li>
                        <a data-edit="fontSize 1">
                            <p style="font-size:11px">Small</p>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i
                        class="fa fa-align-left"></i></a>
                <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i
                        class="fa fa-align-center"></i></a>
                <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i
                        class="fa fa-align-right"></i></a>
                <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i
                        class="fa fa-align-justify"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                <div class="dropdown-menu input-append">
                    <input class="span2" placeholder="URL" type="text" data-edit="createLink">
                    <button class="btn" type="button">Add</button>
                </div>
                <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
            </div>

            <div class="btn-group">
                <a class="btn" title="Insert picture (or just drag &amp; drop)" id="pictureBtn"><i
                        class="fa fa-picture-o"></i></a>
                <input type="file" name="homework_file" id="homework_file" data-role="magic-overlay"
                    data-target="#pictureBtn" data-edit="insertImage">
            </div>

            <div class="btn-group">
                <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
            </div>
        </div>

        <div id="editor-one" class="editor-wrapper placeholderText" contenteditable="true"></div>

        <textarea name="body" id="descr" style="display:none;"></textarea>
        <input type="file" class="form-control" name="homework_file" id="homework_file">
        <br>

        <div class="ln_solid"></div>

        <div class="form-group">
            <div class="control-group col-md-6">
                <div class="controls">
                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                        <input name="start_date" id="start_date" type="text" class="form-control has-feedback-left"
                            id="single_cal4" placeholder="First Name" aria-describedby="inputSuccess2Status4"
                            autocomplete="off">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                    </div>
                </div>
            </div>
            <div class="control-group col-md-6">
                <div class="controls">
                    <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                        <input name="end_date" id="end_date" type="text" class="form-control has-feedback-left"
                            id="single_cal5" placeholder="First Name" aria-describedby="inputSuccess2Status5"
                            autocomplete="off">
                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        <span id="inputSuccess2Status5" class="sr-only">(success)</span>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="col-md-12" name="status" id="status">
            <!-- {!! Form::label('status', 'Status:') !!} -->
            <label class="checkbox-inline">
                {!! Form::hidden('status', 0) !!}
                {!! Form::checkbox('status', '1', null, ['class' => 'flat'] ) !!} Status
            </label>
        </div>
        <!-- </div> -->
        <div class="modal-footer">
            <a href="{{url()->previous()}}" class="btn btn-danger btn-round"> Cancel</a>
            <button type="submit" class="btn btn-dark btn-round"> Create Homework </button>
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
        format: 'YYYY-MM-DD HH:mm',
        useCurrent: false,
    });
    //  {{----------------------------Show End Date---------------------}}  
    $('#end_date').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
        useCurrent: false
        // autoComplete: false
    });

})
//# sourceURL=pen.js
</script>
<!-- </body></html> -->