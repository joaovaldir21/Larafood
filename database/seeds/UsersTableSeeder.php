<?php

use App\Models\User;
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
      User::create([
          'name' => 'João Valdir',
          'email' => 'joaovaldir21@gmail.com',
          'password' => bcrypt('42363140'),
      ]);
    }
}
