<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'name'=> 'Dev',
        	'email'=> 'dev@dloper.com',
        	'password'=> Hash::make(123456),
        ]);
    }
}
