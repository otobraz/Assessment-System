@extends('layout.admin.base')

@section('title')
   Questionários Gerais
@endsection

@section('content')

   <div class="box box-primary-ufop">
      <div class="box-header with-border">
         <h3 class="box-title">QUESTIONÁRIOS GERAIS</h3>
         <div class="box-tools pull-right">
            <a class="btn btn-primary-ufop btn-sm" role="button"
            style="color: white" href="{{action('SurveyController@create')}}"><i class="fa fa-file"> </i> Criar Questionário</a>
         </div><!-- /.box-tools -->
      </div><!-- /.box-header -->

      <div class="box-body">
         @include('alert-message.success')
         @include('alert-message.error')
         <table id="index-table" class="table table-ufop table-col-condensed table-bordered table-striped table-responsive">

            <thead>
               <tr>
                  <th>Id</th>
                  <th>Título</th>
                  <th>Data de criação</th>
                  <th>Detalhes</th>
                  <th>Disponibilizar</th>
               </tr>
            </thead>

            <tbody>
               @foreach($surveys as $survey)
                  <tr>
                     <td align="center">{{$survey->id}}</td>
                     <td>{{$survey->titulo}}</td>
                     <td align="center">{{date("d/m/y", strtotime($survey->created_at))}}</td>
                     <td align="center">
                        <a class="btn btn-info btn-xs" role="button"
                        style="color: white" href="{{action('SurveyController@show', encrypt($survey->id))}}">Detalhes</a>
                     </td>
                     <td align="center">
                        <a class="btn btn-primary-ufop btn-xs" role="button"
                        style="color: white" href="{{action('SurveyController@generalSurveyProvide', encrypt($survey->id))}}">Disponibilizar</a>
                     </td>
                  </tr>
               @endforeach
            </tbody>

         </table>

      </div>
   </div>

@endsection

@section('myScripts')

@endsection
