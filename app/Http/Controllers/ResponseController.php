<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Resposta;
use App\Models\RespostaMultiplaEscolha;
use App\Models\RespostaAberta;
use App\Models\Questionario;
use App\Models\RespostaUnicaEscolha;
use App\Models\Aluno;
use App\Models\Turma;

use DB;

class ResponseController extends Controller
{

   /**
   * Show the form for answering the survey
   * @return \Illuminate\Http\Response
   */
   public function create($surveySectionId)
   {

      $surveySection = DB::table('questionario_turma')->where('id', decrypt($surveySectionId))->first();

      $response = Resposta::where('questionario_turma_id', $surveySection->id)
      ->where('aluno_id', session()->get('id'))->first();
      if(!isset($response)){
         if($surveySection->aberto){
            $student = Aluno::where('usuario', session()->get('username'))->first();
            if(isset($student)){
               $studentSections = $student->turmas;
               $section = $studentSections->where('id', $surveySection->turma_id)->first();

               // Verifies whether or not the user belongs to one of the classes which the survey was assigned to
               if(isset($section)){
                  $survey = Questionario::find($surveySection->questionario_id);
                  $questions = $survey->perguntas;
                  return view('response.student.create', compact('survey', 'questions', 'section', 'surveySectionId'));
               }else{
                  return redirect()->route('survey.index');
               }
            }
         }else{
            return back()->with('errorMessage', 'Questionário fechado. Não é possível respondê-lo.');
         }
      }else{
         return back()->with('errorMessage', 'Você já respondeu este questionário.');
      }
   }

   /**
   * Store the Survey Response
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {

      $surveySection = DB::table('questionario_turma')->where('id', decrypt($request->input('survey-section-id')))->first();
      $response = new Resposta([
         'questionario_id' => $surveySection->questionario_id,
         'aluno_id' => session()->get('id'),
         'turma_id' => $surveySection->turma_id,
         'questionario_turma_id' => $surveySection->id
      ]);

      $response->save();
      $survey = Questionario::find($response->questionario_id);
      $inputs = $request->all();
      foreach($survey->perguntas as $question){
         switch ($question->tipo->id) {
            case 1: # it's a text input
            $textResponse = new RespostaAberta([
               'resposta' => $inputs["question-" . $question->id . "-text"],
               'resposta_id' =>  $response->id,
               'pergunta_id' => $question->id
            ]);
            $textResponse->save();
            break;

            case 2: # it's a radio input
            $singleChoiceResponse = new RespostaUnicaEscolha([
               'opcao_id' => $inputs["question-" . $question->id . "-radio"],
               'resposta_id' => $response->id,
               'pergunta_id' => $question->id
            ]);
            $singleChoiceResponse->save();
            break;

            case 3: # it's a checkbox input
            $multipleChoiceResponse = new RespostaMultiplaEscolha([
               'resposta_id' => $response->id,
               'pergunta_id' => $question->id
            ]);
            $multipleChoiceResponse->save();
            foreach ($inputs["question-" . $question->id . "-checkbox"] as $choice) {
               $multipleChoiceResponse->opcoes()->attach($choice);
            }
            break;
         }
      }
      return redirect()->route('survey.index')->with('successMessage', 'Questionário respondido com sucesso');
   }

   /**
   * Display the answers
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {

      $response = Resposta::find(decrypt($id));
      if(!isset($response)){
         return redirect('questionarios')->with('errorMessage', "Resposta não encontrada");
      }
      if($response->aluno_id == session()->get('id')){
         $survey = Questionario::find($response->questionario_id);
         $questions = $survey->perguntas;

         $resp = RespostaUnicaEscolha::where('resposta_id', $response->id)->get();
         $respM = RespostaMultiplaEscolha::where('resposta_id', $response->id)->get();

         foreach ($questions as $question) {
            foreach ($question->opcoes as $choice) {
               $answers[$question->id][$choice->id] = 0;
            }
         }

         foreach ($questions as $key => $question) {
            switch ($question->tipo_id) {
               case 1:
               $answers[$question->id] = RespostaAberta::where('pergunta_id', $question->id)->where('resposta_id', $response->id)->first()->resposta;
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

         switch (session()->get('role')) {
            case 0:
            return view('response.admin.show', compact('response', 'survey', 'questions', 'answers'));
            break;

            case 1:
            return view('response.student.show', compact('response', 'survey', 'questions', 'answers'));
            break;

            case 3:
            return view('response.prograd.show', compact('response', 'survey', 'questions', 'answers'));
            break;

            default:
            return redirect('home');
            break;
         }
      }
      abort(401);
   }

}
