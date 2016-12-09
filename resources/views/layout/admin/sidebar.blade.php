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
            <p>{{session()->get('first_name')}}</p>

            <!-- Status -->
            <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
         </div>
      </div>

      <!-- search form (Optional) -->
      {{-- <form action="{{url('search')}}" method="post" class="sidebar-form">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Procure..."/>
            <span class="input-group-btn">
               <button type='submit' name='search' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
         </div>
      </form> --}}
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
         <li class="header">MENU</li>
         <!-- Optionally, you can add icons to the links -->

         <li class="treeview">
            <a href="#"><i class="fa fa-university"></i> <span>ICEA</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="{{route('major.index')}}">Cursos</a>
               </li>
               <li>
                  <a href="{{route('department.index')}}">Departamentos</a>
               </li>
               <li>
                  <a href="{{route('course.index')}}">Disciplinas</a>
               </li>
               <li>
                  <a href="{{route('section.index')}}">Turmas</a>
               </li>
               <li>
                  <a href="{{route('section.index')}}">Orientações</a>
               </li>
            </ul>
         </li>

         <li class="treeview">
            <a href="#"><i class="fa fa-users"></i> <span>Usuários</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="{{route('admin.index')}}"><span>Administradores</span></a>
               </li>
               <li>
                  <a href="{{route('student.index')}}"><span>Alunos</span></a>
               </li>
               <li>
                  <a href="{{route('professor.index')}}"><span>Professores</span></a>
               </li>
            </ul>
         </li>

         <li class="treeview">
            <a href="#"><i class="fa fa-comments-o"></i> <span>Questionários</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="{{route('survey.index')}}"><span>Questionários</span></a>
               </li>
               <li>
                  <a href="{{route('question.index')}}"><span>Perguntas</span></a>
               </li>
               <li>
                  <a href="{{route('questionType.index')}}"><span>Tipos de Pergunta</span></a>
               </li>
               <li>
                  <a href="{{route('admin.index')}}"><span>Respostas</span></a>
               </li>
            </ul>
         </li>

         <li>
            <a href="{{route('admin.edit', encrypt(session()->get('id')))}}"><i class="fa fa-pencil-square-o"></i> <span>Editar Cadastro</span></a>
         </li>

         <li>
            <a href="{{action('AuthController@logout')}}"><i class="fa fa-sign-out"></i> <span>Sair</span></a>
         </li>
      </ul><!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
</aside>
