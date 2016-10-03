<?php

use Faker\Factory as Faker;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Models\Course;        use App\Models\Section;
use App\Models\Major;         use App\Models\Student;
use App\Models\Professor;     use App\Models\QuestionType;
use App\Models\Area;          use App\Models\Survey;
use App\Models\Question;

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

      // Students
      // foreach (range(1,20) as $index) {
      //    DB::table('students')->insert([
      //       'username' => $faker->userName,
      //       'first_name' => $faker->firstName,
      //       'last_name' => $faker->lastName,
      //       'email' => $faker->email,
      //       'major_id' => $faker->numberBetween(1,4)
      //    ]);
      // }

      // Admins
      // foreach (range(1,10) as $index) {
      //    DB::table('admins')->insert([
      //       'username' => $faker->userName,
      //       'first_name' => $faker->firstName,
      //       'last_name' => $faker->lastName,
      //       'email' => $faker->email,
      //       'password' => bcrypt('admin')
      //    ]);
      // }

      // Professors
      // foreach (range(1,20) as $index) {
      //    DB::table('professors')->insert([
      //       'username' => $faker->userName,
      //       'first_name' => $faker->firstName,
      //       'last_name' => $faker->lastName,
      //       'email' => $faker->email,
      //       'department_id' => $faker->numberBetween(1,4)
      //    ]);
      // }

      // Course
      // foreach(range(1,30) as $index){
      //    DB::table('courses')->insert([
      //       'code' => $faker->numerify('CEA###'),
      //       'course' => $faker->sentence($nbWords = 3, $variableNbWords = true)
      //    ]);
      // }

      // Section
      // foreach(range(1,20) as $index){
      //    DB::table('sections')->insert([
      //       'year' => $faker->numberBetween($min = 2012, $max = 2016),
      //       'semester' => $faker->numberBetween(1,2),
      //       'course_id' => $faker->numberBetween(1,30),
      //       'type_id' => $faker->numberBetween(1,3)
      //    ]);
      // }

      // Areas
      // foreach(range(1,20) as $index){
      //    DB::table('areas')->insert([
      //       'area' => $faker->sentence(3, true)
      //    ]);
      // }

      // Surveys
      // foreach(range(1,20) as $index){
      //    DB::table('surveys')->insert([
      //       'name' => $faker->sentence(3, true),
      //       'description' => $faker->paragraph(10, true)
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
      // foreach(range(1,3) as $index){
      //    DB::table('area_professor')->insert([
      //       'area_id' => $faker->randomElement($areas),
      //       'professor_id' => $faker->randomElement($professors)
      //    ]);
      // }

      // Section_Student
      // $sections = Section::all()->pluck('id')->all();
      // $students = Student::all()->pluck('id')->all();
      // foreach(range(1,1) as $index){
      //    DB::table('section_student')->insert([
      //       'section_id' => $faker->randomElement($sections),
      //       'student_id' => $faker->randomElement($students)
      //    ]);
      // }

      // Section_Professor
      // $sections = Section::all()->pluck('id')->all();
      // $professors = Professor::all()->pluck('id')->all();
      // foreach(range(1,4) as $index){
      //    DB::table('section_professor')->insert([
      //       'section_id' => $faker->randomElement($sections),
      //       'professor_id' => $faker->randomElement($professors)
      //    ]);
      // }

      // Questions
      // $types = QuestionType::all()->pluck('id')->all();
      // foreach(range(1,30) as $index){
      //    $question = $faker->sentence(5, true) . "?";
      //    DB::table('questions')->insert([
      //       'question' => $question,
      //       'type_id' => $faker->randomElement($types)
      //    ]);
      // }

      // Responses
      // $students = Student::all()->pluck('id')->all();
      // $surveys = Survey::all()->pluck('id')->all();
      // foreach(range(1,10) as $index){
      //    DB::table('responses')->insert([
      //       'survey_id' => $faker->randomElement($surveys),
      //       'student_id' => $faker->randomElement($students)
      //    ]);
      // }

      // Survey_Question
      // $surveys = Survey::all()->pluck('id')->all();
      // foreach($surveys as $survey){
      //    $questions = Question::inRandomOrder()->pluck('id')->all();
      //    foreach(range(0,9) as $index){
      //       DB::table('survey_question')->insert([
      //          'question_id' => $questions[$index],
      //          'survey_id' => $survey
      //       ]);
      //    }
      // }

      // Choices
      // $questions = Question::all();
      // foreach($questions as $question){
      //    for($i = 0; $i < 4; $i++){
      //       if($question->type_id != 1){
      //          DB::table('choices')->insert([
      //             'choice' => $faker->sentence(3, true),
      //             'question_id' => $question->id
      //          ]);
      //       }
      //    }
      // }
   }
}
