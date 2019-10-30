<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('page') - CMS</title>
    <script src="{{url('backend')}}/js/core/libraries/jquery.min.js" type="text/javascript"></script>

    <link rel="apple-touch-icon" sizes="60x60" href="{{url('backend')}}/images/ico/apple-icon-60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('backend')}}/images/ico/apple-icon-76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{url('backend')}}/images/ico/apple-icon-120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{url('backend')}}/images/ico/apple-icon-152.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('backend')}}/images/ico/favicon.ico">
    <link rel="shortcut icon" type="image/png" href="{{url('backend')}}/images/ico/favicon-32.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/css/bootstrap.css">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/fonts/icomoon.css">
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/vendors/css/extensions/pace.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/css/app.css">
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/css/colors.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/css/core/menu/menu-types/vertical-overlay-menu.css">
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/vendors/css/documentation.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{url('backend')}}/assets/css/style.css">
    <!-- END Custom CSS-->
    {{-- datatables --}}
    <link rel="stylesheet" type="text/css" href="{{url('assets')}}/DataTables/DataTables-1.10.20/css/dataTables.bootstrap4.css">
    <script src="{{url('assets')}}/ckeditor5/ckeditor.js"></script>

  </head>
  <body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

    <!-- - var navbarCustom = "navbar-fixed-top navbar-semi-dark navbar-shadow"-->
    <!-- navbar-fixed-top-->
    <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-semi-dark navbar-shadow">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav">
            <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1">
                  <div class="bs-callout-info callout-border-left mt-1 p-1">
                  <strong>Great Job!</strong>
                  <p>Biscuit macaroon tootsie roll croissant. Dessert candy canes halvah cookie liquorice. Candy canes muffin gummies jujubes brownie. Pie cake pie pastry sugar plum jelly apple pie cotton candy.</p></i></div></a></li>
            <li class="nav-item"><a href="index.html" class="navbar-brand nav-link"><img alt="branding logo" src="{{url('backend')}}/images/logo/robust-logo-light.png" data-expand="{{url('backend')}}/images/logo/robust-logo-light.png" data-collapse="{{url('backend')}}/images/logo/robust-logo-small.png" class="brand-logo"></a></li>
            <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x fa-rotate-90"></i></a></li>
          </ul>
        </div>
        <div class="navbar-container content">
          <div id="navbar-mobile" class="collapse navbar-toggleable-sm">
            <ul class="nav navbar-nav">
              <li class="nav-item hidden-sm-down"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5"></i></a></li>
              <li class="nav-item hidden-sm-down"><a href="#" class="nav-link nav-link-expand"><i class="ficon icon-expand2"></i></a></li>
            </ul>
            <ul class="nav navbar-nav float-xs-right">
              <li class="nav-item"><a href="https://github.com/pixinvent/robust-free-bootstrap-admin-template/issues" target="_blank" class="btn btn-warning btn-doc-header"><i class="icon-help2"></i> Support</a></li>
              <li class="nav-item"><a href="https://pixinvent.com/bootstrap-admin-template/robust/" target="_blank" class="btn btn-success btn-doc-header"><i class="icon-bag3"></i> Upgrade to PRO $24</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- /-->


    <!-- main menu-->
    <div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">
      <!-- main menu header-->
      <!-- / main menu header-->
      <!-- main menu content-->
      <div class="main-menu-content menu-accordion">
        @include('backoffice.partials.sidebar')
      </div>
      <!-- /main menu content-->
      <!-- main menu footer-->
      <!-- main menu footer-->
    </div>
    <!-- / main menu-->

    <div class="app-content content container-fluid">@yield('content')</div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <footer class="footer footer-static footer-light navbar-border">
      <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2017 <a href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank" class="text-bold-800 grey darken-2">PIXINVENT </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block">Hand-crafted & Made with <i class="icon-heart5 pink"></i></span></p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="{{url('backend')}}/js/core/libraries/jquery.min.js" type="text/javascript"></script>
    <script src="{{url('backend')}}/vendors/js/ui/tether.min.js" type="text/javascript"></script>
    <script src="{{url('backend')}}/js/core/libraries/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{url('backend')}}/vendors/js/ui/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="{{url('backend')}}/vendors/js/ui/unison.min.js" type="text/javascript"></script>
    <script src="{{url('backend')}}/vendors/js/ui/blockUI.min.js" type="text/javascript"></script>
    <script src="{{url('backend')}}/vendors/js/ui/jquery.matchHeight-min.js" type="text/javascript"></script>
    <script src="{{url('backend')}}/vendors/js/ui/screenfull.min.js" type="text/javascript"></script>
    <script src="{{url('backend')}}/vendors/js/extensions/pace.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{url('backend')}}/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{{url('backend')}}/js/core/app.js" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{url('backend')}}/js/scripts/documentation.js" type="text/javascript"></script>
    <script src="{{url('backend')}}/vendors/js/ui/affix.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    {{-- datatables --}}
    <script type="text/javascript" src="{{url('assets')}}/DataTables/DataTables-1.10.20/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="{{url('assets')}}/DataTables/DataTables-1.10.20/js/dataTables.bootstrap4.js"></script>
    <script>
      $(document).ready(function(){
        $('#table-backend').dataTable();
      });
    </script>
  </body>
</html>