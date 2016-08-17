@extends('dashboard.dashboard_base')

@section('sidebar')
   <!-- Left side column. contains the sidebar -->
   <aside class="main-sidebar">

       <!-- sidebar: style can be found in sidebar.less -->
       <section class="sidebar">

           <!-- Sidebar user panel (optional) -->
           <div class="user-panel">
             <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
             </div>
               <div class="pull-left info">
                   <p>{{Session::get('first_name')}}</p>
                   <!-- Status -->
                   <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
               </div>
           </div>

           <!-- search form (Optional) -->
           <form action="{{url('search')}}" method="post" class="sidebar-form">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <div class="input-group">
                 <input type="text" name="q" class="form-control" placeholder="Procure no fórum..."/>
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
               <li><a href="{{url('/forum')}}"><i class="fa fa-comments-o"></i> <span>Questionários</span></a></li>
               <li><a href="{{url('/forum')}}"><i class="fa fa-comments-o"></i> <span>Minhas Classes</span></a></li>
               <li><a href="{{url('dashboard/edit/user/' . Session::get('id'))}}"><i class="fa fa-pencil-square-o"></i> <span>Editar Cadastro</span></a></li>
               <li><a href="{{url('user/logout')}}"><i class="fa fa-sign-out"></i> <span>Sair</span></a></li>
           </ul><!-- /.sidebar-menu -->
       </section>
       <!-- /.sidebar -->
   </aside>

@endsection

@section('content')

@endsection
