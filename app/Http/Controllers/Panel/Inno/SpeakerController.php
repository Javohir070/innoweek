<?php

namespace App\Http\Controllers\Panel\Inno;

use App\DataTables\Inno\SpeakerDataTable;
use App\Http\Controllers\Controller;
use App\Models\ArchiveYear;
use App\Models\Inno\Speaker;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SpeakerController extends Controller
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

    public function index(SpeakerDataTable $dataTable)
    {
        //dd(User::with('userRole')->get());
        $data_count = Speaker::count();
        return $dataTable->render('admin.speakers.index', compact('data_count'));
    }

    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = Speaker::where('id', $dataID)->first();
        $dataQuery = [['status', 'active']];
        // if (!empty($data)) {
        //     $dataQuery[] = ['id', '!=', $data->id];
        // }
        $archives = ArchiveYear::select('id', 'year as name')->where($dataQuery)->orderBy('year', 'DESC')->get();
        return  view('admin.speakers.addEditSpeaker', compact('data', 'archives'));
    }


    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = Speaker::where('id', $inputs['id'])->first() ?? new Speaker;
            $rules = [
                'full_name_uz' => 'required|string|max:255', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'full_name_en' => 'required|string|max:255',
                'full_name_ru' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg|max:5120' // Adjust max file size as needed
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }


            $dataImagePath = '/upload/speakers/';
            if ($request->hasFile('image')) {
                $fileName = 'speaker_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path() . $dataImagePath, $fileName);
                $data->image = $dataImagePath . $fileName;
            }

            $data->user_id = Auth::user()->id;
            $data->archive_id = $inputs['archive_id'] ?? null;
            $data->full_name_uz = $inputs['full_name_uz'];
            $data->full_name_ru = $inputs['full_name_ru'];
            $data->full_name_en = $inputs['full_name_en'];
            $data->job_uz = $inputs['job_uz'];
            $data->job_ru = $inputs['job_ru'];
            $data->job_en = $inputs['job_en'];
            $data->facebook_url = $inputs['facebook_url'];
            $data->twitter_url = $inputs['twitter_url'];
            $data->linkedin_url = $inputs['linkedin_url'];
            $data->youtube_url = $inputs['youtube_url'];
            $data->description_en = $inputs['description_en'];
            $data->description_ru = $inputs['description_ru'];
            $data->description_uz = $inputs['description_uz'];
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
            $data = Speaker::findOrFail($inputs['data_id']);
            if ($data) {
                \File::delete(public_path() . $data->image);
                $data->delete();
                \Session::flash('success', trans('words.Data deleted successful!'));
                return \Redirect::back();
            }
        } catch (\Exception $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }
}
