<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Judul Web</title>

   <link href="{{ asset('assets/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/lib/jquery-toggles/toggles-full.css') }}" rel="stylesheet">
   <link href="{{ asset('assets/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">

   <link rel="stylesheet" href="{{ asset('assets/css/amanda.css') }}">
</head>

<body>

   <div class="am-header">
      <div class="am-header-left">
         <a id="naviconLeft" href="" class="am-navicon d-none d-lg-flex"><i class="icon ion-navicon-round"></i></a>
         <a id="naviconLeftMobile" href="" class="am-navicon d-lg-none"><i class="icon ion-navicon-round"></i></a>
         <a href="index.html" class="am-logo">SMK Telkom</a>
      </div>

      <div class="am-header-right">
         <div class="dropdown dropdown-profile">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
               <img src="img/img3.jpg" class="wd-32 rounded-circle" alt="">
               <span class="logged-name"><span class="hidden-xs-down">Username</span> <i class="fa fa-angle-down mg-l-3"></i></span>
            </a>
            <div class="dropdown-menu wd-200">
               <ul class="list-unstyled user-profile-nav">
                  <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                  <li><a href=""><i class="icon ion-power"></i> Sign Out</a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>

   <div class="am-sideleft">
      <ul class="nav am-sideleft-tab">
         <li class="nav-item">
            <a href="#mainMenu" class="nav-link active"><i class="icon ion-ios-home-outline tx-24"></i></a>
         </li>
         <li class="nav-item">
            <a href="#mainMenu" class="nav-link"></a>
         </li>
         <li class="nav-item">
            <a href="#mainMenu" class="nav-link"></i></a>
         </li>
         <li class="nav-item">
            <a href="#mainMenu" class="nav-link"></i></a>
         </li>
      </ul>

      <div class="tab-content">
         <div id="mainMenu" class="tab-pane active">
            <ul class="nav am-sideleft-menu">
               <li class="nav-item">
                  <a href="index.html" class="nav-link active">
                     <i class="icon ion-ios-home-outline"></i>
                     <span>Dashboard</span>
                  </a>
               </li>
               <li class="nav-item">
                  <a href="widgets.html" class="nav-link">
                     <i class="icon ion-ios-briefcase-outline"></i>
                     <span>Widgets</span>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </div>

   <div class="am-mainpanel" style="margin-top:60px">
      <div class="am-pagebody">

         <div class="card">
            <div class="card-body">

                @yield('konten')

            </div>
         </div>

      </div>
   </div>

   <script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
   <script src="{{ asset('assets/lib/popper.js/popper.js') }}"></script>
   <script src="{{ asset('assets/lib/bootstrap/bootstrap.js') }}"></script>
   <script src="{{ asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
   <script src="{{ asset('assets/lib/jquery-toggles/toggles.min.js') }}"></script>
   <script src="{{ asset('assets/lib/d3/d3.js') }}"></script>
   <script src="{{ asset('assets/lib/rickshaw/rickshaw.min.js') }}"></script>
   <script src="http://maps.google.com/maps/api/js?key=AIzaSyAEt_DBLTknLexNbTVwbXyq2HSf2UbRBU8"></script>
   <script src="{{ asset('assets/lib/gmaps/gmaps.js') }}"></script>
   <script src="{{ asset('assets/lib/Flot/jquery.flot.js') }}"></script>
   <script src="{{ asset('assets/lib/Flot/jquery.flot.pie.js') }}"></script>
   <script src="{{ asset('assets/lib/Flot/jquery.flot.resize.js') }}"></script>
   <script src="{{ asset('assets/lib/flot-spline/jquery.flot.spline.js') }}"></script>

   <script src="{{ asset('assets/js/amanda.js') }}"></script>
   <script src="{{ asset('assets/js/ResizeSensor.js') }}"></script>
   <script src="{{ asset('assets/js/dashboard.js') }}"></script>
</body>

</html>