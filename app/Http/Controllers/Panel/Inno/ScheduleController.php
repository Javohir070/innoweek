<?php

namespace App\Http\Controllers\Panel\Inno;

use App\DataTables\Inno\ScheduleDataTable;
use App\Http\Controllers\Controller;
use App\Models\ArchiveYear;
use App\Models\Inno\Schedule;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ScheduleController extends Controller
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

    public function index(ScheduleDataTable $dataTable)
    {
        //dd(User::with('userRole')->get());
        $data_count = Schedule::count();
        return $dataTable->render('admin.schedules.index', compact('data_count'));
    }

    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = Schedule::where('id', $dataID)->first();
        $dataQuery = [['status', 'active']];
        if (!empty($data)) {
            $dataQuery[] = ['id', '!=', $data->id];
        }
        $archives = ArchiveYear::select('id', 'year as name')->where($dataQuery)->get();
        return  view('admin.schedules.addEditSchedule', compact('data', 'archives'));
    }


    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = Schedule::where('id', $inputs['id'])->first() ?? new Schedule;
            $rules = [
                'title_uz' => 'required|string|max:255', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'title_en' => 'required|string|max:255',
                'title_ru' => 'required|string|max:255',
                //'image' => 'image|mimes:jpeg,png,jpg|max:5120' // Adjust max file size as needed
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }

            $data->user_id = Auth::user()->id;
            $data->archive_id = $inputs['archive_id'] ?? null;
            $data->title_uz = $inputs['title_uz'];
            $data->title_ru = $inputs['title_ru'];
            $data->title_en = $inputs['title_en'];
            $data->date = isset($inputs['date']) ? Carbon::parse($inputs['date']) : null;

            $data->started_at = $inputs['started_at'];
            $data->stopped_at = $inputs['stopped_at'];
            $data->live_url = $inputs['live_url'];
            $data->innoweek_video = $inputs['innoweek_video'];
            $data->description_uz = $inputs['description_uz'];
            $data->description_ru = $inputs['description_ru'];
            $data->description_en = $inputs['description_en'];
            $data->address_uz = $inputs['address_uz'];
            $data->address_ru = $inputs['address_ru'];
            $data->address_en = $inputs['address_en'];
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
            $data = Schedule::findOrFail($inputs['data_id']);
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
