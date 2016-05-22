<div class="navbar">
      <!-- Barra de Navegação -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
           <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    {{-- <a class="navbar-brand" href="{{path('login')}}">SisNti</a> --}}
                    <a class="navbar-brand"  href="{{ url('oparea') }}">Área Operacional</a>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="navbar-inverse collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                       {{-- <li><a href="{{path('informacoes')}}">Informações</a></li>
                       <li><a href="{{path('contato')}}">Contato</a></li> --}}
                       <li><a href="{{ url('oparea') }}">Área Operacional</a></li>
                        <li><a href="{{ url('oparea') }}">Área Operacional</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                       <li>
                           {{-- <a href="{{path('admin_chamados_perfil_individual')}}">{{usuario.nome}}</a> --}}
                           <a href="{{ url('oparea') }}">Área Operacional</a>
                       </li>
                       <li>
                           {{-- <a href="{{path('logout')}}"><span class="glyphicon glyphicon-off"></span> Sair</a> --}}
                           <a href="{{ url('oparea') }}">Área Operacional</a>
                       </li>
                    </ul>
                </div>
           </div>
      </nav><!-- /.navbar-collapse -->
</div>
