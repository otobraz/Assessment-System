@extends('layout.admin.base')

@section('title')
   Resultados
@endsection

{{-- @section('content-header')
<h1>{{$survey->titulo . " - " . $section->disciplina->disciplina}}</h1>
<hr class="hr-ufop">
@endsection --}}

@section('content')

   @foreach ($questions as $question)

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
               @if ($question->tipo_id == 1)
                  <table class="table table-bordered table-col-condensed table-striped table-responsive">
                     <tbody>
                        @foreach ($textAnswers[$question->id] as $answer)
                           <tr>
                              <td>{{$answer}}</td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               @else
                  <div id="chart-area{{$question->id}}" class="chart chart-area">
                     <canvas id="barChart{{$question->id}}"></canvas>
                  </div>
               @endif

            </div>
            <!-- /.box-body -->
         </div>
      </div>

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
            var total = 0;
            meta.data.forEach(function (bar, index) {
               total += dataset.data[index];
            });
            meta.data.forEach(function (bar, index) {
               var data = (dataset.data[index] * 100 / total).toFixed(2);
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

      color = getRandomColor();

      @foreach ($questions->whereIn('tipo_id', [2,3]) as $question)

      var data{{$question->id}} = {
         labels: {!! $question->opcoes->pluck('opcao') !!},
         datasets: [
            {
               label: "{{ $label }}",
               backgroundColor: color + '0.2)',
               borderColor: color + '1.0)',
               borderWidth: 1,
               hoverBackgroundColor: color + '0.3)',
               data: {{ json_encode($answers[$question->id]) }},
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

         // animation: {
         //    duration: 1,
         //    onComplete: function () {
         //       var chartInstance = this.chart,
         //       barChart{{$question->id}}Canvas = chartInstance.barChart{{$question->id}}Canvas;
         //       barChart{{$question->id}}Canvas.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
         //       barChart{{$question->id}}Canvas.textAlign = 'center';
         //       barChart{{$question->id}}Canvas.textBaseline = 'bottom';
         //
         //       this.data.datasets.forEach(function (dataset, i) {
         //          var meta = chartInstance.controller.getDatasetMeta(i);
         //          meta.data.forEach(function (bar, index) {
         //             var data = dataset.data[index];
         //             barChart{{$question->id}}Canvas.fillText(data, bar._model.x, bar._model.y - 5);
         //          });
         //       });
         //    }
         // },
         // //Boolean - Whether grid lines are shown across the chart
         // scaleShowGridLines: true,
         // //String - Colour of the grid lines
         // scaleGridLineColor: "rgba(0,0,0,.05)",
         // //Number - Width of the grid lines
         // scaleGridLineWidth: 1,
         // //Boolean - Whether to show horizontal lines (except X axis)
         // scaleShowHorizontalLines: true,
         // //Boolean - Whether to show vertical lines (except Y axis)
         // scaleShowVerticalLines: true,
         // //Boolean - If there is a stroke on each bar
         // barShowStroke: true,
         // //Number - Pixel width of the bar stroke
         // barStrokeWidth: 2,
         // //Number - Spacing between each of the X value sets
         // barValueSpacing: 5,
         // //Number - Spacing between data sets within X values
         // barDatasetSpacing: 2,

         //String - A legend template
         // tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>kb",
         // "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><div id=\"col-legend\" class=\"col-md-3\"><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><div id=\"legend-text\"><%if(datasets[i].label){%><%=datasets[i].label%></div></div><%}%><%}%></ul>",
         // legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><div class=\"col-md-3\"><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li></div><%}%></ul>",

         //Boolean - whether to make the chart responsive
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
