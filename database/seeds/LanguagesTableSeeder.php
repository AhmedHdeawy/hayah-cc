<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name'  =>  'Arabic',
            'locale'    =>  'ar',
            'dir'       =>  'rtl',
            'position'  =>  1
        ]);

        Language::create([
            'name'  =>  'Englsh',
            'locale'    =>  'en',
            'dir'       =>  'ltr',
            'position'  =>  2
        ]);
    }
}
