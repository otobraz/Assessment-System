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
         $sections = Turma::orderBy('ano', 'desc')->orderBy('semestre', 'desc')->get();
         return view ('survey.admin.index', compact('sections'));
         break;

         case '1':
         $student = Aluno::find(session()->get('id'));
         $sections = $student->turmas;
         return view ('survey.student.index', compact('sections'))->with('successMessage', session()->get('successMessage'));
         break;

         case '2':
         $professor = Professor::find(session()->get('id'));
         $surveys = $professor->questionarios;
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
      $inputs = $request->all();
      array_shift($inputs);
      $survey = new Questionario([
         'titulo' => array_shift($inputs),
         'descricao' => array_shift($inputs),
         'professor_id' => session()->get('id')
      ]);
      $survey->save();

      foreach (array_shift($inputs) as $input){
         // $section = Turma::find($input);
         $survey->turmas()->attach($input);
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
                  $choice = new Opcao([
                     'opcao' => $choice,
                     'pergunta_id' => $question->id
                  ]);
                  $choice->save();
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

      $survey = Questionario::find(decrypt($id));
      $questions = $survey->perguntas;

      return view('survey.professor.show', compact('survey', 'questions'));


   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      return redirect()->route('survey.index');
   }

   /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function update(Request $request, $id)
   {
      return redirect()->route('survey.index');
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      //
   }

   public function showSections($id){

      $survey = Questionario::find(decrypt($id));
      $sections = $survey->turmas;
      // $data = array();
      // foreach ($sections as $key => $value) {
      //    $data[] = $value;
      // }
      // dd($data);
      return view('survey.professor.show-sections', compact('sections', 'survey'));

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
      // $answers = array();
      // $labels = array();
      foreach ($sectionsInput as $section) {
         $answers[] = $this->getClassAnswers($survey, Turma::find($section), $questions);
         $section = Turma::find($section);
         $labels[] = "Turma " . $section->cod_turma . " - " . $section->disciplina->disciplina . " - " . $section->ano . "/" . $section->semestre;
      }
      return view('survey.professor.results-compared', compact('survey', 'questions', 'answers', 'labels'));
   }

   public function classResults($surveyId, $sectionId){

      $survey = Questionario::find(decrypt($surveyId));
      $questions = $survey->perguntas()->where('tipo_id', '!=', '1')->get();
      $section = Turma::find(decrypt($sectionId));
      $surveySection = DB::table('questionario_turma')->where('questionario_id', $survey->id)->where('turma_id', $section->id)->get();

      // $answers = array();
      foreach ($surveySection as $sS) {
         $responses = Resposta::where('questionario_turma_id', $sS->id)->get();
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
         $labels[] = "Turma " . $section->cod_turma . " - " . $section->disciplina->disciplina . " - " . $section->ano . "/" . $section->semestre . " - Data: " . date("d/m/y", strtotime($sS->created_at));
      }

      // $answers = array();
      // foreach ($surveySection as $sS) {
      //    $responses = Resposta::where('questionario_turma_id', $sS->id)->get();
      //    $questionAnswers = array();
      //    foreach ($questions as $question){
      //       switch ($question->tipo_id){
      //          case 2:
      //          $data = array();
      //          foreach($question->opcoes as $opcao){
      //             $responseData = RespostaUnicaEscolha::where('opcao_id', $opcao->id)->get();
      //             $data[] = $responseData->filter(function($rData) use ($responses){
      //                return $responses->contains('id', $rData->resposta_id);
      //             })->count();
      //          }
      //          $questionAnswers[] = $data;
      //          break;
      //
      //          case 3:
      //          $data = array();
      //          $multipleChoiceResponses = RespostaMultiplaEscolha::where('pergunta_id', $question->id)->get();
      //          $multipleChoiceResponses = $multipleChoiceResponses->filter(function($mCR) use ($responses){
      //             return $responses->contains('id', $mCR->resposta_id);
      //          });
      //          // dd($multipleChoiceResponses);
      //          foreach($question->opcoes as $opcao){
      //             $responseData = DB::table('opcao_resposta_multipla_escolha')->where('opcao_id', $opcao->id)->get();
      //             $r = array_where($responseData, function($v, $rData) use ($multipleChoiceResponses){
      //                return $multipleChoiceResponses->contains('id', $rData->resposta_me_id);
      //             });
      //             $data[] = count($r);
      //          }
      //          $questionAnswers[] = $data;
      //          break;
      //       }
      //    }
      //    // dd($questionAnswers);
      //    $answers[] = $questionAnswers;
      // }
      // $answers[] = $questionAnswers;
      // $responses = Resposta::where('questionario_turma_id', $surveySection->id)->get();
      // dd($answers);

      // dd($responses);

      return view('survey.professor.class-results', compact('survey', 'section', 'questions', 'answers', 'labels'));

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

      // foreach ($questions as $question){
      //    switch ($question->tipo_id) {
      //       case 2:
      //       $data = array();
      //       foreach($question->opcoes as $opcao){
      //          $responseData = RespostaUnicaEscolha::where('opcao_id', $opcao->id)->get();
      //          $data[] = $responseData->filter(function($rData) use ($responses){
      //             return $responses->contains('id', $rData->resposta_id);
      //          })->count();
      //       }
      //       $questionAnswers[] = $data;
      //       break;
      //
      //       case 3:
      //       $data = array();
      //       $multipleChoiceResponses = RespostaMultiplaEscolha::where('pergunta_id', $question->id)->get();
      //       $multipleChoiceResponses = $multipleChoiceResponses->filter(function($mCR) use ($responses){
      //          return $responses->contains('id', $mCR->resposta_id);
      //       });
      //       // dd($multipleChoiceResponses);
      //       foreach($question->opcoes as $opcao){
      //          $responseData = DB::table('opcao_resposta_multipla_escolha')->where('opcao_id', $opcao->id)->get();
      //          $r = array_where($responseData, function($v, $rData) use ($multipleChoiceResponses){
      //             return $multipleChoiceResponses->contains('id', $rData->resposta_me_id);
      //          });
      //          $data[] = count($r);
      //       }
      //       $questionAnswers[] = $data;
      //       break;
      //    }
      // }
      return view('survey.professor.results', compact('survey', 'questions', 'answers'));
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
