<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('set Foreign_Key_Checks=0');
        DB::table('users')->truncate();
        $faker=Factory::create();
        DB::table('users')->insert([
          [
          'name'=>"John Doe",
          'slug'=>"jhon-doe",
          'email'=>"johndoe@test.com",
          'password'=>bcrypt('secret'),
          'bio'=>$faker->text(rand(250,300))
          ],
          [
          'name'=>"Jane Doe",
          'slug'=>"jane-doe",
          'email'=>"janedoe@test.com",
          'password'=>bcrypt('secret'),
          'bio'=>$faker->text(rand(250,300))
          ],
          [
          'name'=>"Ahmad Ramdhani",
          'slug'=>"ahmad-ramdhani",
          'email'=>"ahmad@test.com",
          'password'=>bcrypt('secret'),
          'bio'=>$faker->text(rand(250,300))
          ]

        	]);
    }
}
