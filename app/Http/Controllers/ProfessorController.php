<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Professor;
use App\Models\Departamento;
use App\Models\Aluno;

class ProfessorController extends Controller
{

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

      switch (session()->get('role')) {

         case '0':
         $professors = Professor::all();
         return view ('professor.admin.index', compact('professors'));
         break;

         case '1':
         $professors = Professor::all();
         $mySections = Aluno::find(session()->get('id'))->turmas;
         // $myProfessors = array();
         // foreach ($mySections as $key => $section) {
         //    $myProfessors = $section->professores;
         // }
         //
         // dd($myProfessors);
         return view ('professor.student.index', compact('professors', 'mySections'));
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
      return view('professor.show', compact('professor'));
   }

   /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
   public function store(Request $request)
   {
      //
   }

   /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function edit()
   {
      return redirect()->away('https://zeppelin10.ufop.br/minhaUfop/desktop/login.xhtml');
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
      //
   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      //
   }

   public function import(){
      return view('professor.admin.import');
   }

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

         // $file = fopen($request->file('professors-csv'),"r");
         // $professors = array();
         // while(!feof($file)){
         //    $professors[] = (fgetcsv($file));
         // }
         // fclose($file);
         // dd($professors);

      }else{
         return redirect()->back()->with('errorMessage', 'Erro ao importar CSV');
      }

      // $path = "D:\Oto\WebProjects\Professors-and-Classes-Evaluation\storage\csvs\MATRICULA AJUSTE SJM.csv";
      // $students = (array_map('str_getcsv', file($path)));
      // array_shift($students);
      // foreach ($students as $student) {
      //    $newStudent = Aluno::firstOrCreate([
      //       'matricula' => $student[0],
      //       'curso_id' => Curso::where('curso', $student[5])->first()->id,
      //       'usuario' => $student[0]
      //    ]);
      // }
   }

}
