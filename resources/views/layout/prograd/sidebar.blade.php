<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
         <li class="header">MENU</li>
         <!-- Optionally, you can add icons to the links -->

         <li class="treeview">
            <a href="#"><i class="fa fa-university"></i><span>ICEA</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="{{route('section.index')}}"><i class="fa fa-circle-o"></i>Turmas</a>
               </li>
               <li>
                  <a href="{{route('guidance.index')}}"><i class="fa fa-circle-o"></i>Orientações</a>
               </li>
               <li>
                  <a href="{{route('student.index')}}"><i class="fa fa-circle-o"></i>Alunos</a>
               </li>
               <li>
                  <a href="{{route('professor.index')}}"><i class="fa fa-circle-o"></i>Professores</a>
               </li>
            </ul>
         </li>

         <li class="treeview">
            <a href="#"><i class="fa fa-comments-o"></i><span>Questionários</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="{{route('survey.generalSurveysIndex')}}"><i class="fa fa-circle-o"></i>QuestionárioS Gerais</a>
               </li>
               <li>
                  <a href="{{route('survey.index')}}"><i class="fa fa-circle-o"></i>Questionários Pessoais</a>
               </li>
               <li>
                  <a href="{{route('question.index')}}"><i class="fa fa-circle-o"></i>Perguntas</a>
               </li>
            </ul>
         </li>

         <li>
            <a href="https://zeppelin10.ufop.br/minhaUfop/desktop/login.xhtml" target="_blank"><i class="fa fa-pencil-square-o"></i> <span>Editar Cadastro - minhaUFOP</span></a>
         </li>

         <li>
            <a href="{{action('AuthController@logout')}}"><i class="fa fa-sign-out"></i><span>Sair</span></a>
         </li>

      </ul><!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
</aside>
