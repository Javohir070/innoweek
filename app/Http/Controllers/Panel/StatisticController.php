<?php

namespace App\Http\Controllers\Panel;

use App\DataTables\StatisticDataTable;
use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class StatisticController extends Controller
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


    public function index(StatisticDataTable $dataTable)
    {
        $data_count = Statistic::count();
        return $dataTable->render('admin.statistic.index', compact('data_count'));
    }

    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = Statistic::where('id', $dataID)->first();
        $dataQuery = [['status', 'active']];
        if (!empty($data)) {
            $dataQuery[] = ['id', '!=', $data->id];
        }
        $statistics = Statistic::select('id', 'name_uz as name')->where($dataQuery)->get();
        return  view('admin.statistic.addEditStatistic', compact('data', 'statistics'));
    }

    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = Statistic::where('id', $inputs['id'])->first() ?? new Statistic;
            $rules = [
                'name_uz' => 'required|string|max:255', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }

            $data->user_id = Auth::user()->id;

            $data->name_uz = $inputs['name_uz'];
            $data->name_ru = $inputs['name_ru'];
            $data->name_en = $inputs['name_en'];

            $data->statistic = $inputs['statistic'];

            $dataImagePath = '/upload/statistic/';
            if ($request->hasFile('icon')) {
                $fileName = 'video_' . time() . '.' . $request->file('icon')->getClientOriginalExtension();
                $request->file('icon')->move(public_path() . $dataImagePath, $fileName);
                $data->icon = $dataImagePath . $fileName;
            }

            $data->status = 'active';
            $data->save();
            \Session::flash('success', trans("Ma'lumotlar saqlandi!"));
            return \Redirect::back();
        } catch (\Exception  $ex) {
            \Session::flash('error', $ex->getMessage());
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }


    public function destroyData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = Statistic::findOrFail($inputs['data_id']);
            if ($data) {
                $data->delete();
                \Session::flash('success', trans('words.Data deleted successful!'));
                return \Redirect::back();
            }
        } catch (\Exception  $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }
}
