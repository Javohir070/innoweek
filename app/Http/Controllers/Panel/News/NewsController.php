<?php

namespace App\Http\Controllers\Panel\News;

use App\DataTables\News\NewsDataTable;
use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(NewsDataTable $dataTable, Request $request)
    {
        $inputs = $request->all();
        $query = ['id' => null];

        if (Auth::user()->hasRole('moderator', 'organizer')) {
            $query['department_id'] = Auth::user()->department_id;
        }

        if (isset($inputs['author']) && !empty($inputs['author'])) {
            $query['author'] = $inputs['author'];
        }
        $data_count = News::where([['status', '!=', 'deleted']])->count();
        return $dataTable->with($query)->render('admin.news.index', compact('data_count'));
    }

    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = News::where('id', $dataID)->first();
        $dataQuery = [['status', 'active']];
        $categories = NewsCategory::select('id', 'name_uz as name')->where($dataQuery)->get();
        return  view('admin.news.addEditNews', compact('data', 'categories'));
    }

    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = News::find($inputs['id']) ?? new News;

            $rules = [
                'title_uz' => 'required|string|max:255',
                'category_id' => 'nullable|exists:project_categories,id',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }

            // $dataImagePath = '/upload/news/';
            // if ($request->hasFile('image')) {
            //     $fileName = 'image_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            //     $request->file('image')->move(public_path() . $dataImagePath, $fileName);
            //     $data->image = $dataImagePath . $fileName;
            // }

            $image = $request->file('image');
            if ($image) {
                $tmpFilePath = 'upload/news/';
                $hardPath =  Str::slug('news', '-') . '-' . md5(time());
                $imagine = new \Imagine\Gd\Imagine();
                $image = $imagine->open($image);
                $phone_img = $image->thumbnail(new \Imagine\Image\Box(300, 300));
                $phone_img->save($tmpFilePath . $hardPath . '_phone_300.png');
                $thumbnail = $image->thumbnail(new \Imagine\Image\Box(450, 250));
                $thumbnail->save($tmpFilePath . $hardPath . '_thumbnail_450.png');
                $bigImg = $image->thumbnail(new \Imagine\Image\Box(1128, 631));
                $bigImg->save($tmpFilePath . $hardPath . '_big_720.png');
                $data->image = $hardPath;
            }

            // Save project details
            if (Auth::user()->hasRole('super-admin', 'admin')) {
                $data->user_id = $data->user_id ?? Auth::user()->id;
            } else {
                $data->user_id = Auth::user()->id;
            }

            $data->author_id = $inputs['author_id'] ?? null;
            $data->title_uz = $inputs['title_uz'];
            $data->description_uz = $inputs['description_uz'];
            $data->title_ru = $inputs['title_ru'];
            $data->description_ru = $inputs['description_ru'];
            $data->title_en = $inputs['title_en'];
            $data->description_en = $inputs['description_en'];
            $data->category_id = $inputs['category_id'] ?? null;
            $data->keywords = $inputs['keywords'] ?? null;
            $data->status = $inputs['status'] ?? 'active';
            $data->save();

            \Session::flash('success', trans("Ma'lumotlar saqlandi!"));
            return \Redirect::back();
        } catch (\Exception $ex) {
            \Session::flash('error', $ex->getMessage());
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }


    public function uploadImage(Request $request)
    {
        $image = $request->file('file');
        $tmpFilePath = 'upload/news/post/';
        $hardPath =  Str::slug('news', '-') . '-' . uniqid();
        $imagine = new \Imagine\Gd\Imagine();
        $image = $imagine->open($image);
        $image->save($tmpFilePath . $hardPath . '.png');
        return response()->json(['location' => '/' . $tmpFilePath . $hardPath . '.png']);
    }

    public function destroyData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = News::findOrFail($inputs['data_id']);
            if ($data) {
                $data->delete();
                \Session::flash('success', trans('words.Data deleted successful!'));
                return \Redirect::back();
            }
        } catch (\Exception $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }
}
