<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'username'  =>  'admin',
            'email'     =>  'admin@admin.com',
            'password'  =>  'password',
        ]);

        Admin::create([
            'username'  =>  'abdullah',
            'email'     =>  'abdullah@chef.com',
            'password'  =>  'abdullah@chef',
        ]);
    }
}
