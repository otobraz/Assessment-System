<?php

use Faker\Factory as Faker;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Disciplina;        use App\Models\Turma;
use App\Models\Curso;         use App\Models\Aluno;
use App\Models\Professor;     use App\Models\TipoPergunta;
use App\Models\Area;          use App\Models\Questionario;
use App\Models\Pergunta;

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
      // foreach (range(1,50) as $index) {
      //    DB::table('professores')->insert([
      //       'usuario' => $faker->userName,
      //       'siape' => $faker->randomNumber(9),
      //       'nome' => $faker->firstName,
      //       'sobrenome' => $faker->lastName,
      //       'email' => $faker->email,
      //       'departamento_id' => $faker->numberBetween(1,4)
      //    ]);
      // }

      // Disciplinas
      // foreach(range(1,50) as $index){
      //    DB::table('disciplinas')->insert([
      //       'cod_disciplina' => $faker->numerify('CEA###'),
      //       'disciplina' => $faker->sentence($nbWords = 3, $variableNbWords = true),
      //       'departamento_id' => $faker->numberBetween(1,4)
      //    ]);
      // }

      // Turmas
      // foreach(range(1,50) as $index){
      //    DB::table('turmas')->insert([
      //       'ano' => $faker->numberBetween($min = 2012, $max = 2016),
      //       'semestre' => $faker->numberBetween(1,2),
      //       'disciplina_id' => $faker->numberBetween(1,50)
      //    ]);
      // }

      //Areas
      // foreach(range(1,50) as $index){
      //    DB::table('areas')->insert([
      //       'area' => $faker->sentence(3, true)
      //    ]);
      // }

      // Questionarios
      // $professors = Professor::all()->pluck('id')->all();
      // foreach(range(1,50) as $index){
      //    DB::table('questionarios')->insert([
      //       'titulo' => $faker->sentence(3, true),
      //       'descricao' => $faker->paragraph(10, true),
      //       'professor_id' => $faker->randomElement($professors)
      //    ]);
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
      // $sections = Turma::all()->pluck('id')->all();
      // $students = Aluno::all()->pluck('id')->all();
      // foreach(range(1,50) as $index){
      //    DB::table('aluno_turma')->insert([
      //       'turma_id' => $faker->randomElement($sections),
      //       'aluno_id' => $faker->randomElement($students)
      //    ]);
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

      // Perguntas
      // $types = TipoPergunta::all()->pluck('id')->all();
      // foreach(range(1,20) as $index){
      //    $question = $faker->sentence(5, true) . "?";
      //    DB::table('perguntas')->insert([
      //       'pergunta' => $question,
      //       'tipo_id' => $faker->randomElement($types)
      //    ]);
      // }

      // Questionario_Turma
      // $sections = Turma::all()->pluck('id')->all();
      // $surveys = Questionario::all()->pluck('id')->all();
      // foreach(range(1,50) as $index){
      //    DB::table('questionario_turma')->insert([
      //       'questionario_id' => $faker->randomElement($sections),
      //       'turma_id' => $faker->randomElement($surveys)
      //    ]);
      // }

      // Respostas
      // $surveys = Questionario::all()->pluck('id')->all();
      // foreach(range(1,50) as $index){
      //    $survey_id = $faker->randomElement($surveys);
      //    $section_id = $faker->randomElement(Questionario::find($survey_id)->turmas()->pluck('id')->all());
      //    $student_id = $faker->randomElement(Turma::find($section_id)->alunos()->pluck('id')->all());
      //    DB::table('respostas')->insert([
      //       'questionario_id' => $survey_id,
      //       'aluno_id' => $student_id
      //    ]);
      // }

      // Pergunta_Questionario
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

      // Choices
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
   }
}
