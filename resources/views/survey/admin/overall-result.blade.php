@extends('layout.admin.base')

@section('title')
   Resultado Geral
@endsection

@section('content-header')
   <h1>Resultado Geral - {{$survey->titulo}}</h1>
   <hr class="hr-ufop">
@endsection

@section('content')

   @foreach ($questions as $question)

      @if ($question->tipo_id == 1)

         <div class="col-md-12">
            <div class="box box-primary-ufop collapsed-box">
               <div class="box-header with-border">
                  <h3 class="box-title">{{$question->pergunta}}</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                     </button>
                  </div>
               </div>
               <div class="box-body">
                  <table class="table table-bordered table-col-condensed table-striped table-responsive">
                     <tbody>
                        @for ($i = 0; $i < count($textAnswers[$question->id]) / 2; $i++)
                           <tr>
                              <td>{{each($textAnswers[$question->id])[1]}}</td>
                              <td>{{each($textAnswers[$question->id])[1]}}</td>
                           </tr>
                        @endfor
                     </tbody>
                  </table>
               </div>
               <!-- /.box-body -->
            </div>
         </div>

      @else

         <div class="col-md-12">
            <div class="box box-primary-ufop">
               <div class="box-header with-border">
                  <h3 class="box-title">{{$question->pergunta}}</h3>
                  <div class="box-tools pull-right">
                     <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                     </button>
                  </div>
               </div>
               <div class="box-body">
                  <div id="chart-area{{$question->id}}" class="chart chart-area">
                     <canvas id="barChart{{$question->id}}"></canvas>
                  </div>
               </div>
               <!-- /.box-body -->
            </div>
         </div>
      @endif

   @endforeach

@endsection

@section('myScripts')

   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

   <script>

   function getRandomColor() {
      var color = 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',';
      return color;
   }

   function showBarValues(){
      var chartInstance = this.chart;
      var ctx = chartInstance.ctx;
      ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, 'bold', Chart.defaults.global.defaultFontFamily);
      ctx.fillStyle = this.chart.config.options.defaultFontColor;
      ctx.textAlign = 'center';
      ctx.textBaseline = 'bottom';
      this.data.datasets.forEach(function (dataset, i) {
         var meta = chartInstance.controller.getDatasetMeta(i);
         if(meta.hidden === null){
            meta.data.forEach(function (bar, index) {
               var data = (dataset.data[index] * 100 / {{$responsesCount}}).toFixed(2);
               if(isNaN(data)){
                  ctx.fillText("0.00%", bar._model.x, bar._model.y);
               }else{
                  ctx.fillText(data + "%", bar._model.x, bar._model.y + 15);
               }
            });
         }
      });
   }

   $(function () {
      /* ChartJS
      * -------
      * Here we will create a few charts using ChartJS
      */

      //--------------
      //- AREA CHART -
      //--------------
      var color = getRandomColor();

      @foreach ($questions->whereIn('tipo_id', [2,3]) as $question)

      var data{{$question->id}} = {
         labels: {!! $question->opcoes->pluck('opcao') !!},
         datasets: [
            {
               backgroundColor: color + '0.2)',
               borderColor: color + '1.0)',
               hoverBackgroundColor: color + '0.3)',
               borderWidth: 1,
               data: {{ json_encode($answers[$question->id]) }}
            },
         ]
      };

      //-------------
      //- BAR CHART -
      //-------------
      var barChart{{$question->id}}Canvas = $("#barChart{{$question->id}}");
      var barChart{{$question->id}}Data = data{{$question->id}};
      var barChart{{$question->id}}Options = {
         scales: {
            yAxes: [{
               ticks: {
                  beginAtZero: true,
                  stepSize: 1
               },
               scalelabel: {
                  display: true
               }
            }]
         },
         tooltips: {
            enabled: true
         },
         hover: {
            animationDuration: 0
         },
         animation: {
            onComplete: showBarValues
         },
         legend: {
            display: false
         },
         responsive: true,
      };

      var barChart{{$question->id}} = new Chart(barChart{{$question->id}}Canvas, {
         type: 'bar',
         data: barChart{{$question->id}}Data,
         options: barChart{{$question->id}}Options
      });

      @endforeach

   });

   </script>

@endsection
