<?php

use Faker\Factory as Faker;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Disciplina;
use App\Models\Turma;
use App\Models\Curso;
use App\Models\Aluno;
use App\Models\Professor;
use App\Models\TipoPergunta;
use App\Models\Area;
use App\Models\Questionario;
use App\Models\Pergunta;
use App\Models\Resposta;
use App\Models\RespostaMultiplaEscolha;
// use DB;

class DatabaseSeeder extends Seeder
{
   /**
   * Run the database seeds.
   *
   * @return void
   */
   public function run()
   {
      $faker = Faker::create('pt_BR');

      // Alunos
      // foreach (range(1,50) as $index) {
      //    DB::table('alunos')->insert([
      //       'usuario' => $faker->userName,
      //       'matricula' => $faker->randomNumber(9),
      //       'nome' => $faker->firstName,
      //       'sobrenome' => $faker->lastName,
      //       'email' => $faker->email,
      //       'curso_id' => $faker->numberBetween(1,4)
      //    ]);
      // }

      // Admins
      // DB::table('admins')->insert([
      //    'usuario' => "Admin",
      //    'nome' => $faker->firstName,
      //    'sobrenome' => $faker->lastName,
      //    'email' => "$faker->email",
      //    'senha' => bcrypt('admin')
      // ]);
      // foreach (range(1,10) as $index) {
      //       'usuario' => $faker->userName,
      //       'matricula' => $faker->randomNumber(9),
      //       'nome' => $faker->firstName,
      //       'sobrenome' => $faker->lastName,
      //       'email' => $faker->email,
      //       'curso_id' => $faker->numberBetween(1,4)
      //    ]);
      // }

      // Professors
      $professors = Professor::all();
      foreach ($professors as $professor) {
         // DB::table('professores')->insert([
         //    'usuario' => $faker->userName,
         //    'siape' => $faker->randomNumber(9),
         //    'nome' => $faker->firstName,
         //    'sobrenome' => $faker->lastName,
         //    'email' => $faker->email,
         //    'departamento_id' => $faker->numberBetween(1,4)
         // ]);
         $professor->areas_interesse = $faker->word . ", " . $faker->word . ", " . $faker->word;
         $professor->save();
      }

      // Disciplinas
      // foreach(range(1,50) as $index){
      //    DB::table('disciplinas')->insert([
      //       'cod_disciplina' => $faker->numerify('CEA###'),
      //       'disciplina' => $faker->sentence($nbWords = 3, $variableNbWords = true),
      //       'departamento_id' => $faker->numberBetween(1,4)
      //    ]);
      // }

      // Turmas
      // $professors = Professor::where('id', '>', '102')->get();
      // // dd($professors[0]);
      // foreach($professors as $professor){
      //    foreach(range(1,3) as $index){
      //       $turma = Turma::create([
      //          'ano' => $faker->numberBetween($min = 2012, $max = 2016),
      //          'semestre' => $faker->numberBetween(1,2),
      //          'disciplina_id' => $faker->numberBetween(1,157),
      //          'cod_turma' => $faker->randomElement(['11', '12', '13', '21', '22', '23', '31', '32', '33', '41', '42', '43', '44'])
      //       ]);
      //       DB::table('professor_turma')->insert([
      //          'turma_id' => $turma->id,
      //          'professor_id' => $professor->id
      //       ]);
      //    }
      // }


      //Areas
      // foreach(range(1,50) as $index){
      //    DB::table('areas')->insert([
      //       'area' => $faker->sentence(3, true)
      //    ]);
      // }

      // Questionarios
      // $turmas = Turma::all();
      // foreach($turmas as $turma){
      //    foreach ($turma->professores as $professor) {
      //       $questionario = Questionario::create([
      //          'titulo' => $faker->sentence(3, true),
      //          'descricao' => $faker->paragraph(10, true),
      //          'professor_id' => $professor->id
      //       ]);
      //       $questionario->turmas()->attach($turma->id);
      //    }
      // }

      // Course_Major
      // $courses = Course::all()->pluck('id')->all();
      // $majors = Major::all()->pluck('id')->all();
      // foreach(range(1,1) as $index){
      //    DB::table('course_major')->insert([
      //       'course_id' => $faker->randomElement($courses),
      //       'major_id' => $faker->randomElement($majors)
      //    ]);
      // }

      // Surveys
      // $sections = Section::all()->pluck('id')->all();
      // $professors = Professor::all()->pluck('id')->all();
      // foreach(range(1,30) as $index){
      //    DB::table('surveys')->insert([
      //       'name' => $faker->sentence(3, true),
      //       'description' => $faker->paragraph(10, true),
      //       'professor_id' => $faker->randomElement($professors),
      //       'section_id' => $faker->randomElement($sections)
      //    ]);
      // }

      // Area_Professor
      // $areas = Area::all()->pluck('id')->all();
      // $professors = Professor::all()->pluck('id')->all();
      // foreach(range(1,50) as $index){
      //    DB::table('area_professor')->insert([
      //       'area_id' => $faker->randomElement($areas),
      //       'professor_id' => $faker->randomElement($professors)
      //    ]);
      // }

      // Aluno_Turma
      // $sections = Turma::where('id', '>', '242')->get();
      // $students = Aluno::all()->pluck('id')->all();
      // foreach($sections as $section){
      //    foreach(range(1,10) as $index){
      //       DB::table('aluno_turma')->insert([
      //          'turma_id' => $section->id,
      //          'aluno_id' => $faker->randomElement($students)
      //       ]);
      //    }
      // }


      // Professor_turma
      // $sections = Turma::all()->pluck('id')->all();
      // $professors = Professor::all()->pluck('id')->all();
      // foreach(range(1,50) as $index){
      //    DB::table('professor_turma')->insert([
      //       'turma_id' => $faker->randomElement($sections),
      //       'professor_id' => $faker->randomElement($professors)
      //    ]);
      // }

      //Perguntas
      // $types = TipoPergunta::all()->pluck('id')->all();
      // foreach(range(1,20) as $index){
      //    $question = $faker->sentence(5, true) . "?";
      //    DB::table('perguntas')->insert([
      //       'pergunta' => $question,
      //       'tipo_id' => $faker->randomElement($types)
      //    ]);
      // }

      // Questionario_Turma
      // $surveys = Questionario::all();
      // foreach($surveys as $survey){
      //    foreach ($survey->professor->turmas as $turma) {
      //       DB::table('questionario_turma')->insert([
      //          'questionario_id' => $survey->id,
      //          'turma_id' => $turma->id
      //       ]);
      //    }
      // }

      // $respostas = Resposta::all();
      // foreach ($respostas as $resposta){
      //    $qSId = DB::table('questionario_turma')->where('questionario_id', $resposta->questionario_id)->where('turma_id', $resposta->turma_id)->first();
      //    $resposta->questionario_turma_id = $qSId->id;
      //    $resposta->save();
      //  }
      // dd($respostas);

      //Pergunta_Questionario
      // $surveys = Questionario::all()->pluck('id')->all();
      // foreach($surveys as $survey){
      //    $questions = Pergunta::inRandomOrder()->pluck('id')->all();
      //    foreach(range(0,9) as $index){
      //       DB::table('pergunta_questionario')->insert([
      //          'pergunta_id' => $questions[$index],
      //          'questionario_id' => $survey
      //       ]);
      //    }
      // }

      //Choices
      // $questions = Pergunta::all();
      // foreach($questions as $question){
      //    for($i = 0; $i < 4; $i++){
      //       if($question->tipe_id != 1){
      //          DB::table('opcoes')->insert([
      //             'opcao' => $faker->sentence(3, true),
      //             'pergunta_id' => $question->id
      //          ]);
      //       }
      //    }
      // }

      // // Respostas
      // $sections = Turma::all();
      // foreach($sections as $section){
      //    foreach($section->questionarios as $survey){
      //       foreach ($section->alunos as $student){
      //          $response = Resposta::create([
      //             'questionario_id' => $survey->id,
      //             'aluno_id' => $student->id,
      //             'turma_id' => $section->id
      //          ]);
      //          foreach ($survey->perguntas as $question) {
      //             switch ($question->tipo->id) {
      //                case 1: # it's a text input
      //                DB::table('respostas_abertas')->insert([
      //                   'resposta' => $faker->sentence(10, true),
      //                   'resposta_id' =>  $response->id,
      //                   'pergunta_id' => $question->id
      //                ]);
      //                break;
      //
      //                case 2: # it's a radio input
      //                $choices = $question->opcoes()->pluck('id')->all();
      //                DB::table('respostas_unica_escolha')->insert([
      //                   'opcao_id' => $faker->randomElement($choices),
      //                   'resposta_id' =>  $response->id,
      //                   'pergunta_id' => $question->id
      //                ]);
      //                break;
      //
      //                case 3: # it's a checkbox input
      //                $choices = $question->opcoes()->inRandomOrder()->pluck('id')->all();
      //                $multipleChoiceResponse = RespostaMultiplaEscolha::create([
      //                   'resposta_id' =>  $response->id,
      //                   'pergunta_id' => $question->id
      //                ]);
      //                $n = rand(0,4);
      //                for ($i=0; $i < $n; $i++) {
      //                   $multipleChoiceResponse->opcoes()->attach(array_shift($choices));
      //                }
      //                if($n == 0){
      //                   $multipleChoiceResponse->opcoes()->attach($faker->randomElement($choices));
      //                }
      //                break;
      //             }
      //          }
      //       }
      //    }
      // }
   }
}
