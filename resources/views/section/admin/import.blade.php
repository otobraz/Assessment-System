@extends('layout.admin.base')

@section('title')
   Turmas | Importar
@endsection

@section('content')

   <div class="col-md-offset-3 col-md-6">

      <div class="box box-primary-ufop">
         <div class="box-header with-border">
            <h3 class="box-title">IMPORTAR TURMAS DO CSV</h3>
         </div><!-- /.box-header -->
         <div class="box-body">

            @include('alert-message.error')

            <form class="form-signin" method="POST" autocomplete="off" enctype="multipart/form-data" action="{{action('SectionController@storeFromCsv')}}">
               {{ csrf_field() }}
               <fieldset>

                  <div class="form-group">
                     <label for="sections-csv">Selecione o arquivo: <span class="span-error">*</span></label>
                     <input type="file" accept=".csv" id="sections-csv" name="sections-csv"
                        oninvalid="setCustomValidity('Selecione o arquivo.')"
                        oninput="setCustomValidity('')"required
                     >
                     <p class="help-block">Apenas arquivos do tipo .csv</p>
                  </div>

                  <button class="btn btn-default"  type="reset"><i class="glyphicon glyphicon-erase"></i> Limpar</button>
                  <button class="btn btn-primary-ufop" type="submit"><i class="fa fa-check-square-o"></i> Importar</button>
               </fieldset>
            </form>

         </div><!-- /.box-body -->
      </div><!-- /.box -->
   </div>

@endsection
