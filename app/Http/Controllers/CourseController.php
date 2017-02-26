<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Disciplina;
use App\Models\Departamento;

class CourseController extends Controller
{

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $courses = Disciplina::all();
      return view ('course.index', compact('courses'));
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      $departments = Departamento::all();
      return view('course.create', compact('departments'));
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      if(!empty($request->department)){
         $course = new Disciplina([
            'cod_disciplina' => $request->code,
            'disciplina' => $request->course,
            'departamento_id' => $request->department
         ]);
         if($course->save()){
            return redirect()->route('course.index')->with('successMessage', 'Disciplina criada com sucesso');
         }
         return redirect()->route('course.create')->with('errorMessage', 'Erro ao criar disciplina');
      }
      return redirect()->back()->withInput()->with('errorMessage', 'Selecione o departamento');

   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      $departments = Departamento::all();
      $course = Disciplina::find(decrypt($id));
      return view('course.edit', compact('course', 'departments'));
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
      $course = Disciplina::find(decrypt($id));
      $course->disciplina = $request->course;
      $course->cod_disciplina = $request->code;
      $course->departamento_id = $request->department;
      if($course->save()){
         return redirect()->route('course.index')->with('successMessage', 'Informações atualizadas com sucesso');
      }
      return redirect()->route('course.create')->with('errorMessage', 'Erro ao atualizar informações');
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {

      Disciplina::find(decrypt($id))->delete();
      return redirect()->route('course.index')->with('successMessage', 'Disciplina excluído com sucesso.');

   }
}
