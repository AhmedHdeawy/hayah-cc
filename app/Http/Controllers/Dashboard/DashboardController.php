<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videosStatus = $this->getVideosStatus();

        $newVideos = $this->getVideosInLastTwoWeeks();

        return view('dashboard.dashboard.home', compact('newVideos', 'videosStatus'));
    }

    /**
     * Get Orders in Last Week.
     *
     * @return \Illuminate\Http\Response
     */
    private function getVideosStatus()
    {
        $videosStatus['stopped']     = Category::where('status', '0')->count();
        $videosStatus['active']      = Category::where('status', '1')->count();

        $videosStatus['stopped']     = 23;
        $videosStatus['active']      = 12;

        return $videosStatus;
    }

    /**
     * Get Videos in Last Two Weeks.
     *
     * @return \Illuminate\Http\Response
     */
    private function getVideosInLastTwoWeeks()
    {
        // Loop through last week days
        for ($i = 0; $i <= 13; $i++) {

            // Get Day for Search
            $day = date('Y-m-d', strtotime('-' . $i . ' day'));

            // Filter Videos per Today
            $propertiesInDay[$day] = Category::whereDate('created_at', $day)->orderBy('id', 'desc')->count();
        }

        return $propertiesInDay;
    }

}
