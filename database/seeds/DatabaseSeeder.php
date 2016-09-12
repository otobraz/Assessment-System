<?php

use Faker\Factory as Faker;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
      // foreach (range(1,10) as $index) {
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
   }
}
