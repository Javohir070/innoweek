<?php

namespace App\Http\Controllers\Panel;

use App\DataTables\Projects\ProjectTypeDataTable;
use App\Http\Controllers\Controller;
use App\Models\Projects\ProjectType;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ProjectTypeController extends Controller
{
    public function index(ProjectTypeDataTable $dataTable)
    {
        //dd(User::with('userRole')->get());
        $data_count = ProjectType::count();
        return $dataTable->render('admin.type.index', compact('data_count'));
    }

    public function TypeInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = ProjectType::where('id', $dataID)->first();

        return  view('admin.type.addEditType', compact('data'));
    }

    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = ProjectType::where('id', $inputs['id'])->first() ?? new ProjectType;
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
            $data->name_uz = $inputs['name_uz'];
            $data->name_ru = $inputs['name_ru'];
            $data->name_en = $inputs['name_en'];
            $data->status = 'activated';
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
            $data = ProjectType::findOrFail($inputs['data_id']);
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
