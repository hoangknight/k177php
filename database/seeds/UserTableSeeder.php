<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = [
    		['id'=>1, 'fullname' => 'Administrator', 'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'email' => 'admin@gmail.com', 'phone' => '0395954444', 'level' => 2],
    		['id'=>2, 'fullname' => 'Dev01', 'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'email' => 'dev01@gmail.com', 'phone' => '0395954444', 'level' => 1],
    		['id'=>3, 'fullname' => 'Dev02', 'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'email' => 'dev02@gmail.com', 'phone' => '0395954444', 'level' => 1],
    	];
    	DB::table('users')->delete();
        DB::table('users')->insert($data);
    }
}
