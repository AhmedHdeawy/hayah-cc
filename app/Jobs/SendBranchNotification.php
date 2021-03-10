<?php

namespace App\Jobs;

use App\Models\Device;
use App\Services\SendNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendBranchNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $model;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info($this->model->name);
        Log::info($this->model->latitude);
        Log::info($this->model->longitude);


        // Initial Query
        $query = Device::latest();

        // Search Discussion in 50KM
        if (isset($this->model->latitude) && isset($this->model->longitude)) {

            $latitude = $this->model->latitude;
            $longitude = $this->model->longitude;

            $query = $query->select(
                DB::raw('
                *, ( 6367 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians( latitude ) ) ) ) AS distanceNearest
                ')
            )
                ->having('distanceNearest', '<', 5)
                ->orderBy('distanceNearest')
                ->get();
            
            $tokens = $query->pluck('device_token')->toArray();
            $data = [
                'title' =>  'تم افتتاح فرع ' . $this->model->name,
                'body'  =>  'دلوقتي تقدر تستخدم كارت حياه في فرع  ' . $this->model->name . ' الجديد'
            ];
            
            Log::info($tokens);
            SendNotification::send($tokens, $data);
        }

    }
}
