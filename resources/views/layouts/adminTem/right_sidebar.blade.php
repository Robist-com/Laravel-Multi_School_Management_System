<aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Change Theme</span>
                                <div class="switch">
                                    <label><input type="checkbox" data-school_id="{{auth()->user()->school_id}}" id="theme_switcher" @if($template->template == 1) checked @endif><span class="lever"></span></label>
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                </div>
                            </li>
                            <li>
                           <a href="{{route('front_cms.index')}}">More</a>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        @section('js')
        <script>
        
        $(document).ready(function(){
            // alert(1)
            // var theme = $('#theme_switcher')
        //    if(theme)
        // update-template
        $('#theme_switcher').on('change', function(){
            // $('#theme_switcher').prop('checked');
           
            let template = $(this).prop('checked') === true ? 1 : 0;
            let school_id = $(this).data('school_id');
            let _token = $('#_token').val();

            // alert(_token)
            $.ajax({
            type: "post",
            // dataType: "json",
            url: '{{ route('update-template')}}',
            data: {
                'template': template,
                'school_id': school_id,
                '_token': _token
            },
            success: function(data) {
                console.log(data.message);

                window.location.reload(true);
                // success: function (data) {
                // toastr.options.closeButton = true;
                // toastr.options.closeMethod = 'fadeOut';
                // toastr.options.closeDuration = 100;
                // toastr.success(data.message);
                // }
            }
        });
        })


    // $('.js-switch').change(function() {
        
        // $.ajax({
        //     type: "GET",
        //     dataType: "json",
        //     url: '{{ url('
        //     batch / status / update ') }}',
        //     data: {
        //         'status': status,
        //         'batch_id': batchId
        //     },
        //     success: function(data) {
        //         console.log(data.message);
        //         // success: function (data) {
        //         toastr.options.closeButton = true;
        //         toastr.options.closeMethod = 'fadeOut';
        //         toastr.options.closeDuration = 100;
        //         toastr.success(data.message);
        //         // }
        //     }
        // });
    // });
// })

        });
        </script>

        @endsection