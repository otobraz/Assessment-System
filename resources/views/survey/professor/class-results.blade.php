@extends('layout.professor.base')

@section('title')
   Resultados
@endsection

@section('content-header')
   <h1>{{$survey->titulo . " - " . $section->disciplina->disciplina}}</h1>

   <hr class="hr-ufop">
@endsection

@section('content')

   @foreach ($questions as $question)

      <div class="col-md-offset-1 col-md-10">
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
               <div class="chart">
                  <canvas id="barChart{{$question->id}}"></canvas>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
      </div>

   @endforeach

@endsection

@section('myScripts')

   <script src="{{asset('plugins/chartjs/Chart.min.js')}}"></script>

   <script>

   function getRandomColor() {

      var letters = '23456789ABCDEF';
      var color = '#00';
      for (var i = 0; i < 6; i++ ) {
         color += letters[Math.floor(Math.random() * 14)];
      }
      return color;
   }

   $(function () {
      /* ChartJS
      * -------
      * Here we will create a few charts using ChartJS
      */

      //--------------
      //- AREA CHART -
      //--------------

      var colors = [];
      @foreach ($answers as $key => $answer)
         colors[{{$key}}] = getRandomColor();
      @endforeach

      @foreach ($questions as $question)

      var data{{$question->id}} = {
         labels: {!! $question->opcoes->pluck('opcao') !!},
         datasets: [
            @foreach ($answers as $aK => $answer)
            {
               fillColor: colors[{{$aK}}],
               strokeColor: colors[{{$aK}}],
               pointColor: colors[{{$aK}}],
               pointStrokeColor: colors[{{$aK}}],
               pointHighlightFill: "#fff",
               pointHighlightStroke: colors[{{$aK}}],
               data: {{ json_encode($answer[$question->id]) }},
            },
            @endforeach
         ]
      };

      //-------------
      //- BAR CHART -
      //-------------
      var barChart{{$question->id}}Canvas = $("#barChart{{$question->id}}").get(0).getContext("2d");
      var barChart{{$question->id}} = new Chart(barChart{{$question->id}}Canvas);
      var barChart{{$question->id}}Data = data{{$question->id}};
      var barChart{{$question->id}}Options = {
         //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
         scaleBeginAtZero: true,
         //Boolean - Whether grid lines are shown across the chart
         scaleShowGridLines: true,
         //String - Colour of the grid lines
         scaleGridLineColor: "rgba(0,0,0,.05)",
         //Number - Width of the grid lines
         scaleGridLineWidth: 1,
         //Boolean - Whether to show horizontal lines (except X axis)
         scaleShowHorizontalLines: true,
         //Boolean - Whether to show vertical lines (except Y axis)
         scaleShowVerticalLines: true,
         //Boolean - If there is a stroke on each bar
         barShowStroke: true,
         //Number - Pixel width of the bar stroke
         barStrokeWidth: 2,
         //Number - Spacing between each of the X value sets
         barValueSpacing: 5,
         //Number - Spacing between data sets within X values
         barDatasetSpacing: 2,
         //String - A legend template
         legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
         //Boolean - whether to make the chart responsive
         responsive: true,
         maintainAspectRatio: true
      };

      barChart{{$question->id}}Options.datasetFill = false;
      barChart{{$question->id}}.Bar(barChart{{$question->id}}Data, barChart{{$question->id}}Options);

      @endforeach

   });

   </script>

@endsection
