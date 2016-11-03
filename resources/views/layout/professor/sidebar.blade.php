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

         </div>
      </div>

      <!-- search form (Optional) -->
      <form action="{{url('search')}}" method="post" class="sidebar-form">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Procure..."/>
            <span class="input-group-btn">
               <button type='submit' name='search' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
         </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
         <li class="header">MENU</li>
         <!-- Optionally, you can add icons to the links -->
         <li>
            <a href="{{action('SurveyController@index')}}"><i class="fa fa-comments-o"></i> <span>Questionários</span></a>
         </li>
         <li>
            <a href="#"><i class="fa fa-book"></i> <span>Minhas Classes</span></a>
         </li>
         <li>
            <a href="#"><i class="fa fa-graduation-cap"></i> <span>Professores</span></a>
         </li>
         <li>
            <a href="{{action('ProfessorController@edit')}}" target="_blank"><i class="fa fa-pencil-square-o"></i> <span>Editar Cadastro</span></a>
         </li>
         <li>
            <a href="{{action('AuthController@logout')}}" ><i class="fa fa-sign-out"></i> <span>Sair</span></a>
         </li>
      </ul><!-- /.sidebar-menu -->
   </section>
   <!-- /.sidebar -->
</aside>
