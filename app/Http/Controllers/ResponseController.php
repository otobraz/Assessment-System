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

class ResponseController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      //
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create($id)
   {

      $student = Aluno::where('usuario', session()->get('username'))->first();

      if(isset($student)){
         $sections = $student->turmas;
         $survey = Questionario::find(decrypt($id));

         // Verifies whether or not the user belongs to one of the classes which the survey was assigned to
         if($sections->intersect($survey->turmas)->isEmpty()){
            return redirect()->route('survey.index');
         }

         $questions = $survey->perguntas;
         return view('response.student.create', compact('survey', 'questions'));

      }else if(session()->get('role') == '0'){
         $survey = Questionario::find(decrypt($id));
         $questions = $survey->perguntas;
         return view('response.admin.create', compact('survey', 'questions'));
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
      $survey = Questionario::find(decrypt($request->survey_id));

      $response = new Resposta([
         'questionario_id' => $survey->id,
         'aluno_id' => session()->get('id')
      ]);
      $response->save();

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
         return view('survey.index')->with('succesMessage', 'Questionário respondido com sucesso');
      }

   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {
      //
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      //
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
      //
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
}
