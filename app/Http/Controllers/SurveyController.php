<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Questionario;
use App\Models\Professor;
use App\Models\Aluno;
use App\Models\Pergunta;
use App\Models\TipoPergunta;
use App\Models\Turma;
use App\Models\Opcao;
use App\Models\Resposta;
use App\Models\RespostaUnicaEscolha;
use App\Models\RespostaMultiplaEscolha;
use DB;

class SurveyController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {

      switch (session()->get('role')) {
         case '0':
         $surveys = Questionario::all();
         return view ('survey.admin.index', compact('surveys'));
         break;

         case '1':
         $student = Aluno::find(session()->get('id'));
         $sections = $student->turmas;
         $sectionsGroup = $sections->groupBy('ano')->transform(function($item, $k) {
            return $item->groupBy('semestre');
         });
         foreach ($sections as $section) {
            foreach ($section->questionarios as $survey) {
               $responses[$survey->pivot->id] = Resposta::where('questionario_turma_id', $survey->pivot->id)->where('aluno_id', $student->id)->first();
               // $surveys[$section->ano] = $survey;
            }
         }
         // $surveys = collect($surveys);
         // $surveys->sortByDesc('id');
         return view ('survey.student.index', compact('sectionsGroup', 'responses'));
         break;

         case '2':
         $professor = Professor::find(session()->get('id'));
         $surveys = $professor->questionarios->sortByDesc('created_at');
         return view ('survey.professor.index', compact('surveys'));
         break;

         default:
         break;
      }
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      $sections = Professor::find(session()->get('id'))->turmas;
      if(session()->get('role') === '0'){
         return view('survey.admin.create', compact('sections'));
      }else if(session()->get('role') === '2'){
         return view('survey.professor.create', compact('sections'));
      }
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {

      $inputs = $request->except(['_token']);
      $survey = new Questionario([
         'titulo' => array_shift($inputs),
         'descricao' => array_shift($inputs),
         'professor_id' => session()->get('id')
      ]);
      $survey->save();

      foreach (array_shift($inputs) as $input){
         if(!empty($input)){
            $survey->turmas()->attach($input);
         }
      }

      foreach ($inputs as $input){
         if(is_array($input)){
            $question = new Pergunta([
               'tipo_id' => array_shift($input),
               'pergunta' => array_shift($input),
            ]);
            $question->professor_id = session()->get('id');
            $question->save();
            $question->questionarios()->attach($survey->id);
            if($question->tipo_id != 1){
               foreach ($input as $choice){
                  if(!empty($choice)){
                     $choice = new Opcao([
                        'opcao' => $choice,
                        'pergunta_id' => $question->id
                     ]);
                     $choice->save();
                  }
               }
            }
         }else{
            $question = Pergunta::find($input);
            $question->questionarios()->attach($survey->id);
         }
      }
      return redirect()->route('survey.index')->with('successMessage', 'Questionário criado com sucesso');
   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {

      switch (session()->get('role')) {
         case '0':
         $survey = Questionario::find(decrypt($id));
         $questions = $survey->perguntas;
         return view('survey.admin.show', compact('survey', 'questions'));
         break;

         case '1':
         $survey = Questionario::find(decrypt($id));
         $questions = $survey->perguntas;
         return view('survey.student.show', compact('survey', 'questions'));
         break;

         case '2':
         $survey = Questionario::find(decrypt($id));
         $questions = $survey->perguntas;
         return view('survey.professor.show', compact('survey', 'questions'));
         break;
         default:
         break;
      }

   }

   public function showSections($id){

      $survey = Questionario::find(decrypt($id));
      $sections = $survey->turmas;
      return view('survey.professor.show-sections', compact('sections', 'survey'));

   }

   public function showResponses($id){
      $responses = Resposta::where('questionario_turma_id', decrypt($id))->get();
      return view('survey.admin.show-responses', compact('responses'));
   }

   public function provide($id){
      $survey = Questionario::find(decrypt($id));
      $sections = Professor::find(session()->get('id'))->turmas;
      $sectionsGroup = $sections->groupBy('ano')->transform(function($item, $k) {
         return $item->groupBy('semestre');
      });
      return view('survey.professor.attach', compact('survey', 'sectionsGroup'));
   }

   public function attach(Request $request){
      $surveyId = $request->input('survey-id');
      foreach ($request->input('sections') as $sectionId) {
         Turma::find($sectionId)->questionarios()->attach($surveyId);
      }
      return redirect()->route('survey.index')->with(successMessage('Questionário disponibilizado com sucesso.'));
   }

   public function open($id){
      $surveySection = DB::table('questionario_turma')->where('id', decrypt($id));
      if(!$surveySection->first()->aberto){
         $surveySection->update(['aberto' => 1]);
         return redirect()->route('survey.index')->with('successMessage', 'Questionário aberto com sucesso.');
      }
      return back()->with('errorMessage', 'Questionário já está aberto.');
   }

   public function close($id){
      $surveySection = DB::table('questionario_turma')->where('id', decrypt($id));
      if($surveySection->first()->aberto){
         $surveySection->update(['aberto' => 0]);
         return redirect()->route('survey.index')->with('successMessage', 'Questionário fechado com sucesso.');
      }
      return back()->with('errorMessage', 'Questionário já está fechado.');
   }

   public function getClassAnswers($survey, $section, $questions){

      $surveySection = DB::table('questionario_turma')->where('questionario_id', $survey->id)->where('turma_id', $section->id)->get();

      $answers = array();
      foreach ($surveySection as $sS) {
         $responses = Resposta::where('questionario_turma_id', $sS->id)->get();
         $questionAnswers = array();
         foreach ($questions as $question) {
            $questionAnswers[$question->id] = array();
            foreach ($question->opcoes as $choice) {
               $questionAnswers[$question->id][$choice->id] = 0;
            }
         }
         foreach ($responses as $response){
            $resp = RespostaUnicaEscolha::where('resposta_id', $response->id)->get();
            $respM = RespostaMultiplaEscolha::where('resposta_id', $response->id)->get();
            foreach ($questions as $question){
               switch ($question->tipo_id) {

                  case 2:
                  $choice = $resp->where('pergunta_id', $question->id)->first();
                  // dd($resp);
                  $questionAnswers[$question->id][$choice->opcao_id]++;
                  break;

                  case 3:
                  $choice = $respM->where('pergunta_id', $question->id)->first();
                  $choices = DB::table('opcao_resposta_multipla_escolha')->where('resposta_me_id', $choice->id)->get();
                  foreach ($choices as $choice){
                     $questionAnswers[$question->id][$choice->opcao_id]++;
                  }
                  break;
               }

            }
         }
         foreach ($questionAnswers as $key => $value) {
            $questionAnswers[$key] = array_values($questionAnswers[$key]);
         }
      }
      return $questionAnswers;
   }

   public function postResults(Request $request){

      $sectionsInput = $request->input('sections');
      $survey = Questionario::find($request->input('surveyId'));
      $questions = $survey->perguntas()->where('tipo_id', '!=', '1')->get();

      foreach ($sectionsInput as $section) {
         $answers[] = $this->getClassAnswers($survey, Turma::find($section), $questions);
         $section = Turma::find($section);
         $labels[] = "Turma " . $section->cod_turma . " - " . $section->disciplina->disciplina . " - " . $section->ano . "/" . $section->semestre;
      }

      switch (session()->get('role')) {
         case '0':
         return view('survey.admin.results-compared', compact('survey', 'questions', 'answers', 'labels'));
         break;

         case '1':
         return view('survey.student.results-compared', compact('survey', 'questions', 'answers', 'labels'));
         break;

         case '2':
         return view('survey.professor.results-compared', compact('survey', 'questions', 'answers', 'labels'));
         break;

         default:
         break;
      }


   }

   public function classResults($surveySectionId){

      $surveySection = DB::table('questionario_turma')->where('id', decrypt($surveySectionId))->first();
      $survey = Questionario::find($surveySection->questionario_id);
      $questions = $survey->perguntas()->where('tipo_id', '!=', '1')->get();
      $section = Turma::find($surveySection->turma_id);


      // $answers = array();
      $responses = Resposta::where('questionario_turma_id', $surveySection->id)->get();
      // $questionAnswers = array();
      foreach ($questions as $question) {
         // $questionAnswers[$question->id] = array();
         foreach ($question->opcoes as $choice) {
            $questionAnswers[$question->id][$choice->id] = 0;
         }
      }
      foreach ($responses as $response){
         $resp = RespostaUnicaEscolha::where('resposta_id', $response->id)->get();
         $respM = RespostaMultiplaEscolha::where('resposta_id', $response->id)->get();
         foreach ($questions as $question){
            switch ($question->tipo_id) {
               case 2:
               $choice = $resp->where('pergunta_id', $question->id)->first();
               $questionAnswers[$question->id][$choice->opcao_id]++;
               break;

               case 3:
               $choice = $respM->where('pergunta_id', $question->id)->first();
               $choices = DB::table('opcao_resposta_multipla_escolha')->where('resposta_me_id', $choice->id)->get();
               foreach ($choices as $choice){
                  $questionAnswers[$question->id][$choice->opcao_id]++;
               }
               break;
            }

         }
      }
      foreach ($questionAnswers as $key => $value) {
         $questionAnswers[$key] = array_values($questionAnswers[$key]);
      }
      $answers[] = $questionAnswers;
      $labels[] = "Turma " . $section->cod_turma . " - " . $section->disciplina->disciplina . " - " . $section->ano . "/" . $section->semestre . " - Data: " . date("d/m/y", strtotime($surveySection->created_at));

      switch (session()->get('role')) {
         case '0':
         return view('survey.admin.class-results', compact('survey', 'questions', 'answers', 'labels'));
         break;

         case '1':
         return view('survey.student.class-results', compact('survey', 'questions', 'answers', 'labels'));
         break;

         case '2':
         return view('survey.professor.class-results', compact('survey', 'questions', 'answers', 'labels'));
         break;

         default:
         break;
      }

   }

   public function getResults($surveyId){

      $survey = Questionario::find(decrypt($surveyId));
      $questions = $survey->perguntas()->where('tipo_id', '!=', '1')->get();
      $responses = Resposta::where('questionario_id', $survey->id)->get();

      foreach ($questions as $question) {
         foreach ($question->opcoes as $choice) {
            $questionAnswers[$question->id][$choice->id] = 0;
         }
      }

      foreach ($responses as $response){
         $resp = RespostaUnicaEscolha::where('resposta_id', $response->id)->get();
         $respM = RespostaMultiplaEscolha::where('resposta_id', $response->id)->get();
         foreach ($questions as $question){
            switch ($question->tipo_id) {
               case 2:
               $choice = $resp->where('pergunta_id', $question->id)->first();
               $questionAnswers[$question->id][$choice->opcao_id]++;
               break;

               case 3:
               $choice = $respM->where('pergunta_id', $question->id)->first();
               $choices = DB::table('opcao_resposta_multipla_escolha')->where('resposta_me_id', $choice->id)->get();
               foreach ($choices as $choice){
                  $questionAnswers[$question->id][$choice->opcao_id]++;
               }
               break;
            }

         }
      }
      foreach ($questionAnswers as $key => $value) {
         $answers[$key] = array_values($questionAnswers[$key]);
      }

      switch (session()->get('role')) {
         case '0':
         return view('survey.admin.results', compact('survey', 'questions', 'answers', 'labels'));
         break;

         case '1':
         return view('survey.student.results', compact('survey', 'questions', 'answers', 'labels'));
         break;

         case '2':
         return view('survey.professor.results', compact('survey', 'questions', 'answers', 'labels'));
         break;

         default:
         break;
      }
   }



   // Ajax functions

   public function ajaxShowQuestion($id){
      $question = Pergunta::find($id);
      return view('survey.ajax.question', compact('question'))->render();
   }

   public function ajaxSelectQuestion($count){
      $defaultQuestions = Pergunta::all();
      $professorQuestions = Professor::find(session()->get('id'))->perguntas;
      return view('survey.ajax.select-questions', compact('defaultQuestions', 'professorQuestions', 'count'))->render();
   }

   public function ajaxCreateQuestion($count){
      $questionTypes = TipoPergunta::all();
      return view('survey.ajax.create-question', compact('questionTypes', 'count'))->render();
   }

   public function ajaxCreateInput($name, $questionType){
      switch ($questionType) {
         case '1':
         return view('survey.ajax.text-input', compact('name'))->render();
         break;

         case '2':
         return view('survey.ajax.radio-input', compact('name'))->render();
         break;

         case '3':
         return view('survey.ajax.checkbox-input', compact('name'))->render();
         break;
      }
   }

}
