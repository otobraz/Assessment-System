<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Departamento;

class DepartmentController extends Controller
{

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $departments = Departamento::all();
      return view ('department.index', compact('departments'));
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      return view('department.create');
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $department = new Departamento();
      $department->departamento = $request->department;
      $department->cod_departamento = $request->initials;
      if($department->save()){
         return redirect()->route('department.index')->with('successMessage', 'Departamento criado com sucesso');
      }
      return redirect()->route('department.create')->with('errorMessage', 'Erro ao criar departamento');

   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {

   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      $department = Departamento::find(decrypt($id));
      return view('department.edit', compact('department'));
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
      $department = Departamento::find(decrypt($id));
      $department->departamento = $request->department;
      $department->cod_departamento = $request->initials;
      if($department->save()){
         return redirect()->route('department.index')->with('successMessage', 'Informações atualizadas com sucesso');
      }
      return redirect()->route('department.edit')->with('errorMessage', 'Erro ao atualizar o departamento');

   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      Departamento::find(decrypt($id))->delete();
      return redirect()->route('department.index')->with('successMessage', 'Registro excluído com sucesso.');
   }
}
