<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
         <li class="header">MENU</li>

         <li class="treeview">
            <a href="#"><i class="fa fa-comments"></i><span>Questionários</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="{{action('SurveyController@index')}}"><i class="fa fa-circle-o"></i> <span>Meus Questionários</span></a>
               </li>
               <li>
                  <a href="{{action('SurveyController@generalSurveysIndex')}}"><i class="fa fa-circle-o"></i> <span>Questionários Gerais</span></a>
               </li>
            </ul>
         </li>

         <li>
            <a href="{{action('QuestionController@index')}}"><i class="fa fa-question"></i> <span>Perguntas</span></a>
         </li>

         <li>
            <a href="{{action('SectionController@index')}}"><i class="fa fa-book"></i> <span>Minhas Turmas</span></a>
         </li>
         <li>
            <a href="{{action('GuidanceController@index')}}"><i class="fa fa-cubes"></i> <span>Minhas Orientações</span></a>
         </li>
         <li>
            <a href="{{action('StudentController@index')}}"><i class="fa fa-graduation-cap"></i> <span>Alunos</span></a>
         </li>
         <li>
            <a href="{{action('ProfessorController@edit')}}"><i class="fa fa-id-badge"></i> <span>Perfil</span></a>
         </li>
         <li>
            <a href="https://zeppelin10.ufop.br/minhaUfop/desktop/login.xhtml" target="_blank"><i class="fa fa-pencil-square-o"></i> <span>Editar Cadastro - minhaUFOP</span></a>
         </li>
         <li>
            <a href="{{action('AuthController@logout')}}" ><i class="fa fa-sign-out"></i> <span>Sair</span></a>
         </li>
      </ul><!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
</aside>
