<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;
use App\Models\TipoAdmin;

class AdminController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $admins = Admin::all();
      return view ('admin.index', compact('admins'));
   }

   /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {
      $adminTypes = TipoAdmin::all();
      return view('admin.create', compact('adminTypes'));
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $admin = new Admin([
         'nome' => $request->input('first-name'),
         'sobrenome' => $request->input('surname'),
         'email' => $request->input('email'),
         'usuario' => $request->input('username'),
         'tipo_id' => $request->input('admin-type'),
      ]);
      if($admin->save()){
         return redirect()->route('admin.index')->with('successMessage', 'Administrador cadastrado com sucesso');
      }
      return redirect()->route('admin.create')->with('errorMessage', 'Erro ao cadastrar administrador');

   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit($id)
   {
      $admin = Admin::find(decrypt($id));
      $adminTypes = TipoAdmin::all();
      return view('admin.edit', compact('admin', 'adminTypes'));
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
      $admin = Admin::find(decrypt($id));
      $admin->email = $request->email;
      if($admin->save()){
         return redirect()->route('admin.edit', ['id' => $id])->with('successMessage', 'Informações alteradas com sucesso.');
      }
      return redirect()->route('admin.edit', ['id' => $id])->with('errorMessage', 'Erro ao atualizar informações');

   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      Admin::find(decrypt($id))->delete();
      return redirect()->route('admin.index')->with('successMessage', 'Registro deletado com sucesso.');
   }
}
