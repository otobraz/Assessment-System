<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\TipoOrientacao;

class GuidanceTypeController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $guidanceTypes = TipoOrientacao::all();
      return view ('guidance-type.index', compact('guidanceTypes'));
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      return view('guidance-type.create');
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $guidanceType = new TipoOrientacao();
      $guidanceType->tipo = $request->input('guidance-type');
      $guidanceType->save();

      return redirect()->route('guidanceType.index')->with('successMessage', 'Tipo de orientação criada com sucesso');
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      $guidanceType = TipoOrientacao::find(decrypt($id));
      return view('guidance-type.edit', compact('guidanceType'));
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
      $guidanceType = TipoOrientacao::find(decrypt($id));
      $guidanceType->tipo = $request->input('guidance-type');
      $guidanceType->save();
      return redirect()->route('guidanceType.index')->with('successMessage', 'Informações alteradas com sucesso.');
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      TipoOrientacao::find(decrypt($id))->delete();
      return redirect()->route('guidanceType.index')->with('successMessage', 'Registro excluído com sucesso.');
   }
}
