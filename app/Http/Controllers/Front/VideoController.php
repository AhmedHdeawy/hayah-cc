<?php

namespace App\Http\Controllers\Front;

use Image;
use App\Models\Type;
use App\Models\Video;
use App\Models\Period;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use ProtoneMedia\LaravelFFMpeg\Filters\WatermarkFactory;

class VideoController extends Controller
{
    /**
     * Show the create page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $categories = Cache::rememberForever('categories', function () {
            return Category::active()->get();
        });


        $departments = Cache::rememberForever('departments', function () {
            return Department::active()->get();
        });

        return view('front.create', compact('categories', 'departments'));
    }

    /**
     * Store New Video
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Form
        $this->validateVideoRequest($request);
        $user = auth()->user();

        // Translate Missed
        $transData = $this->prepareTranslatedData($request->only(['title', 'ingredients', 'preparing_method']));

        $givenData = $request->only(['category_id', 'department_id', 'people_count', 'period']);
        $givenData['user_id'] = $user->id;
        $givenData['country_id'] = $user->country_id;
        $givenData['state_id'] = $user->state_id;

        $data = array_merge($transData, $givenData);

        // Save Video
        $video = Video::create($data);

        // Save Image
        $this->saveImage($video, $request->image);

        // Manupilate with Video
        $this->saveVideo($video, $request->video);

        // Update User Recipes Count
        $user->recipes_count += 1;
        $user->save();

        return response()->json($video, 200);
    }

    /**
     * @param array $data
     *
     * @return [type]
     */
    public function prepareTranslatedData(array $data)
    {
        $newData = [];
        $tr = new GoogleTranslate();
        foreach($data as $key => $value)
        {
            $tr->translate($value);
            $givenLang = $tr->getLastDetectedSource();
            $missedLabg = $givenLang == 'ar' ? 'en' : 'ar';
            $newText = $tr->setSource($givenLang)->setTarget($missedLabg)->translate($value);
            $newData[$givenLang][$key]  = $value;
            $newData[$missedLabg][$key]  = $newText;
        }

        return $newData;
    }

    /**
     * @param Model $model
     * @param mixed $image
     * @param string $type
     *
     * @return [type]
     */
    public function saveVideo(Video $video, $file)
    {
        $name =  $file->getClientOriginalName();
        $name = uniqid('Hayah_') . Str::random(8) . time() . '_' . $name;
        $path =  'video/' . $video->id;

        FFMpeg::fromDisk('local_root')
        ->open($file)
        ->addWatermark(function (WatermarkFactory $watermark) {
            $watermark->fromDisk('local_public')
            ->open('images/logo-100.png')
            ->right(25)
            ->bottom(25)
            ->width(50)
            ->height(50);
        })
        ->addWatermark(function (WatermarkFactory $watermark1) {
            $watermark1->fromDisk('public')
                ->open('users/' . auth()->id() . '.svg')
                ->right(40)
                ->bottom(40);
        })
        ->addWatermark(function (WatermarkFactory $watermark2) {
            $watermark2->fromDisk('local_public')
            ->open('images/logo-name.png')
            ->left(0)
            ->top(25)
            ->width(150)
            ->height(50);
        })
        ->export()
            ->toDisk('public')
            ->inFormat(new \FFMpeg\Format\Video\WebM)
            ->save($path . '/' . $name);

        // Store Image
        // Storage::putFileAs($path, $file, $name);

        $video->video = $path . '/' . $name;
        $video->save();

        return true;
    }

    /**
     * @param Request $request
     * @param mixed $slug
     *
     * @return [type]
     */
    public function showVideo(Request $request, $slug)
    {
        $id = explode('-', $slug);
        $video = Video::active()->findOrFail($id[0]);

        $relatedVideos = Video::active()
                            ->where('id', '!=', $video->id)
                            ->where('category_id', $video->category_id)
                            ->where('department_id', $video->department_id)
                            ->limit(6)
                            ->get();

        return view('front.video', compact('video', 'relatedVideos'));
    }

    /**
     * @param Request $request
     * @param mixed $slug
     *
     * @return [type]
     */
    public function download(Video $video)
    {
        return response()->download(storage_path('app/public/' . $video->video));
    }

    /**
     * Send Email to Agent
     */
    public function addToFavorites(Request $request)
    {
        $this->validate($request, [
            'video_id'  =>  'required|numeric',
        ]);

        $user = auth()->user();

        $oldFavorites = $user->favorites->pluck('id')->toArray();
        if (in_array($request->video_id, $oldFavorites)) {
            // Remove this video from favorites
            $user->favorites()->detach($request->video_id);
        } else {
            // Add this video to favorites
            $user->favorites()->attach($request->video_id);
        }

        return response()->json(null, 200);
    }

    /**
     * Validate Form Request.
     *
     * @return \Illuminate\Http\Response
     */
    protected function validateVideoRequest(Request $request)
    {
        Validator::make($request->all(), [
            'category_id'       => 'required|numeric',
            'title'             => 'required|string',
            'ingredients'       => 'required|string',
            'preparing_method'  => 'required|string',
            'period'            => 'required|string',
            'people_count'      => 'required|numeric',
            'image'             => 'required|image|max:1000',
            'video'             => 'required|max:100000',
        ])->validate();
    }

}
