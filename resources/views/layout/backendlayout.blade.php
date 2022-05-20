<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ALS">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ALS') }}</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    {{-- <link href="{{asset('backend/css/demo.css') }}" rel="stylesheet"> --}}
    {{-- <link href="https://www.dropzonejs.com/css/dropzone.css?v=1533562669" rel="s   tylesheet"> --}}
    <link href="{{asset('backend/css/material-dashboard.minf066.css?v=2.1.0') }}" rel="stylesheet">
    <link href="{{asset('backend/css/custom.css') }}" rel="stylesheet">
    {{-- <link href="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"> --}}


    {{-- <link rel="stylesheet" href="{{asset('backend/css/review.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css"> --}}
    {{-- <link href="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <style>
        .editable-error-block.help-block {
            color: red;
            font-size: 13px;
            font-style: italic;
        }
         .nicEdit-main     {
            background: cadetblue!important;
         }
        .glyphicon {
            position: relative;
            top: 1px;
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            font-style: normal;
            font-weight: 400;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        .glyphicon-ok:before {
            content: "\e013";
        }
        .glyphicon-remove:before {
            content: "\e014";
        }
        @font-face{
            font-family:'Glyphicons Halflings';
            src:url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.eot");
            src:url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.eot?#iefix") format("embedded-opentype"),
            url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.woff2") format("woff2"),
            url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.woff") format("woff"),
            url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.ttf") format("truetype"),
            url("https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular") format("svg")
        }
    </style>
</head>

<body class="">

<!-- Begin page -->
<div id="wrapper">
    <div class="sidebar" data-color="rose" data-background-color="black" style="background-image: url('{{asset('backend/img/sidebar-4.jpg')}}') " >
        <div class="logo text-center"> 
            <a href="/admin" class="simple-text logo-normal">
                ALS
            </a>
        </div>
        <div class="sidebar-wrapper">
            <div class="user text-center"> 
                <div class="user-info">
                    <span class="text-white">
                    @if(Auth::check())
                            {{ Auth::user()->name }}
                        @else
                            Admin
                        @endif 
                    </span>
                </div>
            </div>

            <ul class="nav" style="background: #0000008f;">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('admin/dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <p> Dashboard </p>
                    </a>
                </li>

                <li class="nav-item" style="background: #000">
                    <a class="nav-link" href="{{ url('admin/user') }}">
                        <i class="fa fa-users"></i>
                        <p> Users </p>
                    </a>
                </li>

                <li class="nav-item" style="background: #000">
                    <a class="nav-link" href="{{ url('admin/about') }}">
                        <i class="fa fa-users"></i>
                        <p> About </p>
                    </a>
                </li>

                <li class="nav-item" style="background: #2169b3;">
                    <a data-toggle="collapse" href="#collapseExample3" class="nav-link">

                        <i class="fa fa-product-hunt"></i> <p>Manage Products <b class="caret"></b></p>

                    </a>
                    <div class="collapse" id="collapseExample3">
                        <ul class="nav">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ url('admin/product') }}">
                                    <i class="fa fa-product-hunt"></i>
                                    <p>Products</p>
                                </a>
                            </li> 
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ url('admin/productCategory') }}">
                                    <i class="fa fa-product-hunt"></i>
                                    <p>Product Category</p>
                                </a>
                            </li> 
                        </ul>
                    </div>
                </li>

                <li class="nav-item" style="background: #2169b3;">
                    <a data-toggle="collapse" href="#collapseExample44" class="nav-link">
                        <i class="material-icons">inventory</i> <p>Manage Orders <b class="caret"></b></p>
                    </a>
                    <div class="collapse" id="collapseExample44">
                        <ul class="nav">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ url('admin/order') }}">
                                    <i class="material-icons">inventory</i>
                                    <p>Orders</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item" style="background: #000">
                    <a class="nav-link" href="{{ url('admin/site-setting') }}">
                        <i class="fa fa-cog"></i>
                        <p> Site Settings </p>
                    </a>
                </li>

                <li class="nav-item" style="background: #2169b3;">
                    <a data-toggle="collapse" href="#collapseExample3235" class="nav-link">

                        <i class="fa fa-calendar"></i> <p>Manage Donations <b class="caret"></b></p>

                    </a>
                    <div class="collapse" id="collapseExample3235">
                        <ul class="nav">
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ url('admin/donation') }}">
                                    <i class="fa fa-dollar"></i>
                                    <p>Donations</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ url('admin/donationCause') }}">
                                    <i class="fa fa-question"></i>
                                    <p>Donation Causes</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item ">
                                <a class="nav-link" href="{{ url('admin/locationdirectory') }}">
                                    <i class="fa fa-globe"></i>
                                    <p> </p>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>

                <li class="nav-item" style="background: #000">
                    <a class="nav-link" href="{{ url('admin/banner') }}">
                        <i class="material-icons">slideshow</i>
                        <p> Banner Manager </p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                            <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                            <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                        </button>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" href="#" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{-- {{Auth::user()->name}} --}}
                                ALS
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                {{-- <a href=""> </a> --}}
                                <a class="dropdown-item" href="{{ url('/logout') }}"  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();"><i class="mdi mdi-logout m-r-5 text-muted"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="content">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        @if (Session::has('flash_message'))
                            <div class="container">
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ Session::get('flash_message') }}
                                </div>
                            </div>
                        @endif

                        @if (Session::has('flash_message1'))
                            <div class="container">
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ Session::get('flash_message1') }}
                                </div>
                            </div>
                        @endif

                        @yield('body')

                    </div>
                </div>
            </div>

        </div> <!-- content -->

    </div>
    <div class="clearfix"></div>
    <footer class="footer">
        <div class="container-fluid">
            <div class="copyright float-right" style="color: black">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>, made with <i class="material-icons">favorite</i> by
                <a href="#" target="_blank">ALS</a> for a better web development.
            </div>
        </div>
    </footer>
    <!-- End Right content here -->
</div>
</div><!-- /Page Container -->
<!--   Core JS Files   -->

<script src="{{asset('backend/js/core/jquery.min.js') }}"></script>
<script src="{{asset('backend/js/core/popper.min.js') }}"></script>
<script src="{{asset('backend/js/core/bootstrap-material-design.min.js') }}"></script>
<script src="{{asset('backend/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<!-- Plugin for the momentJs  -->
<script src="{{asset('backend/js/plugins/moment.min.js') }}"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{asset('backend/js/plugins/sweetalert2.js') }}"></script>
<!-- Forms Validations Plugin -->
<script src="{{asset('backend/js/plugins/jquery.validate.min.js') }}"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{asset('backend/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{asset('backend/js/plugins/bootstrap-selectpicker.js') }}"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{asset('backend/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="{{asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('backend/js/plugins/bootstrap-tagsinput.js') }}"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('backend/js/plugins/jasny-bootstrap.min.js') }}"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="{{asset('backend/js/plugins/fullcalendar.min.js') }}"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="{{asset('backend/js/plugins/jquery-jvectormap.js') }}"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="{{asset('backend/js/plugins/nouislider.min.js') }}"></script>
<script src="{{asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
{{-- <script src="../../../cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script> --}}
<!-- Library for adding dinamically elements -->
<script src="{{asset('backend/js/plugins/arrive.min.js') }}"></script>
<!--  Google Maps Plugin    -->
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script> --}}
<!-- Place this tag in your head or just before your close body tag. -->
{{-- <script async defer src="../../../buttons.github.io/buttons.js"></script> --}}
<!-- Chartist JS -->
<script src="{{asset('backend/js/plugins/chartist.min.js') }}"></script>
<script src="{{asset('backend/js/plugins/tinymce/tinymce.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('backend/js/plugins/bootstrap-notify.js') }}"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('backend/js/material-dashboard.minf066.js?v=2.1.0') }}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('backend/demo/demo.js') }}"></script>
<script src="{{asset('backend/js/custom.js') }}"></script>
{{-- <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script> --}}
{{-- <script src="{{asset('backend/assets/js/plugins/ckfinder/ckfinder.js')}}"></script>
<script src="{{asset('backend/assets/js/plugins/ckeditor/ckeditor.js')}}"></script> --}}
{{-- <script src="https://www.dropzonejs.com/js/dropzone.js?v=1533562669"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
{{--<script src="https://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script> --}}
@yield('afterScript')
{{-- <script>
    $(document).ready(function() {

        $('.checkbox-check').change(function() {
            //$("#hit_this").hide();
            if($(this).is(":checked")) {
                $("#hit_this").show();
            }  else
            {
                $("#hit_this").hide();
            }
        });

        $(".lock_status").on('click',function() {
            var id = $(this).attr('id');
            // var id = $(this).attr('id');
            // console.log(id);
            $.ajax({
                type: "POST",
                url: "/admin/lock_status",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function (res) {
                }
            });
        });

        $(".approve_btn").on('click',function() {
            var id = $(this).attr('id');
            // var id = $(this).attr('id');
            // console.log(id);
            if(confirm("You want to approve this?")){
            $.ajax({
                type: "POST",
                url: "/admin/approve_btn",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function (res) {
                if(res.success){
                    $('#'+id).hide();
                }
                }
            });
            } else {
                return false;
            }
        });

        $(".sliderStatus").on('click',function() {
            var id = $(this).attr('id');
            // var id = $(this).attr('id');
            // console.log(id);
            $.ajax({
                type: "POST",
                url: "/admin/sliderStatus",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function (res) {
                }
            });
        }); 

        $(".featuredStatus").on('click',function() {
            var id = $(this).attr('id');
            // var id = $(this).attr('id');
            // console.log(id);
            $.ajax({
                type: "POST",
                url: "featuredStatus",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id

                },
                success: function (res) {

                }
            });
        });

        $('#txtInput').keydown(function(event) {
            var wordLen = 27,
                len; // Maximum word length
            len = $('#txtInput').val().split(/[\s]+/);
            if (len.length > wordLen) {
                if ( event.keyCode == 46 || event.keyCode == 8 ) {// Allow backspace and delete buttons
                } else if (event.keyCode < 48 || event.keyCode > 57 ) {//all other buttons
                    event.preventDefault();
                }
            }
            // console.log(len.length + " words are typed out of an available " + wordLen);
            wordsLeft = (wordLen) - len.length;
            $('.words-left').html(wordsLeft+ ' words left');
            if(wordsLeft == 0) {
                $('.words-left').css({
                    'background':'red'
                }).prepend('<i class="fa fa-exclamation-triangle"></i>');
            }else{
                $('.words-left').css({
                    'background':'green' });
            }
        });

    });

    $(document).on('change', '.file-field input[type="file"]', function () {
        var file_field = $(this).closest('.file-field');
        var path_input = file_field.find('input.file-path');
        var files      = $(this)[0].files;
        var file_names = [];
        for (var i = 0; i < files.length; i++) {
            file_names.push(files[i].name);
        }
        path_input.val(file_names.join(", "));
        path_input.trigger('change');
    });

    bkLib.onDomLoaded(function() {
        nicEditors.editors.push(
            new nicEditor().panelInstance(
                document.getElementById('myNicEditor')
            )
        );
    });


    bkLib.onDomLoaded(function() {
        nicEditors.editors.push(
            new nicEditor().panelInstance(
                document.getElementById('myNicEditor1')
            )
        );
    });

    bkLib.onDomLoaded(function() {
        nicEditors.editors.push(
            new nicEditor().panelInstance(
                document.getElementById('myNicEditor2')
            )
        );
    });

</script> --}}

{{-- <script>
function initAutocomplete() {

    autocomplete = new google.maps.places.Autocomplete(
        (document.getElementById('autocomplete')),
        {types:['geocode']});
}
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAt2dLBEA6MCSnQZV1_1LOZiMga5QjDI_k&libraries=places&callback=initAutocomplete"></script>  --}}
</body>
</html>
