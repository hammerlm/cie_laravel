<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Carinthan-Ice-Eagles">
    <meta name="author" content="">

    <title>{{$pagetitle}}</title>

      <link rel="icon" href="/pics/logos/cie2.png">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('scripting/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('scripting/assets/css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('scripting/css/offcanvas.css')}}" rel="stylesheet">

    <!-- Custom styles generally -->
    <link href="{{ asset('scripting/css/custom.css')}}" rel="stylesheet">

      <style>
          html {
              background: url(/pics/custombg_{{rand(1, 37)}}.jpg) no-repeat center center fixed;
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
          }

          body {
              background-color: transparent;
          }
      </style>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="{{ asset('../../assets/js/ie8-responsive-file-warning.js')}}"></script><![endif]-->
    <script src="{{ asset('scripting/assets/js/ie-emulation-modes-warning.js')}}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="{{ asset('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
      <script src="{{ asset('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->

      <!-- Bootstrap core JavaScript
    ================================================== -->
      <!-- Placed at the beginning of the document -->
      <script src="{{ asset('scripting/js/jquery-2.2.4.min.js')}}"></script>
      <script src="{{ asset('scripting/js/bootstrap.min.js')}}"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="{{ asset('scripting/js/ie10-viewport-bug-workaround.js')}}"></script>
      <script src="{{ asset('scripting/js/offcanvas.js')}}"></script>

      <!-- optional scriptreferences -->
      @section('scriptrefs_optional')

      @show
      <!-- end of optional scriptreferences -->
  </head>

  <body>
    <nav class="navbar navbar-fixed-top navbar-default navbar-custom">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/home" style="color:white;">Carinthian-Ice-Eagles</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="https://onedrive.live.com/?authkey=%21ALVTsvEV2qVLtcQ&id=CE49BCB265851FEF%217805&cid=CE49BCB265851FEF" target="_blank"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Bilder</a>
            </li>
            <li @if($selectedmenuitem_h == "Gamedays") class="active" @endif>
                <a href="/gamedays"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Eistermine</a>
            </li>
            <li @if($selectedmenuitem_h == "Team") class="active" @endif>
                <a href="/team"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Playercards</a>
            </li>
              @can('authenticate')
              <li @if($selectedmenuitem_h == "Backend") class="active" @endif>
                  <a href="/backend"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Backend</a>
              </li>
              @endcan
              <li @if($selectedmenuitem_h == "Info") class="active" @endif>
                <a href="/info"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Info</a>
              </li>
              @if(Gate::allows('authenticate'))
                <li class="dropdown" >
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{$user->name}}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="/backend/users/{{$user->id}}/edit" style="color:black;"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Einstellungen</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/logout" style="color:black;" ><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Abmelden</a>
                        </li>
                    </ul>
                </li>
              @else
                  <li>
                      <a href="/login"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Anmelden</a>
                  </li>
              @endif
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container"
         style="
         background-color:rgba(255, 255, 255, 0.8);
         border-radius: 6px;
         margin-bottom: 20px;
            ">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {{$pagetitle}}
                </h1>
                <ol class="breadcrumb">
                    @for($i = 0; $i < count($path); $i++)
                    <li>
                        <span class="glyphicon glyphicon-{{$paththumbnails[$i]}}" aria-hidden="true"></span> {{$path[$i]}}
                    </li>
                    @endfor
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4">
                @section('leftcol_content')
                    This is the left column of the contentarea.
                @show
            </div>
            <div class="col-lg-8">
                @section('rightcol_content')
                    This is the right column of the contentarea.
                @show
            </div>
        </div>
        <div class="row">
            <footer class="footer">
              <div class="container">
                <p class="text-muted">2016/11 Hammerl Michael</p>
              </div>
            </footer>
        </div>
    </div><!--/.container-->
  </body>
</html>
