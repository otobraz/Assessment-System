<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Pergunta;
use App\Models\TipoPergunta;
use App\Models\Opcao;

class QuestionController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      switch (session()->get('role')) {
         case 0:

         $questions = Pergunta::where('professor_id', NULL)->get();
         $textQuestions = $questions->whereLoose('tipo_id', 1);
         $singleChoiceQuestions = $questions->whereLoose('tipo_id', 2);
         $multipleChoiceQuestions = $questions->whereLoose('tipo_id', 3);
         return view('question.admin.index', compact('textQuestions', 'singleChoiceQuestions', 'multipleChoiceQuestions'));

         break;

         default:
         # code...
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
      $questionTypes = TipoPergunta::all();
      return view('question.admin.create', compact('questionTypes'));
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $question = new Pergunta([
         'tipo_id' => $request->input('question-type'),
         'pergunta' => $request->input('question')
      ]);
      $question->save();
      if($question->tipo_id != 1){
         foreach ($request->input('question-inputs') as $choice){
            $choice = new Opcao([
               'opcao' => $choice,
               'pergunta_id' => $question->id
            ]);
            $choice->save();
         }
      }
      return redirect()->route('question.index')->with('successMessage', 'Pergunta criada com sucesso.');
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
      $question = Pergunta::find(decrypt($id));
      // $questionTypes = TipoPergunta::where('id', '!=', 1)->get();
      // if($question->tipo_id != 1){
      //    $choices = $question->opcoes;
      // }
      return view('question.admin.edit', compact('question', 'questionTypes', 'choices'));
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
      $question = Pergunta::find(decrypt($id));
      $question->pergunta = $request->input('question');
      // $question->tipo_id = $request->input('question-type');
      foreach ($request->input('choices') as $id => $value) {
         $choice = Opcao::find($id);
         $choice->opcao = $value;
         $choice->save();
      }
      if($question->save()){
         return redirect()->route('question.index', ['id' => $id])->with('successMessage', 'Pergunta modificada com sucesso.');
      }
      return redirect()->route('question.edit', ['id' => $id])->with('errorMessage', 'Erro ao modificar pergunta');


   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      $question = Pergunta::find(decrypt($id));
      $surveys = $question->questionarios;
      if(!isset($surveys)){
         foreach ($question->opcoes as $choice) {
            $choice->delete();
         }
         $question->delete();
         return redirect()->route('question.index')->with('successMessage', 'Registro deletado com sucesso.');
      }
      return redirect()->route('question.index')->with('errorMessage', 'Não foi possível excluir a pergunta. Verifique se ela já não pertence a um questionário.');

   }

   public function ajaxCreateInput($questionType){
      switch ($questionType) {
         case '1':
         return view('question.ajax.text-input')->render();
         break;

         case '2':
         return view('question.ajax.radio-input')->render();
         break;

         case '3':
         return view('question.ajax.checkbox-input')->render();
         break;
      }
   }

}
