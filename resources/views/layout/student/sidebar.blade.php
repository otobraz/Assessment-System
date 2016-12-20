<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
         <div class="pull-left image">
            <img src="{{ asset("img/user.png") }}" class="img-circle" alt="User Image"/>
         </div>
         <div class="pull-left info">
            <p></p>
            <p>{{Session::get('first_name')}}</p>
         </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
         <li class="header">MENU</li>
         <!-- Optionally, you can add icons to the links -->
         <li>
            <a href="{{action('SurveyController@index')}}"><i class="fa fa-comments-o"></i> <span>Questionários</span></a>
         </li>
         <li>
            <a href="{{action('SectionController@index')}}"><i class="fa fa-book"></i> <span>Minhas Turmas</span></a>
         </li>
         <li>
            <a href="{{action('GuidanceController@index')}}"><i class="fa fa-cubes"></i> <span>Minhas Orientações</span></a>
         </li>
         <li>
            <a href="{{action('ProfessorController@index')}}"><i class="fa fa-graduation-cap"></i> <span>Professores</span></a>
         </li>
         <li>
            <a href="{{action('StudentController@edit')}}" target="_blank"><i class="fa fa-pencil-square-o"></i> <span>Editar Cadastro</span></a>
         </li>
         <li>
            <a href="{{action('AuthController@logout')}}" ><i class="fa fa-sign-out"></i> <span>Sair</span></a>
         </li>
      </ul><!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
</aside>
