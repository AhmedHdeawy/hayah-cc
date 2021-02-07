<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // fillCountries();
        DB::insert(DB::raw("INSERT INTO `countries` (`id`, `code`, `status`, `created_at`, `updated_at`) VALUES
                    (1, 'ae', '1', '2020-10-11 17:07:48', '2020-10-11 17:07:48'),
                    (2, 'eg', '1', '2020-10-11 17:07:48', '2020-10-11 17:07:48'),
                    (3, 'sa', '1', '2020-10-11 17:07:48', '2020-10-11 17:07:48')
                "));

        DB::insert(DB::raw("INSERT INTO `country_translations` (`countries_trans_id`, `country_id`, `locale`, `name`) VALUES
                                        (1, 1, 'ar', 'الإمارات العربية المتحدة'),
                                        (2, 1, 'en', 'United Arab Emirates'),
                                        (3, 2, 'ar', 'مصر'),
                                        (4, 2, 'en', 'Egypt'),
                                        (5, 3, 'ar', 'المملكة العربية السعودية'),
                                        (6, 3, 'en', 'Saudi Arabia');
                "));
    }
}
