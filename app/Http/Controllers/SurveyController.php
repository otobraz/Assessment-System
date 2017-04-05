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
use App\Models\RespostaAberta;
use App\Models\RespostaUnicaEscolha;
use App\Models\RespostaMultiplaEscolha;
use App\Models\Departamento;
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
         $surveys = Questionario::where('professor_id', '<>', NULL)->get();
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
            }
         }
         return view ('survey.student.index', compact('sectionsGroup', 'responses'));
         break;

         case '2':
         $professor = Professor::find(session()->get('id'));
         $surveys = $professor->questionarios->sortByDesc('created_at');
         return view ('survey.professor.index', compact('surveys'));
         break;

         case '3':
         $surveys = Questionario::all();
         return view ('survey.prograd.index', compact('surveys'));
         break;

         default:
         break;
      }
   }

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function generalSurveysIndex(){

      $surveys = Questionario::where('professor_id', NULL)->get();

      switch (session()->get('role')) {
         case '0':
         return view ('survey.admin.general-surveys-index', compact('surveys'));
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
            }
         }
         return view ('survey.student.index', compact('sectionsGroup', 'responses'));
         break;

         case '2':
         return view ('survey.professor.general-surveys-index', compact('surveys'));
         break;

         case '3':
         return view ('survey.prograd.general-surveys-index', compact('surveys'));
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

      switch (session()->get('role')) {
         case '0':
         return view('survey.admin.create');
         break;

         case '2':
         $sections = Professor::find(session()->get('id'))->turmas;
         return view('survey.professor.create', compact('sections'));
         break;

         case '3':
         return view('survey.prograd.create');
         break;

         default:
         return redirect('home');
         break;
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
      if (session()->get('role') == 2){
         $survey = new Questionario([
            'titulo' => array_shift($inputs),
            'descricao' => array_shift($inputs),
            'professor_id' => session()->get('id')
         ]);
         foreach (array_shift($inputs) as $input){
            if(!empty($input)){
               $survey->turmas()->attach($input);
            }
         }
      }else{
         $survey = new Questionario([
            'titulo' => array_shift($inputs),
            'descricao' => array_shift($inputs),
            'professor_id' => NULL
         ]);
      }

      $survey->save();
      $n = 1;

      foreach ($inputs as $input){
         if(is_array($input)){
            $question = new Pergunta([
               'tipo_id' => array_shift($input),
               'pergunta' => array_shift($input),
            ]);
            $question->professor_id = session()->get('id');
            $question->save();
            $question->questionarios()->attach($survey->id, ['numero' => $n]);
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
            $question->questionarios()->attach($survey->id, ['numero' => $n]);
         }
         $n++;
      }
      if(session()->get('role') == 2){
         return redirect()->route('survey.index')->with('successMessage', 'Questionário criado com sucesso');
      }
      return redirect()->route('survey.generalSurveysIndex')->with('successMessage', 'Questionário criado com sucesso');
   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {

      $survey = Questionario::find(decrypt($id));
      $questions = $survey->perguntas()->orderBy('numero')->get();

      if(!is_null($survey->professor_id)){
         switch (session()->get('role')) {
            case '0':
            return view('survey.admin.show', compact('survey', 'questions'));
            break;

            case '1':
            return view('survey.student.show', compact('survey', 'questions'));
            break;

            case '2':
            return view('survey.professor.show', compact('survey', 'questions'));
            break;

            case '3':
            return view('survey.prograd.show', compact('survey', 'questions'));
            break;

            default:
            return redirect('home');
            break;
         }
      }else{
         $departments = array();

         $sectionsGroup = $survey->turmas->groupBy('ano')->transform(function($item, $k) {
            return $item->groupBy('semestre');
         });

         foreach ($sectionsGroup as $year => $years) {

            foreach ($years as $semester => $semesters) {

               $departments[$year][$semester] = collect();
               foreach(Departamento::all() as $department){

                  if($semesters->where('departamento_id', $department->id)->count() > 0){
                     $departments[$year][$semester]->push($department);

                     $responsesCount[$year][$semester][$department->id] = 0;

                     foreach ($department->turmas as $section) {

                        $surveySection = DB::table('questionario_turma')->where('questionario_id', $survey->id)
                        ->where('turma_id', $section->id)->first();

                        $responses = Resposta::where('questionario_turma_id', $surveySection->id)->get();
                        $responsesCount[$year][$semester][$department->id] += $responses->count();

                     }
                  }
               }
            }
         }
         switch (session()->get('role')) {
            case '0':
            return view('survey.admin.general-survey-show', compact('survey', 'questions', 'departments', 'responsesCount'));
            break;

            case '1':
            return view('survey.student.general-survey-show', compact('survey', 'questions', 'departments', 'responsesCount'));
            break;

            case '2':
            return view('survey.professor.general-survey-show', compact('survey', 'questions', 'departments', 'responsesCount'));
            break;

            case '3':
            return view('survey.prograd.general-survey-show', compact('survey', 'questions', 'departments', 'responsesCount'));
            break;

            default:
            return redirect('home');
            break;
         }
      }
      return redirect('home');
   }

   // Show the sections from a departmentId
   public function generalSurveyDepartmentSections($year, $semester, $departmentId, $surveyId){

      $department = Departamento::find(decrypt($departmentId));
      $survey = Questionario::find(decrypt($surveyId));
      $questions = $survey->perguntas()->orderBy('numero')->get();

      $sections = $survey->turmas->where('departamento_id', $department->id)
      ->where('ano', $year)->where('semestre', $semester);

      $responsesCount = array();

      foreach ($sections as $section) {
         $responses = Resposta::where('questionario_turma_id', $section->pivot->id)->get();
         $responsesCount[$section->pivot->id] = $responses->count();
      }

      return view('survey.professor.department-sections', compact('survey', 'questions', 'sections', 'department', 'year', 'semester', 'responsesCount'));

   }

   public function showSections($id){

      $survey = Questionario::find(decrypt($id));
      $sections = $survey->turmas;
      return view('survey.professor.show-sections', compact('sections', 'survey'));

   }

   // Show responses from a survey
   public function showResponses($id){
      $responses = Resposta::where('questionario_turma_id', decrypt($id))->get();
      return view('survey.admin.show-responses', compact('responses'));
   }

   // Show the form for providing a survey to the professor's classes
   public function provide($id){
      $survey = Questionario::find(decrypt($id));
      $sections = Professor::find(session()->get('id'))->turmas()->orderByDisciplina()->get()->groupBy('ano');

      if($sections->isEmpty()){

         return back()->with('errorMessage', 'Você não possui turmas para disponibilizar o questionário.');
      }

      $sectionsGroup = $sections->transform(function($item, $k) {
         return $item->groupBy('semestre');
      });

      return view('survey.professor.provide', compact('survey', 'sectionsGroup'));
   }

   // Attaches the survey to the classes the professor has choosen
   public function attach(Request $request){
      foreach ($request->input('sections') as $sectionId) {
         Turma::find($sectionId)->questionarios()->attach($request->input('survey-id'));
      }
      return redirect()->route('survey.index')->with('successMessage', 'Questionário disponibilizado com sucesso.');
   }

   // Show the form for providing a survey to the department classes
   public function generalSurveyProvide($id){
      $survey = Questionario::find(decrypt($id));
      $departments = Departamento::all();
      return view('survey.admin.provide', compact('survey', 'departments'));
   }

   // Attaches the survey to all the classes from the departments that have been choosen
   public function generalSurveyAttach(Request $request){
      foreach ($request->input('departments') as $departmentId) {
         $sections = Turma::where('departamento_id', $departmentId)
         ->where('ano', Turma::max('ano'))
         ->where('semestre', Turma::max('semestre'))
         ->get();
         foreach ($sections as $section) {
            $section->questionarios()->attach($request->input('survey-id'));
         }
      }
      return redirect()->route('survey.generalSurveysIndex')->with('successMessage', 'Questionário disponibilizado com sucesso.');
   }

   // Opens a survey
   public function open($id){
      $surveySection = DB::table('questionario_turma')->where('id', decrypt($id));
      if(!$surveySection->first()->aberto){
         $surveySection->update(['aberto' => 1]);
         return redirect()->route('survey.index')->with('successMessage', 'Questionário aberto com sucesso.');
      }
      return back()->with('errorMessage', 'Questionário já está aberto.');
   }

   // Closes a survey
   public function close($id){
      $surveySection = DB::table('questionario_turma')->where('id', decrypt($id));
      if($surveySection->first()->aberto){
         $surveySection->update(['aberto' => 0]);
         return redirect()->route('survey.index')->with('successMessage', 'Questionário fechado com sucesso.');
      }
      return back()->with('errorMessage', 'Questionário já está fechado.');
   }

   /**
   * Gets the answers a class has given to a survey
   *
   * @return array(textAnswers[], choiceAnswers[], int responsesCount)
   */
   public function getClassAnswers($survey, $section, $questions){

      $surveySection = DB::table('questionario_turma')->where('questionario_id', $survey->id)->where('turma_id', $section->id)->get();

      $textAnswers = array();
      $answers = array();
      $responsesCount = 0;

      foreach ($surveySection as $sS) {
         $responses = Resposta::where('questionario_turma_id', $sS->id)->get();
         $responsesCount += $responses->count();
         foreach ($questions as $question) {
            if($question->tipo_id == 1){
               $textAnswers[$question->id] = array();
            }else{
               foreach ($question->opcoes as $choice) {
                  $answers[$question->id][$choice->id] = 0;
               }
            }
         }

         foreach ($responses as $response){
            $resp = RespostaUnicaEscolha::where('resposta_id', $response->id)->get();
            $respM = RespostaMultiplaEscolha::where('resposta_id', $response->id)->get();
            foreach ($questions as $question){
               switch ($question->tipo_id) {

                  case 1:
                  $textAnswers[$question->id][] = RespostaAberta::where('resposta_id', $response->id)
                  ->where('pergunta_id', $question->id)->first()->resposta;
                  break;

                  case 2:
                  $choice = $resp->where('pergunta_id', $question->id)->first();
                  $answers[$question->id][$choice->opcao_id]++;
                  break;

                  case 3:
                  $choice = $respM->where('pergunta_id', $question->id)->first();
                  $choices = DB::table('opcao_resposta_multipla_escolha')->where('resposta_me_id', $choice->id)->get();
                  foreach ($choices as $choice){
                     $answers[$question->id][$choice->opcao_id]++;
                  }
                  break;
               }

            }
         }
         foreach ($answers as $key => $value) {
            $answers[$key] = array_values($answers[$key]);
         }
      }
      return array($textAnswers, $answers, $responsesCount);
   }

   /**
   * Gets the answers a department has given to a survey
   *
   * @return array(textAnswers[], choiceAnswers[], int responsesCount)
   */
   public function getDepartmentAnswers($survey, $department, $questions, $year, $semester){

      $sections = $department->turmas()->where('ano', $year)->where('semestre', $semester)->get();

      $responsesCount = 0;

      $textAnswers = array();
      $answers = array();

      foreach ($questions as $question) {
         if($question->tipo_id == 1){
            $textAnswers[$question->id] = array();
         }else{
            foreach ($question->opcoes as $choice) {
               $answers[$question->id][$choice->id] = 0;
            }
         }
      }

      foreach ($sections as $section) {
         $surveySection = DB::table('questionario_turma')->where('questionario_id', $survey->id)
         ->where('turma_id', $section->id)->first();

         $responses = Resposta::where('questionario_turma_id', $surveySection->id)->get();

         foreach ($responses as $response){
            $resp = RespostaUnicaEscolha::where('resposta_id', $response->id)->get();
            $respM = RespostaMultiplaEscolha::where('resposta_id', $response->id)->get();
            foreach ($questions as $question){
               switch ($question->tipo_id) {
                  case 1:
                  $textAnswers[$question->id][] = RespostaAberta::where('resposta_id', $response->id)
                  ->where('pergunta_id', $question->id)->first()->resposta;
                  break;
                  case 2:
                  $choice = $resp->where('pergunta_id', $question->id)->first();
                  $answers[$question->id][$choice->opcao_id]++;
                  break;

                  case 3:
                  $choice = $respM->where('pergunta_id', $question->id)->first();
                  $choices = DB::table('opcao_resposta_multipla_escolha')->where('resposta_me_id', $choice->id)->get();
                  foreach ($choices as $choice){
                     $answers[$question->id][$choice->opcao_id]++;
                  }
                  break;
               }
            }
         }
         $responsesCount += $responses->count();

      }

      foreach ($answers as $key => $value) {
         $answers[$key] = array_values($answers[$key]);
      }

      return array($textAnswers, $answers, $responsesCount);

   }

   // Renders the view to show the comparison of responses given by the sections the user has choosen
   public function comparedResult(Request $request){

      $sectionsInput = $request->input('sections');
      $survey = Questionario::find($request->input('surveyId'));
      if(session()->get('role') != 1){
         $questions = $survey->perguntas()->orderBy('numero')->get();
      }else{
         $questions = $survey->perguntas()->where('tipo_id', '!=', 1)->orderBy('numero')->get();
      }
      foreach ($sectionsInput as $section) {
         $sectionAnswers = $this->getClassAnswers($survey, Turma::find($section), $questions);
         $textAnswers[] = $sectionAnswers[0];
         $answers[] = $sectionAnswers[1];
         $responsesCount[] = $sectionAnswers[2];
         $section = Turma::find($section);
         $labels[] = $label = "T" . $section->cod_turma . ": " . $section->disciplina->disciplina . " - " . $section->ano . "/" . $section->semestre . " (TOTAL: " . $sectionAnswers[2] . ")";
      }

      switch (session()->get('role')) {
         case '0':
         return view('survey.admin.compared-result', compact('survey', 'questions', 'answers', 'labels', 'textAnswers', 'responsesCount'));
         break;

         case '1':
         return view('survey.student.compared-result', compact('survey', 'questions', 'answers', 'labels', 'responsesCount'));
         break;

         case '2':
         return view('survey.professor.compared-result', compact('survey', 'questions', 'answers', 'labels', 'textAnswers', 'responsesCount'));
         break;

         case '3':
         return view('survey.prograd.compared-result', compact('survey', 'questions', 'answers', 'labels', 'textAnswers', 'responsesCount'));
         break;

         default:
         return redirect('home');
         break;
      }

   }

   // Renders the view to show the comparison of responses given by the departments the admin has choosen
   public function generalSurveyComparedResult(Request $request){

      $departmentsInput = $request->input('departments');
      $survey = Questionario::find($request->input('surveyId'));
      if(session()->get('role') != 1){
         $questions = $survey->perguntas()->orderBy('numero')->get();
      }else{
         $questions = $survey->perguntas()->where('tipo_id', '!=', 1)->orderBy('numero')->get();
      }
      foreach ($departmentsInput as $departmentId) {
         $department = Departamento::find($departmentId);
         $departmentAnswers = $this->getDepartmentAnswers($survey, $department, $questions, $request->input('year'), $request->input('semester'));
         $textAnswers[] = $departmentAnswers[0];
         $answers[] = $departmentAnswers[1];
         $responsesCount[] = $departmentAnswers[2];
         $labels[] = $department->cod_departamento . " - " . $request->input('year') . "/" . $request->input('semester') . " (TOTAL: " . $departmentAnswers[2] . ")";
      }
      switch (session()->get('role')) {
         case '0':
         return view('survey.admin.compared-result', compact('survey', 'questions', 'answers', 'labels', 'textAnswers', 'responsesCount'));
         break;

         case '1':
         return view('survey.student.compared-result', compact('survey', 'questions', 'answers', 'labels', 'responsesCount'));
         break;

         case '2':
         return view('survey.professor.compared-result', compact('survey', 'questions', 'answers', 'labels', 'textAnswers', 'responsesCount'));
         break;

         case '3':
         return view('survey.prograd.compared-result', compact('survey', 'questions', 'answers', 'labels', 'textAnswers', 'responsesCount'));
         break;

         default:
         return redirect('home');
         break;
      }
   }

   // Renders the view to show the responses of a class
   public function classResult($surveySectionId){

      $surveySection = DB::table('questionario_turma')->where('id', decrypt($surveySectionId))->first();
      $survey = Questionario::find($surveySection->questionario_id);
      if(session()->get('role') != 1){
         $questions = $survey->perguntas()->orderBy('numero')->get();
      }else{
         $questions = $survey->perguntas()->where('tipo_id', '!=', 1)->orderBy('numero')->get();
      }
      $section = Turma::find($surveySection->turma_id);
      $responses = Resposta::where('questionario_turma_id', $surveySection->id)->get();
      foreach ($questions as $question) {
         if($question->tipo_id == 1){
            $textAnswers[$question->id] = array();
         }else{
            foreach ($question->opcoes as $choice) {
               $answers[$question->id][$choice->id] = 0;
            }
         }
      }
      foreach ($responses as $response){
         $resp = RespostaUnicaEscolha::where('resposta_id', $response->id)->get();
         $respM = RespostaMultiplaEscolha::where('resposta_id', $response->id)->get();
         foreach ($questions as $question){
            switch ($question->tipo_id) {
               case 1:
               $textAnswers[$question->id][] = RespostaAberta::where('resposta_id', $response->id)
               ->where('pergunta_id', $question->id)->first()->resposta;
               break;
               case 2:
               $choice = $resp->where('pergunta_id', $question->id)->first();
               $answers[$question->id][$choice->opcao_id]++;
               break;

               case 3:
               $choice = $respM->where('pergunta_id', $question->id)->first();
               $choices = DB::table('opcao_resposta_multipla_escolha')->where('resposta_me_id', $choice->id)->get();
               foreach ($choices as $choice){
                  $answers[$question->id][$choice->opcao_id]++;
               }
               break;
            }

         }
      }
      foreach ($answers as $key => $value) {
         $answers[$key] = array_values($answers[$key]);
      }
      $label = "T" . $section->cod_turma . ": " . $section->disciplina->disciplina . " - " . $section->ano . "/" . $section->semestre . " - Data: " . date("d/m/y", strtotime($surveySection->created_at)) . " (TOTAL: " . $responses->count() . ")";
      $responsesCount = $responses->count();
      switch (session()->get('role')) {
         case '0':
         return view('survey.admin.class-result', compact('survey', 'questions', 'answers', 'label', 'responsesCount', 'textAnswers'));
         break;

         case '1':
         return view('survey.student.class-result', compact('survey', 'questions', 'answers', 'label', 'responsesCount'));
         break;

         case '2':
         return view('survey.professor.class-result', compact('survey', 'questions', 'answers', 'label', 'responsesCount', 'textAnswers'));
         break;

         case '3':
         return view('survey.prograd.class-result', compact('survey', 'questions', 'answers', 'label', 'responsesCount', 'textAnswers'));
         break;

         default:
         return redirect('home');
         break;
      }

   }

   // Renders the view to show the responses of a department
   public function departmentResult($year, $semester, $surveyId, $departmentId){

      $department = Departamento::find(decrypt($departmentId));
      $survey = Questionario::find(decrypt($surveyId));
      $sections = $department->turmas()->where('ano', $year)->where('semestre', $semester)->get();

      $responsesCount = 0;

      if(session()->get('role') != 1){
         $questions = $survey->perguntas()->orderBy('numero')->get();
      }else{
         $questions = $survey->perguntas()->where('tipo_id', '!=', 1)->orderBy('numero')->get();
      }

      foreach ($questions as $question) {
         if($question->tipo_id == 1){
            $textAnswers[$question->id] = array();
         }else{
            foreach ($question->opcoes as $choice) {
               $answers[$question->id][$choice->id] = 0;
            }
         }
      }

      foreach ($sections as $section) {
         $surveySection = DB::table('questionario_turma')->where('questionario_id', $survey->id)
         ->where('turma_id', $section->id)->first();

         $responses = Resposta::where('questionario_turma_id', $surveySection->id)->get();

         foreach ($responses as $response){
            $resp = RespostaUnicaEscolha::where('resposta_id', $response->id)->get();
            $respM = RespostaMultiplaEscolha::where('resposta_id', $response->id)->get();
            foreach ($questions as $question){
               switch ($question->tipo_id) {
                  case 1:
                  $textAnswers[$question->id][] = RespostaAberta::where('resposta_id', $response->id)
                  ->where('pergunta_id', $question->id)->first()->resposta;
                  break;
                  case 2:
                  $choice = $resp->where('pergunta_id', $question->id)->first();
                  $answers[$question->id][$choice->opcao_id]++;
                  break;

                  case 3:
                  $choice = $respM->where('pergunta_id', $question->id)->first();
                  $choices = DB::table('opcao_resposta_multipla_escolha')->where('resposta_me_id', $choice->id)->get();
                  foreach ($choices as $choice){
                     $answers[$question->id][$choice->opcao_id]++;
                  }
                  break;
               }
            }
         }
         $responsesCount += $responses->count();

      }

      foreach ($answers as $key => $value) {
         $answers[$key] = array_values($answers[$key]);
      }

      $label = $department->departamento . " - " . $year . "/" . $semester . " (TOTAL: " . $responsesCount . ")";

      switch (session()->get('role')) {
         case '0':
         return view('survey.admin.department-result', compact('survey', 'questions', 'answers', 'label', 'responsesCount', 'textAnswers', 'department'));
         break;

         case '1':
         return view('survey.student.department-result', compact('survey', 'questions', 'answers', 'label', 'responsesCount', 'department'));
         break;

         case '2':
         return view('survey.professor.department-result', compact('survey', 'questions', 'answers', 'label', 'responsesCount', 'textAnswers', 'department'));
         break;

         case '3':
         return view('survey.prograd.department-result', compact('survey', 'questions', 'answers', 'label', 'responsesCount', 'textAnswers', 'department'));
         break;

         default:
         return redirect('home');
         break;
      }

   }

   // Renders the view to show the overall result of a survey
   public function overallResult($surveyId){

      $survey = Questionario::find(decrypt($surveyId));
      if(session()->get('role') != 1){
         $questions = $survey->perguntas()->orderBy('numero')->get();
      }else{
         $questions = $survey->perguntas()->where('tipo_id', '!=', 1)->orderBy('numero')->get();
      }
      $responses = Resposta::where('questionario_id', $survey->id)->get();

      foreach ($questions as $question) {
         if($question->tipo_id == 1){
            $textAnswers[$question->id] = array();
         }else{
            foreach ($question->opcoes as $choice) {
               $answers[$question->id][$choice->id] = 0;
            }
         }
      }

      foreach ($responses as $response){
         $resp = RespostaUnicaEscolha::where('resposta_id', $response->id)->get();
         $respM = RespostaMultiplaEscolha::where('resposta_id', $response->id)->get();
         foreach ($questions as $question){
            switch ($question->tipo_id) {

               case 1:
               $textAnswers[$question->id][] = RespostaAberta::where('resposta_id', $response->id)
               ->where('pergunta_id', $question->id)->first()->resposta;
               break;

               case 2:
               $choice = $resp->where('pergunta_id', $question->id)->first();
               $answers[$question->id][$choice->opcao_id]++;
               break;

               case 3:
               $choice = $respM->where('pergunta_id', $question->id)->first();
               $choices = DB::table('opcao_resposta_multipla_escolha')->where('resposta_me_id', $choice->id)->get();
               foreach ($choices as $choice){
                  $answers[$question->id][$choice->opcao_id]++;
               }
               break;
            }

         }
      }
      foreach ($answers as $key => $value) {
         $answers[$key] = array_values($answers[$key]);
      }

      $responsesCount = $responses->count();

      $label = "(TOTAL: " . $responsesCount . ")";

      switch (session()->get('role')) {
         case '0':
         return view('survey.admin.overall-result', compact('survey', 'questions', 'answers', 'textAnswers', 'label', 'responsesCount'));
         break;

         case '1':
         return view('survey.student.overall-result', compact('survey', 'questions', 'answers', 'label', 'responsesCount'));
         break;

         case '2':
         return view('survey.professor.overall-result', compact('survey', 'questions', 'answers', 'textAnswers', 'label', 'responsesCount'));
         break;

         case '3':
         return view('survey.prograd.overall-result', compact('survey', 'questions', 'answers', 'textAnswers', 'label', 'responsesCount'));
         break;

         default:
         return redirect('home');
         break;
      }
   }

   // Renders the view to show the semester result of a survey
   public function semesterResult($year, $semester, $surveyId){

      $survey = Questionario::find(decrypt($surveyId));

      if(session()->get('role') != 1){
         $questions = $$survey->perguntas()->orderBy('numero')->get();
      }else{
         $questions = $survey->perguntas()->where('tipo_id', '!=', 1)->orderBy('numero')->get();
      }

      $sections = $survey->turmas->where('ano', $year)->where('semestre', $semester);

      foreach ($questions as $question) {
         if($question->tipo_id == 1){
            $textAnswers[$question->id] = array();
         }else{
            foreach ($question->opcoes as $choice) {
               $answers[$question->id][$choice->id] = 0;
            }
         }
      }

      $responsesCount = 0;

      foreach ($sections as $section) {
         $responses = Resposta::where('questionario_id', $survey->id)
         ->where('turma_id', $section->id)->get();
         $responsesCount += $responses->count();
         foreach ($responses as $response){
            $resp = RespostaUnicaEscolha::where('resposta_id', $response->id)->get();
            $respM = RespostaMultiplaEscolha::where('resposta_id', $response->id)->get();
            foreach ($questions as $question){
               switch ($question->tipo_id) {

                  case 1:
                  $textAnswers[$question->id][] = RespostaAberta::where('resposta_id', $response->id)
                  ->where('pergunta_id', $question->id)->first()->resposta;
                  break;

                  case 2:
                  $choice = $resp->where('pergunta_id', $question->id)->first();
                  $answers[$question->id][$choice->opcao_id]++;
                  break;

                  case 3:
                  $choice = $respM->where('pergunta_id', $question->id)->first();
                  $choices = DB::table('opcao_resposta_multipla_escolha')->where('resposta_me_id', $choice->id)->get();
                  foreach ($choices as $choice){
                     $answers[$question->id][$choice->opcao_id]++;
                  }
                  break;
               }

            }
         }

      }

      foreach ($answers as $key => $value) {
         $answers[$key] = array_values($answers[$key]);
      }

      $label = "(TOTAL: " . $responsesCount . ")";

      switch (session()->get('role')) {
         case '0':
         return view('survey.admin.semester-result', compact('survey', 'questions', 'answers', 'textAnswers', 'label', 'responsesCount', 'year', 'semester'));
         break;

         case '1':
         return view('survey.student.semester-result', compact('survey', 'questions', 'answers', 'label', 'responsesCount', 'year', 'semester'));
         break;

         case '2':
         return view('survey.professor.semester-result', compact('survey', 'questions', 'answers', 'textAnswers', 'label', 'responsesCount', 'year', 'semester', 'year', 'semester'));
         break;

         case '3':
         return view('survey.prograd.semester-result', compact('survey', 'questions', 'answers', 'textAnswers', 'label', 'responsesCount', 'year', 'semester'));
         break;

         default:
         return redirect('home');
         break;
      }
   }

   // Ajax functions

   public function ajaxShowQuestion($id){
      $question = Pergunta::find($id);
      return view('survey.ajax.question', compact('question'))->render();
   }

   public function ajaxSelectQuestion($count){

      if(session()->get('role') == 2){
         $questions = Professor::find(session()->get('id'))->perguntas;
      }else{
         $questions = Pergunta::all();
      }
      return view('survey.ajax.select-questions', compact('questions', 'count'))->render();
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
