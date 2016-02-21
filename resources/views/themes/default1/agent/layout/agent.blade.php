<!DOCTYPE html>
<html>
    <head>
 <meta charset="UTF-8" ng-app="myApp">
        <title>Faveo | HELP DESK</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="_token" content="{!! csrf_token() !!}"/>
        <!-- Bootstrap 3.3.2 -->
        <link href="{{asset("lb-faveo/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="{{asset("lb-faveo/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{asset("lb-faveo/css/ionicons.min.css")}}" rel="stylesheet">
        <!-- Theme style -->
        <link href="{{asset("lb-faveo/css/AdminLTE.css")}}" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link href="{{asset("lb-faveo/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="{{asset("lb-faveo/plugins/iCheck/flat/blue.css")}}" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <link rel="stylesheet" href="{{asset("lb-faveo/css/tabby.css")}}" type="text/css">
        <link href="{{asset("lb-faveo/css/jquerysctipttop.css")}}" rel="stylesheet" type="text/css">
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <link rel="stylesheet" href="{{asset("lb-faveo/css/editor.css")}}" type="text/css">
        <link href="{{asset("lb-faveo/plugins/filebrowser/plugin.js")}}" rel="stylesheet" type="text/css" />
        {{-- jquery ui css --}}
        <link type="text/css" href="{{asset("lb-faveo/css/jquery.ui.css")}}" rel="stylesheet">
        <link type="text/css" href="{{asset("lb-faveo/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet">
        <link href="{{asset("lb-faveo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}" rel="stylesheet" type="text/css" />        
        <!-- <link type="text/css" href="http://code.jquery.com/ui/1.9.1/themes/redmond/jquery-ui.css" rel="stylesheet"> -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="https://code.jquery.com/jquery-2.1.4.js" type="text/javascript"></script>
         <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<!--        <script src="{{asset("lb-faveo/js/jquery-2.1.4.js")}}" type="text/javascript"></script>
        <script src="{{asset("lb-faveo/js/jquery2.1.1.min.js")}}" type="text/javascript"></script>-->

        @yield('HeadInclude')
    </head>
    <body class="skin-yellow skin-green fixed">
        <div class="wrapper">
            <header class="main-header">
                <a href="http://www.faveohelpdesk.com" class="logo"><img src="{{ asset('lb-faveo/media/images/logo.png') }}" width="100px;"></a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="collapse navbar-collapse" id="navbar-collapse">
                        <ul class="tabs tabs-horizontal nav navbar-nav navbar-left">
                            <li @yield('Dashboard')><a data-target="#tabA" href="#">{!! Lang::get('lang.dashboard') !!}</a></li>
                            <li @yield('Users')><a data-target="#tabB" href="#">{!! Lang::get('lang.users') !!}</a></li>
                            <li @yield('Tickets')><a data-target="#tabC" href="#">{!! Lang::get('lang.tickets') !!}</a></li>
                            <li @yield('Tools')><a data-target="#tabD" href="#">{!! Lang::get('lang.tools') !!}</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                @if(Auth::user())
                                    <span class="hidden-xs">{{Auth::user()->first_name." ".Auth::user()->last_name}}</span>
                                @endif
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="{{ url('/auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            </nav>
                            </header>
                            <!-- Left side column. contains the logo and sidebar -->
                            <aside class="main-sidebar">
                                <!-- sidebar: style can be found in sidebar.less -->
                                <section class="sidebar">
                                    <div class="user-panel">
                                    @if (trim($__env->yieldContent('profileimg')))
                                        <h1>@yield('profileimg')</h1>
                                    @else
                                    <div class = "row">
                                        <div class="col-xs-3"></div>
                                        <div class="col-xs-2" style="width:50%;">
                                        <a href="{!! url('profile') !!}">
                                        @if(Auth::user() && Auth::user()->profile_pic)
                                            <img src="{{asset('lb-faveo/media/profilepic')}}{{'/'}}{{Auth::user()->profile_pic}}" class="img-circle" alt="User Image" />
                                        @else
                                            <img src="{{ Gravatar::src(Auth::user()->email) }}" class="img-circle" alt="User Image">
                                        @endif
                                        </a>
                                        </div>
                                    </div>
                                    @endif
                                        <div class="info" style="text-align:center;">
                                            @if(Auth::user())
                                            <p>{{Auth::user()->first_name." ".Auth::user()->last_name}}</p>
                                            @endif
                                            @if(Auth::user() && Auth::user()->active==1)
                                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                                            @else
                                            <a href="#"><i class="fa fa-circle"></i> Offline</a>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- sidebar menu: : style can be found in sidebar.less -->
                                    <ul class="sidebar-menu">
                                        @yield('sidebar')
                                    </ul>
                                </section>
                        <!-- /.sidebar -->
                        </aside>
                        <!-- Right side column. Contains the navbar and content of the page -->
                        <div class="content-wrapper">
                            <!-- Content Header (Page header) -->
                            <section class="content-header">
                                @yield('PageHeader')
                                @yield('breadcrumbs')
                            </section>
                            <!-- Main content -->
                            <section class="content">
                                @yield('content')
                            </section><!-- /.content -->
                        </div>
                        <footer class="main-footer">
                        </footer>
                    </div><!-- ./wrapper -->
                  
                    
                    {{-- // <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script> --}}

                    <script src="{{asset("lb-faveo/js/bootstrap-datetimepicker4.7.14.min.js")}}" type="text/javascript"></script>
                    <!-- Bootstrap 3.3.2 JS -->
                    <script src="{{asset("lb-faveo/js/bootstrap.min.js")}}" type="text/javascript"></script>
                    <!-- Slimscroll -->
                    <script src="{{asset("lb-faveo/plugins/slimScroll/jquery.slimscroll.min.js")}}" type="text/javascript"></script>
                    <!-- FastClick -->
                    <script src="{{asset("lb-faveo/plugins/fastclick/fastclick.min.js")}}"></script>
                    <!-- AdminLTE App -->
                    <script src="{{asset("lb-faveo/js/app.min.js")}}" type="text/javascript"></script>
                    <!-- AdminLTE for demo purposes -->
                    {{-- // <script src="{{asset("dist/js/demo.js")}}" type="text/javascript"></script> --}}
                    <!-- iCheck -->
                    <script src="{{asset("lb-faveo/plugins/iCheck/icheck.min.js")}}" type="text/javascript"></script>
                    {{-- maskinput --}}
                    {{-- // <script src="js/jquery.maskedinput.min.js" type="text/javascript"></script> --}}
                    {{-- jquery ui --}}
                    <script src="{{asset("lb-faveo/js/jquery.ui.js")}}" type="text/javascript"></script>
                    <script src="{{asset("lb-faveo/plugins/datatables/dataTables.bootstrap.js")}}" type="text/javascript"></script>
                    <script src="{{asset("lb-faveo/plugins/datatables/jquery.dataTables.js")}}" type="text/javascript"></script>
                    <!-- Page Script -->
                    
                    {{-- // <script type="text/javascript" src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script> --}}
                    <script type="text/javascript" src="{{asset("lb-faveo/js/jquery.dataTables1.10.10.min.js")}}"></script>
                    
                    <script type="text/javascript" src="{{asset("lb-faveo/plugins/datatables/dataTables.bootstrap.js")}}"></script>

<script>
$(function() {
    // Enable iCheck plugin for checkboxes
    // iCheck for checkbox and radio inputs
    // $('input[type="checkbox"]').iCheck({
        // checkboxClass: 'icheckbox_flat-blue',
        // radioClass: 'iradio_flat-blue'
    // });
    // Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function() {
        var clicks = $(this).data('clicks');
        if (clicks) {
            //Uncheck all checkboxes
            $("input[type='checkbox']", ".mailbox-messages").iCheck("uncheck");
        } else {
            //Check all checkboxes
            $("input[type='checkbox']", ".mailbox-messages").iCheck("check");
        }
        $(this).data("clicks", !clicks);
    });

    //Handle starring for glyphicon and font awesome
    $(".mailbox-star").click(function(e) {
        e.preventDefault();
        //detect type
        var $this = $(this).find("a > i");
        var glyph = $this.hasClass("glyphicon");
        var fa = $this.hasClass("fa");
        //Switch states
        if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
        }
        if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
        }
    });
});
                    </script>
                    <script type="text/javascript">
                        //     $(document).ready(function() {
                        //         $("#content").Editor();
                        //     });
                        // </script>
                   <!-- // <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script> -->
                    <script src="{{asset("lb-faveo/js/tabby.js")}}"></script>
                     <!-- // <script src="{{asset("dist/js/editor.js")}}"></script> -->
                    <!-- CK Editor -->
                    <!-- // <script src="{{asset("//cdn.ckeditor.com/4.4.3/standard/ckeditor.js")}}"></script> -->
                    {{-- // <script src="{{asset("lb-faveo/downloads/CKEditor.js")}}"></script> --}}
                    <script src="{{asset("lb-faveo/plugins/filebrowser/plugin.js")}}"></script>
                    <script src="{{asset("lb-faveo/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}" type="text/javascript"></script>
                    <script>
                        // $(function () {
                        // //Add text editor
                        // $("textarea").wysihtml5();
                        // });
                    </script>
                    <script type="text/javascript">
                        $.ajaxSetup({
                               headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
                                });
                    </script>
                    @yield('FooterInclude')
                </body>
            </html>