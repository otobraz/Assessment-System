@extends('layout.prograd.base')

@section('title')
   Resultados
@endsection

@section('content')

   @foreach ($questions as $question)

      @if ($question->tipo_id == 1)
         <div class="box box-primary-ufop">
            <div class="box-header with-border">
               <h3 class="box-title">{{$question->pergunta}}</h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
               </div>
            </div>
            <div class="box-body">
               @foreach ($textAnswers as $key => $texts)
                  <div class="col-md-6">
                     <table class="table table-bordered table-col-condensed table-striped table-responsive">
                        <thead>
                           <tr>
                              <th>{{$labels[$key]}}</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($texts[$question->id] as $text)
                              <tr>
                                 <td>{{$text}}</td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               @endforeach
            </div>
         </div>
      @else
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
         </div>
      @endif



   @endforeach

@endsection

@section('myScripts')

   {{-- <script src="{{asset('plugins/chartjs/Chart.min.js')}}"></script> --}}

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
               var count = {{ json_encode($responsesCount)}}
               var data = (dataset.data[index] * 100 / count[i]).toFixed(2);
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

      var colors = [];
      @foreach ($answers as $key => $answer)
      colors[{{$key}}] = getRandomColor();
      @endforeach

      @foreach ($questions->whereIn('tipo_id', [2,3]) as $question)

      var data{{$question->id}} = {
         labels: {!! $question->opcoes->pluck('opcao') !!},
         datasets: [
            @foreach ($answers as $aK => $answer)
            {
               label: "{{ $labels[$aK] }}",
               backgroundColor: colors[{{$aK}}] + '0.2)',
               borderColor: colors[{{$aK}}] + '1.0)',
               hoverBackgroundColor: colors[{{$aK}}] + '0.3)',
               borderWidth: 1,
               data: {{ json_encode($answer[$question->id]) }},
            },
            @endforeach
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
            enabled: true,
            bodyFontStyle: 'bold',
            callbacks: {
               label: function(tooltipItem) {
                  var count = {{ json_encode($responsesCount)}};
                  var percentage = (tooltipItem.yLabel * 100 / count[tooltipItem.datasetIndex]).toFixed(2);
                  if(isNaN(percentage)){
                     return " " + tooltipItem.yLabel + " (0%)";
                  }else{
                     return " " + tooltipItem.yLabel + " (" + percentage + "%)";
                  }
               }
            }
         },

         hover: {
            animationDuration: 0
         },

         animation: {
            onComplete: showBarValues
         },

         legend: {
            labels: {
               fontStyle: 'bold',
               usePointStyle: true
            }
         },

         responsive: true,
      };

      var barChart{{$question->id}} = new Chart(barChart{{$question->id}}Canvas, {
         type: 'bar',
         data: barChart{{$question->id}}Data,
         options: barChart{{$question->id}}Options
      });

      // var bar = barChart{{$question->id}}.Bar(barChart{{$question->id}}Data, barChart{{$question->id}}Options);
      //
      // var legendHolder = document.createElement('div');
      // legendHolder.innerHTML = bar.generateLegend();
      //
      // document.getElementById('legend{{$question->id}}').appendChild(legendHolder.firstChild);

      @endforeach

   });

   </script>

@endsection
