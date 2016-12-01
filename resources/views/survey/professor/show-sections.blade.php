@extends('layout.professor.base')

@section('content-header')
   <h1>Respostas</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   <div class="panel panel-default">
      <div class="panel-heading contains-buttons">
         <a class="btn btn-primary pull-right" role="button"
         style="color: white" href="{{route('survey.results', encrypt($survey->id))}}">Resultado Geral</a>
         <p class="panel-title contains-buttons pull-left">TURMAS</p>
         <span class="clearfix"></span>
      </div>
      <div class="panel-body">

         <table class="table table-ufop table-responsive">

            <thead>
               <tr>
                  <th>Id</th>
                  <th>Disciplina</th>
                  <th>Cód. Turma</th>
                  <th>Departamento</th>
                  <th>Ano</th>
                  <th>Semestre</th>
                  <th>Data de Crição</th>
                  <th></th>
                  <th></th>
               </tr>
            </thead>


            <tbody>
               @foreach($sections as $section)
                  <tr>
                     <td>{{$section->id}}</td>
                     <td>{{$section->disciplina->disciplina}}</td>
                     <td>{{$section->cod_turma}}</td>
                     <td>{{$section->disciplina->departamento->cod_departamento}}</td>
                     <td>{{$section->ano}}</td>
                     <td>{{$section->semestre}}</td>
                     <td>{{date("d/m/y - H:i:s", strtotime($section->pivot->created_at))}}</td>
                     <td>
                        <a href="{{route('survey.classResults', [encrypt($survey->id), encrypt($section->id)])}}"><i class="fa fa-lg fa-eye"></i></a>
                     </td>
                  </tr>
               @endforeach
            </tbody>

         </table>

      </div>
   </div>

@endsection
