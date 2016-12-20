<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Professor;
use App\Models\Aluno;
use App\Models\Orientacao;
use App\Models\TipoOrientacao;

class GuidanceController extends Controller
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
         $guidances = Orientacao::orderBy('id', 'desc')->get();
         return view ('guidance.admin.index', compact('guidances'));
         break;

         case '1':
         $student = Aluno::find(session()->get('id'));
         $guidances = $student->orientacoes->sortByDesc('id');
         return view ('guidance.student.index', compact('guidances'));
         break;

         case '2':
         $professor = Professor::find(session()->get('id'));
         $guidances = $professor->orientacoes->sortByDesc('id');
         return view ('guidance.professor.index', compact('guidances'));
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
   public function create($id)
   {
      $student = Aluno::find(decrypt($id));
      $guidanceTypes = TipoOrientacao::all();
      return view('guidance.professor.create', compact('student', 'guidanceTypes'));
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {

      if(!empty($request->input('guidance-type'))){
         $guidance = new Orientacao([
            'descricao' => $request->description,
            'aluno_id' => $request->input('aluno-id'),
            'professor_id' => session()->get('id'),
            'tipo_id' => $request->input('guidance-type')
         ]);
         if($guidance->save()){
            return redirect()->route('guidance.index')->with('successMessage', 'Orientação criada com sucesso');
         }
         return redirect()->route('course.create')->with('errorMessage', 'Erro ao criar orientação');
      }
      return redirect()->back()->withInput()->with('errorMessage', 'Selecione o tipo de orientação');
   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {

      $guidance = Orientacao::find(decrypt($id));

      switch (session()->get('role')) {
         case '0':
         return view ('guidance.admin.show', compact('guidance'));
         break;

         case '1':
         return view ('guidance.student.show', compact('guidance'));
         break;

         case '2':
         return view ('guidance..professor.show', compact('guidance'));
         break;

         default:
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

      $guidance = Orientacao::find(decrypt($id));
      if($guidance->isOwner(session()->get('id'))){
         $guidanceTypes = TipoOrientacao::all();
         return view('guidance.professor.edit', compact('guidance', 'guidanceTypes'));
      }
      return redirect()->route('home');
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

      $guidance = Orientacao::find(decrypt($id));
      $guidance->tipo_id = $request->input('guidance-type');
      $guidance->descricao = $request->input('description');
      $guidance->save();
      return redirect()->route('guidance.show', $id)->with('successMessage', 'Informações alteradas com sucesso');

   }

   // /**
   // * Remove the specified resource from storage.
   // *
   // * @param  int  $id
   // * @return \Illuminate\Http\Response
   // */
   // public function destroy($id)
   // {
   //
   //    $guidance = Orientacao::find(decrypt($id));
   //
   // }

   public function finish($id){

      $guidance = Orientacao::find(decrypt($id));
      if($guidance->status){
         $guidance->status = 0;
         $guidance->save();
         return redirect()->route('guidance.index')->with('successMessage', 'Orientação encerrada.');
      }
      return redirect()->route('guidance.index')->with('errorMessage', 'Orientação já foi encerrada.');
   }

   public function restart($id){

      $guidance = Orientacao::find(decrypt($id));
      if(!$guidance->status){
         $guidance->status = 1;
         $guidance->save();
         return redirect()->route('guidance.index')->with('successMessage', 'Orientação recomeçada.');
      }
      return redirect()->route('guidance.index')->with('errorMessage', 'Orientação já está em andamento.');

   }

   public function provideSurvey($id){

      $guidance = Orientacao::find(decrypt($id));
      if(!$guidance->questionario_aberto){
         $guidance->questionario_aberto = 1;
         $guidance->save();
         return redirect()->route('guidance.index')->with('successMessage', 'Questionário disponibilizado.');
      }
      return redirect()->route('guidance.index')->with('errorMessage', 'O questionário já foi disponibilizado.');

   }

   public function cancelSurvey($id){

      $guidance = Orientacao::find(decrypt($id));
      if($guidance->questionario_aberto){
         $guidance->questionario_aberto = 0;
         $guidance->save();
         return redirect()->route('guidance.index')->with('successMessage', 'Disponibilização cancelada.');
      }
      return redirect()->route('guidance.index')->with('errorMessage', 'O questionário ainda não foi disponibilizado.');

   }

   public function getResults(){

      $guidance = Orientacao::find(decrypt($id));

   }

   public function showResponse($id){

   }

}
