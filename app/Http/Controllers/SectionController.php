<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Turma;
use App\Models\Professor;
use App\Models\Aluno;
use App\Models\Disciplina;
use DB;

class SectionController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function index()
   {

      switch (session()->get('role')) {
         case '0':
         $sections = Turma::orderBy('ano', 'desc')->orderBy('semestre', 'desc')->get();
         return  view ('section.admin.index', compact('sections'));
         break;

         case '1':
         $student = Aluno::find(session()->get('id'));
         $sectionsGroup = $student->turmas->groupBy('ano')->transform(function($item, $k) {
            return $item->groupBy('semestre');
         });
         return view ('section.student.index', compact('sectionsGroup'));;
         break;

         case '2':
         $professor = Professor::find(session()->get('id'));
         $sectionsGroup = $professor->turmas()->OrderByDisciplina()->get()->groupBy('ano')->transform(function($item, $k) {
            return $item->groupBy('semestre');
         });
         return view ('section.professor.index', compact('sectionsGroup'));
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

      $section = Turma::find(decrypt($id));
      $students = $section->alunos()->orderBy('nome', 'asc')->orderBy('sobrenome', 'asc')->get();

      switch (session()->get('role')) {
         case '0':
         return view('section.admin.show', compact('section', 'students'));
         break;

         case '1':
         return view('section.student.show', compact('section', 'students'));
         break;

         case '2':
         return view('section.professor.show', compact('section', 'students'));;
         break;
      }

   }

   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
      Turma::find(decrypt($id))->delete();
      return redirect()->route('questionType.index')->with('successMessage', 'Registro deletado com sucesso.');
   }

   public function importRegistrations(){
      return view('section.admin.import-registrations');
   }

   public function storeRegistrationsFromCsv(Request $request){

      if($request->file('registrations-csv')->isValid()){

         $registrationsCsv = (array_map('str_getcsv', file($request->file('registrations-csv'))));

         $header = [
            "MATRICULA",
            "NOME",
            "ANO",
            "SEMESTRE",
            "COD CURSO",
            "CURSO",
            "COD DISCIPLINA",
            "DISCIPLINA",
            "COD TURMA",
            "CARATER",
            "DATA DE GRAVACAO"
         ];

         if($header == array_shift($registrationsCsv)){
            $alunos = Aluno::all()->lists('id', 'matricula');
            foreach ($registrationsCsv as $registrationCsv){

               $registration = [
                  'matricula' => $registrationCsv[0],
                  'ano' => $registrationCsv[2],
                  'semestre' => $registrationCsv[3],
                  'cod_disciplina' => $registrationCsv[6],
                  'cod_turma' => $registrationCsv[8]
               ];

               $course = Disciplina::where('cod_disciplina', $registration['cod_disciplina'])->first();

               if($alunos->has($registration['matricula']) && isset($course->id)){

                  $section = Turma::where('ano', $registration['ano'])
                  ->where('semestre', $registration['semestre'])
                  ->where('cod_turma', $registration['cod_turma'])
                  ->where('disciplina_id', $course->id)->first();

                  if(isset($section)){
                     $sectionStudent = DB::table('aluno_turma')
                     ->where('aluno_id', $alunos[$registration['matricula']])
                     ->where('turma_id', $section->id)->first();
                     if(!isset($sectionStudent)){
                        $section->alunos()->attach($alunos->get($registration['matricula']));
                     }

                  }
               }
            }
            return redirect()->route('section.index')->with('successMessage', 'Importação realizada com sucesso');
         }else{
            return redirect()->back()->with('errorMessage', 'Arquivo inválido');
         }
      }else{
         return redirect()->back()->with('errorMessage', 'Erro ao importar CSV');
      }
   }

   public function import(){
      return view('section.admin.import');
   }

   public function storeFromCsv(Request $request){


      if($request->file('sections-csv')->isValid()){

         $sectionsCsv = (array_map('str_getcsv', file($request->file('sections-csv'))));

         $header = [
            "ANO",
            "SEMESTRE",
            "DISCIPLINA",
            "DESCRICAO",
            "DEPARTAMENTO",
            "TURMA",
            "CARGA HORARIA",
            "AULA TEORICA",
            "AULA PRATICA",
            "VAGAS",
            "RESTO",
            "PROFESSORES",
            "SEGUNDA",
            "TERCA",
            "QUARTA",
            "QUINTA",
            "SEXTA",
            "SABADO",
            "APROVACOES",
            "MATRICULAS",
            "REPROVACOES FALTA",
            "REPROVACOES NOTA",
            "REPROVACOES NOTA FALTA",
            "TRANCAMENTOS",
            "COD PREDIO",
            "PREDIO",
            "RESERVA CURSO",
            "RESERVA HABILITACAO",
            "IDIOMA"
         ];

         if($header == array_shift($sectionsCsv)){
            $professors = Professor::all()->lists('id', 'nome_completo');
            $sectionsNotAllowed = config('my_config.sectionsNotAllowed');
            foreach ($sectionsCsv as $sectionCsv){

               if(!in_array($sectionCsv[2], $sectionsNotAllowed)){
                  $section = [
                     'cod_turma' => $sectionCsv[5],
                     'disciplina' => $sectionCsv[3],
                     'cod_disciplina' => $sectionCsv[2],
                     'professor' => preg_split("/\//", $sectionCsv[11]),
                     'ano' => $sectionCsv[0],
                     'semestre' => $sectionCsv[1]
                  ];

                  $courseId = Disciplina::where('cod_disciplina', $section['cod_disciplina'])->first()->id;

                  $newSection = Turma::where('ano', $section['ano'])
                  ->where('semestre', $section['semestre'])
                  ->where('cod_turma', $section['cod_turma'])
                  ->where('disciplina_id', $courseId)->first();

                  if(!isset($newSection)){
                     $newSection = new Turma([
                        'ano' => $section['ano'],
                        'semestre' => $section['semestre'],
                        'disciplina_id' => $courseId,
                        'cod_turma' => $section['cod_turma']
                     ]);
                     $newSection->save();
                     foreach ($section['professor'] as $key => $professor){
                        $professor = ltrim($professor);
                        $section['professor'][$key] = strtok($professor, '(');
                     }
                     foreach ($section['professor'] as $professor){
                        $professorId = $professors->get($professor);
                        $newSection->professores()->attach($professorId);
                     }
                  }
               }
            }
            return redirect()->route('section.index')->with('successMessage', 'Importação realizada com sucesso');
         }else{
            return redirect()->back()->with('errorMessage', 'Arquivo inválido');
         }
      }else{
         return redirect()->back()->with('errorMessage', 'Erro ao importar CSV');
      }
   }

}
