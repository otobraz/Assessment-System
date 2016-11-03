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
use App\Models\RespostaUnicaEscolha;
use App\Models\RespostaMultiplaEscolha;

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
            $sections = Turma::all();
            return view ('survey.admin.index', compact('sections'));
            break;

         case '1':
            $student = Aluno::find(session()->get('id'));
            $sections = $student->turmas;
            return view ('survey.student.index', compact('sections'))->with('successMessage', session()->get('successMessage'));
            break;

         case '2':
            $professor = Professor::find(session()->get('id'));
            $surveys = Questionario::where('professor_id', $professor->id)->get();
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
      $questions = Pergunta::all();
      if(session()->get('role') === '0'){
         return view('survey.admin.create', compact('sections', 'questions'));
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
         $section = Turma::find($input);
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
               foreach ($input as $option){
                  $option = new Opcao([
                     'opcao' => $option,
                     'pergunta_id' => $question->id
                  ]);
                  $option->save();
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
      return view('survey.show', compact('survey', 'questions'));
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
