<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Aluno;
use App\Models\Curso;

class StudentController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {
      $students = Aluno::all();
      return view ('student.index', compact('students'));
   }

   /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function show($id)
   {
      $student = Aluno::find(decrypt($id));
      return view('student.show', compact('student'));
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
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

   public function destroy($id)
   {
      //
   }

   // public function in_array_r($needle, $haystack, $strict = false) {
   //    foreach ($haystack as $item) {
   //       if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
   //          return true;
   //       }
   //    }
   //    return false;
   // }

   public function import(){
      return view('student.import');
   }

   public function storeFromCsv(Request $request){

      if($request->file('students-csv')->isValid()){

         // dd($request->file('students-csv'));
         $studentsCsv = (array_map('str_getcsv', file($request->file('students-csv'))));
         $filtered = array_filter($studentsCsv, function($v, $k){
            return $v[6] == "MATRICULADO";
         }, ARRAY_FILTER_USE_BOTH);
         $cpfs = array_column($filtered, 4, 0);
         $cursos = array_column($filtered, 7, 0);
         krsort($cpfs);
         // dd($cursos);
         // dd($studentsCsv);
         // $cpfs = array_column($studentsCsv, 4, );
         // $teste = array_combine($cpfs, $studentsCsv);
         // // dd($teste);
         $cpfs = array_unique($cpfs);
         $array1 = array_intersect_key($cpfs, $cursos);
         $array2 = array_intersect_key($cursos, $cpfs);
         $studentsData = array_merge_recursive($array1, $array2);
         // dd(array_count_values("086.176.906-66"));
         // // dd($studentsCsv);

         $header = [
            "MATRICULA",
            "NOME",
            "SEXO",
            "DATA NASCIMENTO",
            "CPF",
            "RG",
            "DESCRICAO SITUACAO ALUNO",
            "COD CURSO"
         ];

         // $newStudent = Aluno::firstOrNew([
         //    'usuario' => '09647636644',
         //    'matricula' => '',
         //    'nome' => 'OTO',
         //    'sobrenome' => 'BRAZ ASSUNCAO',
         //    'email' => 'oto.braz@outlook.com',
         //    'curso_id' => '1',
         // ]);
         // dd($newStudent->id);

         if($header == array_shift($studentsCsv)){
            $students = Aluno::all();
            $sections = Curso::all();
            foreach ($studentsData as $key => $student){
               $username = preg_replace('/[^0-9]+/', '', $student[0]);
               $major = $sections->where('cod_curso', $student[1])->first();
               if($studentModel = $students->where('usuario', $username)->first()){
                  $studentModel->matricula = $key;
                  $studentModel->curso_id = $major->id;
                  $studentModel->save();
               }else{
                  $newStudent = new Aluno([
                     'usuario' => $username,
                     'matricula' => $key,
                     'nome' => NULL,
                     'sobrenome' => NULL,
                     'email' => NULL,
                     'curso_id' => $major->id
                  ]);
                  $newStudent->save();
               }
            }
            return redirect()->route('student.index')->with('successMessage', 'Importação realizada com sucesso');
         }else{
            return redirect()->back()->with('errorMessage', 'Arquivo inválido');
         }
      }else{
         return redirect()->back()->with('errorMessage', 'Erro ao importar CSV');
      }
   }
}
