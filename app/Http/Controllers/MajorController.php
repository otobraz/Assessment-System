<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Curso;

class MajorController extends Controller
{

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $majors = Curso::all();
      return view ('major.index', compact('majors'));
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      return view('major.create');
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $major = new Curso($request->all());
      if($major->save()){
         return redirect()->route('major.index')->with('successMessage', 'Curso criado com sucesso');
      }
      return redirect()->route('major.create')->with('errorMessage', 'Erro ao criar curso');
   }


   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      $major = Curso::find(decrypt($id));
      return view('major.edit', compact('major'));
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
      $major = Curso::find(decrypt($id));
      $major->curso = $request->major;
      $major->cod_curso = $request->initials;
      if($major->save()){
         return redirect()->route('major.index')->with('successMessage', 'Informações atualizadas com sucesso');
      }
      return redirect()->route('major.create')->with('errorMessage', 'Erro ao atualizar informações');
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      Curso::find(decrypt($id))->delete();
      return redirect()->route('major.index')->with('successMessage', 'Registro excluído com sucesso.');
   }
}
