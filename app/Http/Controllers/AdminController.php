<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;
use Hash;

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
      return view('admin.create');
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      $admin = new Admin();
      $admin->nome = $request->first_name;
      $admin->sobrenome = $request->last_name;
      $admin->email = $request->email;
      $admin->usuario = $request->username;
      $admin->senha = bcrypt($request->password);
      if($admin->save()){
         return redirect()->route('admin.index')->with('successMessage', 'Administrador cadastrado com sucesso');
      }
      return redirect()->route('admin.create')->with('errorMessage', 'Erro ao cadastrar administrador');

   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {
      //
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
      return view('admin.edit', compact('admin'));
   }

   public function editPassword($id)
   {
      $admin = Admin::find(decrypt($id));
      return view('admin.edit-password', compact('admin'));
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
      $admin->nome = $request->first_name;
      $admin->sobrenome = $request->last_name;
      $admin->email = $request->email;
      $admin->usuario = $request->username;
      if($admin->save()){
         return redirect()->route('admin.edit', ['id' => $id])->with('successMessage', 'Informações alteradas com sucesso.');
      }
      return redirect()->route('admin.edit', ['id' => $id])->with('errorMessage', 'Erro ao atualizar informações');

   }

   public function updatePassword(Request $request, $id){
      $admin = Admin::find(decrypt($id));
      if(isset($admin) && Hash::check($request->password, $admin->senha)){
         if($request->newPassword === $request->passwordConfirmation){
            if (Hash::needsRehash($request->password)) {
               $admin->senha = bcrypt($request->newPassword);
            }
            if($admin->save()){
               return redirect()->route('admin.edit', ['id' => $id])->with('successMessage', 'Senha alterada com sucesso.');
            }
            return redirect()->route('admin.edit', ['id' => $id])->with('errorMessage', 'Erro ao alterar senha.');
         }
         return redirect()->route('admin.editPassword', ['id' => $id])->with('passwordConfirmationError', 'A nova senha e a confirmação dela devem ser idênticas');
      }
      return redirect()->route('admin.editPassword', ['id' => $id])->with('passwordError', 'Senha Incorreta');
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
