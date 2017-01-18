<header class="main-header">

   <!-- Logo -->
   <a href="{{action('HomeController@getUsersHome')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>AV</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sis</b>AV</span>
   </a>

   <!-- Header Navbar -->
   <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
         <span class="sr-only">Toggle navigation</span>
      </a>

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
         <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
               <!-- Menu Toggle Button -->
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  {{-- <img src="{{ asset("img/user.png") }}" class="user-image" alt="User Image" height="160px" width="160px"/> --}}
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">{{session()->get('first_name')}} {{session()->get('last_name')}}</span>
               </a>
               <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                     <img src="{{ asset("img/user.png") }}" class="img-circle" alt="User Image" height="160px" width="160px"/>
                     <p>
                        {{session()->get('first_name')}}
                        <small>Aluno</small>
                     </p>
                  </li>

                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer">
                     <div class="pull-left">
                        <a href="{{action('StudentController@edit', encrypt(session()->get('id')))}}" class="btn btn-default"><i class="fa fa-id-badge"></i> Perfil</a>
                     </div>
                     <div class="pull-right">
                        <a href="{{action('AuthController@logout')}}" class="btn btn-default"><i class="fa fa-sign-out"></i> Sair</a>
                     </div>
                  </li>
               </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <!-- <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a></li>  -->
         </ul>
      </div>
   </nav>
</header>
