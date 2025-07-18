<?php

namespace App\Http\Controllers\Panel\Inno;

use App\DataTables\Inno\LiveDataTable;
use App\Http\Controllers\Controller;
use App\Models\ArchiveYear;
use App\Models\Inno\LiveVideos;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LiveController extends Controller
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

    public function index(LiveDataTable $dataTable)
    {
        //dd(User::with('userRole')->get());
        $data_count = LiveVideos::count();
        return $dataTable->render('admin.live.index', compact('data_count'));
    }

    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = LiveVideos::where('id', $dataID)->first();
        $dataQuery = [['status', 'active']];
        if (!empty($data)) {
            $dataQuery[] = ['id', '!=', $data->id];
        }
        $archives = ArchiveYear::select('id', 'year as name')->where($dataQuery)->get();
        return  view('admin.live.addEditLive', compact('data', 'archives'));
    }

    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = LiveVideos::where('id', $inputs['id'])->first() ?? new LiveVideos;
            $rules = [
                'title_uz' => 'required|string|max:255', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'title_en' => 'required|string|max:255',
                'title_ru' => 'required|string|max:255',
                'youtube_url' => 'required|string|max:255',
                //'image' => 'image|mimes:jpeg,png,jpg|max:5120' // Adjust max file size as needed
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }

            $data->user_id = Auth::user()->id;
            $data->type_id = $inputs['type_id'] ?? 1;
            $data->archive_id = $inputs['archive_id'] ?? null;
            $data->title_uz = $inputs['title_uz'];
            $data->title_ru = $inputs['title_ru'];
            $data->title_en = $inputs['title_en'];
            $data->youtube_url = $inputs['youtube_url'];
            $data->started_at = $inputs['started_at'] ?? null;
            $data->date = isset($inputs['date']) ? Carbon::parse($inputs['date']) : null;
            $data->status = 'active';
            $data->save();
            \Session::flash('success', trans("Ma'lumotlar saqlandi!"));
            return \Redirect::back();
        } catch (\Exception  $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }

    public function destroyData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = LiveVideos::findOrFail($inputs['data_id']);
            if ($data) {
                //\File::delete(public_path() . $data->image);
                $data->delete();
                \Session::flash('success', trans('words.Data deleted successful!'));
                return \Redirect::back();
            }
        } catch (\Exception $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }
}
