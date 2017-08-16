<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Laravel') }}</title>

   <!-- Styles -->
   <link href="{{ asset('bootstrap-3.3.7/css/bootstrap.css') }}" rel="stylesheet">
   <link href="{{ asset('css/hris.css') }}" rel="stylesheet">
   <link href="{{ asset('bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.css') }}" rel="stylesheet">
   <link href="{{ asset('bootstrap-datepicker-1.6.4/css/bootstrap-datepicker3.standalone.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('font-awesome-4.7.0/css/font-awesome.css') }}">
   <link rel="stylesheet" href="{{ asset('chosen_v1.6.2/chosen.css') }}">

   <!-- Scripts -->
   <script>
   window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
   ]) !!};
   </script>

   <!-- Scripts -->
   <script src="{{ asset('bootstrap-3.3.7/js/jquery.min.js') }}"></script>
   <script src="{{ asset('bootstrap-3.3.7/js/bootstrap.js') }}"></script>
   <script src="{{ asset('bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js') }}"></script>
   <script src="{{ asset('momentjs/momentjs.js') }}"></script>
   <script src="{{ asset('adamwdraper-numeral-js/src/numeral.js') }}"></script>
   <script type="text/javascript" src="{{ asset('bower_components/jquery.maskedinput/src/jquery.maskedinput.js') }}"></script>
   <script src="{{ asset('chosen_v1.6.2/chosen.jquery.min.js') }}" type="text/javascript">

   </script>
</head>
<body>
   <div id="app">
      @if(Request::route()->getName() != 'applicant/register')
      <nav class="navbar navbar-default hris-navbar navbar-fixed-top" style="border-bottom-color: #2a958c">
         <div class="container">
            <div class="navbar-header">

               <!-- Collapsed Hamburger -->
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                  <span class="sr-only">Toggle Navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>

               <!-- Branding Image -->
               <a class="navbar-brand hris-title" href="{{ url('/') }}">
                  {{ config('app.name', 'Laravel') }}
               </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
               <!-- Left Side Of Navbar -->
               <ul class="nav navbar-nav">
                  &nbsp;
               </ul>

               <!-- Right Side Of Navbar -->
               <ul class="nav navbar-nav navbar-right">
                  <!-- Authentication Links -->
                  @if (Auth::guest())
                  @if(Request::route()->getName() == 'exam_taker')
                  <p class="navbar-text" style="color: white; margin-top: 13.2px; margin-right: 20px;">Examiner :: {{ ucwords(strtolower($exam->applicant->fullName()),' ') }}</p>
                  <li><div class="navbar-divider"></div></li>
                  <p class="navbar-text" style="color: white; margin-top: 13.2px; margin-right: 20px;">Timer :: <span id="timer"></span></p>
                  @else
                  <li><a href="{{ route('login') }}">Login</a></li>
                  <li><a href="{{ route('register') }}">Register</a></li>
                  @endif
                  @else
                  <p class="navbar-text" style="color: white; margin-top: 13.2px; margin-right: 20px">Signed in as :: {{ ucwords(strtolower(Auth::user()->name),' ') }}</p>

                  <li><div class="navbar-divider"></div></li>

                  <li class="logout">
                     <a class="navbar-link" style="font-size: 14px;" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                     Logout
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     {{ csrf_field() }}
                  </form>
               </li>
               @endif
            </ul>
         </div>
      </div>
   </nav>
   @endif

   <div class="container-fluid">
      @yield('content')
   </div>

   <script>
   var time = 10;
   var duration = moment.duration(30, 'milliseconds');
   var interval = 1000;

   setInterval(function(){
      duration = moment.duration(duration.asMilliseconds() - interval, 'milliseconds');
      //show how many hours, minutes and seconds are left
      $('#timer').text(moment(duration.asMilliseconds()).format('h:mm:ss'));
   }, interval);
   </script>
</div>

</body>
</html>
