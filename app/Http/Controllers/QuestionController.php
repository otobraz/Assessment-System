<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Pergunta;
use App\Models\TipoPergunta;
use App\Models\Opcao;
use App\Models\Professor;

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
         $textQuestions = $questions->where('tipo_id', 1);
         $singleChoiceQuestions = $questions->where('tipo_id', 2);
         $multipleChoiceQuestions = $questions->where('tipo_id', 3);
         return view('question.admin.index', compact('textQuestions', 'singleChoiceQuestions', 'multipleChoiceQuestions'));
         break;

         case 2:
         $professor = Professor::find(session()->get('id'));
         $questions = $professor->perguntas;
         $textQuestions = $questions->where('tipo_id', 1);
         $singleChoiceQuestions = $questions->where('tipo_id', 2);
         $multipleChoiceQuestions = $questions->where('tipo_id', 3);
         return view('question.professor.index', compact('textQuestions', 'singleChoiceQuestions', 'multipleChoiceQuestions'));

         case 3:
         $questions = Pergunta::where('professor_id', NULL)->get();
         $textQuestions = $questions->where('tipo_id', 1);
         $singleChoiceQuestions = $questions->where('tipo_id', 2);
         $multipleChoiceQuestions = $questions->where('tipo_id', 3);
         return view('question.prograd.index', compact('textQuestions', 'singleChoiceQuestions', 'multipleChoiceQuestions'));
         break;

         default:
         return redirect('home');
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
      switch (session()->get('role')) {
         case 0:
         return view('question.admin.create', compact('questionTypes'));
         break;

         case 2:
         return view('question.professor.create', compact('questionTypes'));

         case 3:
         return view('question.prograd.create', compact('questionTypes'));
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

      switch (session()->get('role')) {
         case 0:
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
         break;

         case 2:
         $question = new Pergunta([
            'tipo_id' => $request->input('question-type'),
            'pergunta' => $request->input('question'),
            'professor_id' => session()->get('id')
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
         break;

         case 3:
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
         break;

         default:
         return redirect('home');
         break;
      }

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
      switch (session()->get('role')) {
         case 0:

         return view('question.admin.edit', compact('question', 'questionTypes', 'choices'));
         break;

         case 2:
         if($question->professor_id == session()->get('id')){
            return view('question.professor.edit', compact('question', 'questionTypes', 'choices'));
         }
         abort(401);
         break;

         case 3:
         return view('question.prograd.edit', compact('question', 'questionTypes', 'choices'));
         break;

         default:
         return redirect('home');
         break;
      }

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
      if(session()->get('role') == 0 || session()->get('role') == 3){
         if($question->professor_id == NULL && $question->questionarios->isEmpty()){
            foreach ($question->opcoes as $choice) {
               $choice->delete();
            }
            $question->delete();
            return redirect()->route('question.index')->with('successMessage', 'Pergunta excluída com sucesso.');
         }
         return redirect()->route('question.index')->with('errorMessage', 'Não foi possível excluir a pergunta. Verifique se ela já não pertence a um questionário.');

      }else if(session()->get('role') == 2){
         if($question->professor_id == session()->get('id') && $question->questionarios->isEmpty()){
            foreach ($question->opcoes as $choice) {
               $choice->delete();
            }
            $question->delete();
            return redirect()->route('question.index')->with('successMessage', 'Pergunta excluída com sucesso.');
         }
         return redirect()->route('question.index')->with('errorMessage', 'Não foi possível excluir a pergunta. Verifique se ela já não pertence a um questionário.');
      }
      return redirect('home');
   }

   /**
   * Renders the proper input DOM based on the option selected by the user
   */
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
