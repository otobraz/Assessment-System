<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TipoAdmin;

class AdminTypeController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $adminTypes = TipoAdmin::all();
      return view ('admin-type.index', compact('adminTypes'));
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      return view('admin-type.create');
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $adminType = new TipoAdmin();
      $adminType->tipo = $request->input('admin-type');
      $adminType->save();

      return redirect()->route('adminType.index')->with('successMessage', 'Tipo de administrador criada com sucesso');
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      $adminType = TipoAdmin::find(decrypt($id));
      return view('admin-type.edit', compact('adminType'));
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
      $adminType = TipoAdmin::find(decrypt($id));
      $adminType->tipo = $request->input('admin-type');
      $adminType->save();
      return redirect()->route('adminType.index')->with('successMessage', 'Informações alteradas com sucesso.');
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      TipoAdmin::find(decrypt($id))->delete();
      return redirect()->route('adminType.index')->with('successMessage', 'Registro excluído com sucesso.');
   }
}
