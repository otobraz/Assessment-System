<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Professor;
use App\Models\Departamento;
use App\Models\Aluno;

class ProfessorController extends Controller
{

   // Gets and returns the LdapUser based on the username (CPF)
   public function getLdapUser($ldapData = null, $username = null){
      $ds = ldap_connect($ldapData['server']); // your ldap server
      try{
         $bind = ldap_bind($ds, $ldapData['cn'] . "," . $ldapData['domain'], base64_decode($ldapData['password']));
         $filter = "(" . $ldapData['id_field'] . "=" . $username . ")"; // this command requires some filter
         $justThese = array(
            $ldapData['given_name_field'],
            $ldapData['last_name_field'],
         ); // the attributes to pull, which is much more efficient than pulling all attributes if you don't do this
         $sr = ldap_search($ds, $ldapData['domain'], $filter, $justThese);
         $entry = ldap_get_entries($ds, $sr);
         if ($entry['count'] > 0) {
            return $entry;
         }
         return null;
      }catch(\Exception $e){
         abort(503);
      }
   }

   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {

      $professors = Professor::all();
      switch (session()->get('role')) {

         case '0':
         return view ('professor.admin.index', compact('professors'));
         break;

         case '1':
         $mySections = Aluno::find(session()->get('id'))->turmas;
         return view ('professor.student.index', compact('professors', 'mySections'));
         break;

         case '3':
         return view ('professor.prograd.index', compact('professors'));
         break;

         default:
         return redirect('/');
         break;
      }
   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {

      $professor = Professor::find(decrypt($id));
      $surveys = $professor->questionarios;
      $sectionsGroup = $professor->turmas->groupBy('ano')->transform(function($item, $k) {
         return $item->groupBy('semestre');
      });
      $guidances = $professor->orientacoes;
      switch (session()->get('role')) {
         case '0':
            return view ('professor.admin.show', compact('professor', 'surveys', 'sectionsGroup', 'guidances'));
            break;

         case '1':
            return view ('professor.student.show', compact('professor', 'surveys', 'sectionsGroup', 'guidances'));
            break;

         case '3':
            return view ('professor.prograd.show', compact('professor', 'surveys', 'sectionsGroup', 'guidances'));
            break;

         default:
            return redirect('/');
            break;
      }
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function edit()
   {

      $professor = Professor::find(session()->get('id'));
      return view('professor.edit', compact('professor'));

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

      $professor = Professor::find(decrypt($id));
      $professor->email = $request->input('email');
      if($professor->save()){
         return redirect()->route('professor.edit', ['id' => $id])->with('successMessage', 'Informações alteradas com sucesso.');
      }
      return redirect()->route('professor.edit', ['id' => $id])->with('errorMessage', 'Erro ao atualizar informações');
   }

   // Show the form for importing the professors from the .csv file
   public function import(){
      return view('professor.admin.import');
   }

   // Import the professors from the .csv file
   public function storeFromCsv(Request $request){

      if($request->file('professors-csv')->isValid()){

         $departments = Departamento::all();
         $departmentInitials = array_column($departments->toArray(), 'cod_departamento');

         $professorsCsv = (array_map('str_getcsv', file($request->file('professors-csv'))));
         $professorsData = array_filter($professorsCsv, function($v, $k) use ($departmentInitials){
            return in_array(preg_replace('/\s\s+/', '', $v[3]), $departmentInitials);
         }, ARRAY_FILTER_USE_BOTH);

         $header = [
            "SIAPE/CPF",
            "SEGMENTO",
            "NOME",
            "DEPARTAMENTO",
            "SITUACAO",
            "EXONERACAO",
            "CPF",
            "EMAIL",
            "TITULACAO"
         ];

         if($header == array_shift($professorsCsv)){
            $professors = Professor::all();
            $ldapData = config('my_config.ldapData');
            foreach ($professorsData as $professor){
               $username = preg_replace('/[^0-9]+/', '', $professor[6]);
               $department = $departments->where('cod_departamento', preg_replace('/\s\s+/','', $professor[3]))->first();
               if($professorModel = $professors->where('usuario', $username)->first()){
                  $professorModel->departamento_id = $department->id;
                  $professorModel->email = $professor[7];
                  $professorModel->save();
               }else{
                  if($ldapUser = $this->getLdapUser($ldapData, $username)){
                     $newProfessor = new Professor([
                        'usuario' => $username,
                        'nome' => $ldapUser[0][$ldapData['given_name_field']][0],
                        'sobrenome' => $ldapUser[0][$ldapData['last_name_field']][0],
                        'email' => $professor[7],
                        'departamento_id' => $department->id
                     ]);
                     $newProfessor->save();
                  }
               }
            }
            return redirect()->route('professor.index')->with('successMessage', 'Importação realizada com sucesso');
         }else{
            return redirect()->back()->with('errorMessage', 'Arquivo inválido');
         }

      }else{
         return redirect()->back()->with('errorMessage', 'Erro ao importar CSV');
      }

   }

}
