@extends('templates.pagesTemplate')

@section('content')
   <div class="container">
     <div class="col-md-3">
        <p class="lead"><i class="glyphicon glyphicon-globe"></i> Atendimento Geral</p>
        <div class="list-group">
           <a type="button" class="list-group-item" href="{{url('login')}}"><b><i class="glyphicon glyphicon-home"></i> Home</b></a>
        </div>
        <p class="lead"><i class="glyphicon glyphicon-tasks"></i> Chamados Do Sistema</p>
        <div class="list-group">
           <a href="{{url('admin_chamados_em_aberto')}}" class="list-group-item"><b><i class="glyphicon glyphicon-inbox"></i> Em Aberto</b></a>
           <a href="{{url('admin_chamados_aguardando_atendimento')}}" class="list-group-item"><b><i class="glyphicon glyphicon-list-alt"></i> Aguardando Atendimento</b></a>
        </div>
        <div class="list-group">
           <a type="button" class="list-group-item" href="javascript:void(0);" onclick="return trocar(submenu, marc1);"><b><i class="glyphicon glyphicon-list"></i> Outros </b> <i id="marc1" style="font-size: 8px" class="glyphicon glyphicon-chevron-down"></i></a>
           <div id="submenu" name="submenu" style="display: none;">
              <a href="{{url('admin_chamados_em_atendimento_sistema')}}" class="list-group-item"><b>&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-size: 10px" class="glyphicon glyphicon-chevron-right"></i> Em Atendimento</b></a>
              <a href="{{url('admin_chamados_em_espera_sistema')}}" class="list-group-item"><b>&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-size: 10px" class="glyphicon glyphicon-chevron-right"></i> Em Espera</b></a>
              <a href="{{url('admin_chamados_concluidos_sistema')}}" class="list-group-item"><b>&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-size: 10px" class="glyphicon glyphicon-chevron-right"></i> Concluídos</b></a>
              <a href="{{url('admin_chamados_todos')}}" class="list-group-item"><b>&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-size: 10px" class="glyphicon glyphicon-chevron-right"></i> Todos</b></a>
           </div>
        </div>
        <p class="lead"><i class="glyphicon glyphicon-user"></i> Meus Atendimentos</p>
        <div class="list-group">
           <a href="{{url('admin_chamados_em_atendimento_individual')}}" class="list-group-item"><b>Em Andamento</b></a>
           <a href="{{url('admin_chamados_em_espera_individual')}}" class="list-group-item"><b>Em Espera</b></a>
           <a href="{{url('admin_chamados_concluidos_individual')}}" class="list-group-item"><b>Concluídos</b></a>
        </div>
        <p class="lead"><i class="glyphicon glyphicon-play-circle"></i> Serviços de Solicitante</p>
        <div class="list-group">
           <a href="{{url('admin_chamados_novo_individual_solicitacao')}}" class="list-group-item"><b>Abrir Chamado</b></a>
           <a href="{{url('admin_chamados_individual_solicitacao')}}" class="list-group-item"><b>Meus Chamados</b></a>
           <a href="{{url('admin_chamados_perfil_individual')}}" class="list-group-item"><b>Perfil de Usuário</b></a>
        </div>
        <div class="list-group">
           <p class="lead"><i class="glyphicon glyphicon-globe"></i> Outros Serviços</p>
           <a type="button" class="list-group-item" href="javascript:void(0);" onclick="return trocar(submenuRelatorio, marc2);"><b><i class="glyphicon glyphicon-book"></i> Relatórios</b> <i id="marc2" style="font-size: 8px" class="glyphicon glyphicon-chevron-down"></i></a>
           <div id="submenuRelatorio" name="submenu" style="display: none;">
              <a href="{{url('admin_chamados_em_aberto')}}" class="list-group-item"><b>&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-size: 10px" style="font-size: 10px" class="glyphicon glyphicon-chevron-right"></i> Individual</b></a>
              <a href="{{url('admin_chamados_aguardando_atendimento')}}" class="list-group-item"><b>&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-size: 10px" style="font-size: 10px" class="glyphicon glyphicon-chevron-right"></i> Coletivo</b></a>
              <a href="{{url('admin_chamados_aguardando_atendimento')}}" class="list-group-item"><b>&nbsp;&nbsp;&nbsp;&nbsp;<i style="font-size: 10px" style="font-size: 10px" class="glyphicon glyphicon-chevron-right"></i> Avançado</b></a>
           </div>
        </div>
     </div>
   </div>
@endsection
