<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\TipoTurma;

class SectionTypeController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $sectionTypes = TipoTurma::all();
      return view ('section-type.index', compact('sectionTypes'));
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      return view('section-type.create');
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $sectionType = new TipoTurma();
      $sectionType->tipo = $request->type;
      $sectionType->save();
      return redirect()->route('sectionType.index');
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
      $sectionType = TipoTurma::find(decrypt($id));
      return view('section-type.edit', compact('sectionType'));
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
      $sectionType = TipoTurma::find(decrypt($id));
      $sectionType->tipo = $request->type;
      $sectionType->save();
      return redirect()->route('sectionType.index')->with('updateSuccess', 'Informações alteradas com sucesso.');
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      SectionType::find(decrypt($id))->delete();
      return redirect()->route('sectionType.index');
   }

}
