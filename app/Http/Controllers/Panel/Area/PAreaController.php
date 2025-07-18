<?php

namespace App\Http\Controllers\Panel\Area;

use App\DataTables\Area\ProjectAreaDataTable;
use App\Http\Controllers\Controller;
use App\Models\Projects\ProjectArea;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PAreaController extends Controller
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

    public function index(ProjectAreaDataTable $dataTable)
    {
        //dd(User::with('userRole')->get());
        $data_count = ProjectArea::count();
        return $dataTable->render('admin.area.index', compact('data_count'));
    }

    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = ProjectArea::where('id', $dataID)->first();
        $dataQuery = [['status', 'active']];
        if (!empty($data)) {
            $dataQuery[] = ['id', '!=', $data->id];
        }
        $parent_areas = ProjectArea::select('id', 'name_uz as name')->where($dataQuery)->get();

        return  view('admin.area.addEditArea', compact('data', 'parent_areas'));
    }

    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = ProjectArea::where('id', $inputs['id'])->first() ?? new ProjectArea;
            $rules = [
                'name_uz' => 'required|string|max:255', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'name_en' => 'required|string|max:255',
                'name_ru' => 'required|string|max:255',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }

            $data->user_id = Auth::user()->id;
            $data->parent_id = $inputs['parent_id'] ?? null;
            $data->name_uz = $inputs['name_uz'];
            $data->name_ru = $inputs['name_ru'];
            $data->name_en = $inputs['name_en'];
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
            $data = ProjectArea::findOrFail($inputs['data_id']);
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
