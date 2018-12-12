<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('users')->insert([
      'name' => 'alirasouli',
      'email' => 'alirasouli@prog4eng.com',
      'password' => bcrypt('123456'),
      'verified' => true,
    ]);    
  }
}
