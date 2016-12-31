<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- search form (Optional) -->
        <form action="{{url('search')}}" method="post" class="sidebar-form">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Procure por professores..."/>
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
            <li><a href="{{url('/forum')}}"><span><i class="fa fa-comments-o"></i> Questionários</span></a></li>
            <li><a href="{{url('/forum')}}"><span><i class="fa fa-comments-o"></i> Minhas Classes</span></a></li>
            <li><a href="{{url('/forum')}}"><span><i class="fa fa-comments-o"></i>Professores</span></a></li>
            <li><a href="{{url('dashboard/edit/user/' . Session::get('id'))}}"><span><i class="fa fa-pencil-square-o"></i> Perfil</span></a></li>
            <li><a href="{{url('user/logout')}}"><span><i class="fa fa-sign-out"></i> Sair</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Link in level 2</a></li>
                <li><a href="#">Link in level 2</a></li>
              </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
