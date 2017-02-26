<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\TipoPergunta;

class QuestionTypeController extends Controller
{

   /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
     $questionTypes = TipoPergunta::all();
     return view ('question-type.index', compact('questionTypes'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
     return view('question-type.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
     $questionType = new TipoPergunta();
     $questionType->type = $request->type;
     $questionType->save();
     return redirect()->route('questionType.index');
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
     $questionType = TipoPergunta::find(decrypt($id));
     return view('question-type.edit', compact('questionType'));
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
     $questionType = TipoPergunta::find(decrypt($id));
     $questionType->type = $request->type;
     $questionType->save();
     return redirect()->route('questionType.index')->with('successMessage', 'Informações alteradas com sucesso.');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
     TipoPergunta::find(decrypt($id))->delete();
     return redirect()->route('questionType.index')->with('successMessage', 'Registro excluído com sucesso.');
  }

}
