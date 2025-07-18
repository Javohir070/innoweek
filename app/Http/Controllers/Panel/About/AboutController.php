<?php

namespace App\Http\Controllers\Panel\About;

use Auth;
use Illuminate\Support\Str;
use App\Models\About\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\About\AboutDataTable;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
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

    public function index(AboutDataTable $dataTable, Request $request)
    {
        $inputs = $request->all();
        $query = ['id' => null];

        if (Auth::user()->hasRole('moderator', 'organizer')) {
            $query['department_id'] = Auth::user()->department_id;
        }

        if (isset($inputs['author']) && !empty($inputs['author'])) {
            $query['author'] = $inputs['author'];
        }
        $data_count = About::where([['status', '!=', 'deleted']])->count();
        return $dataTable->with($query)->render('admin.about.index', compact('data_count'));
    }

    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = About::where('id', $dataID)->first();

        return  view('admin.about.addEditAbout', compact('data'));
    }

    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = About::find($inputs['id']) ?? new About;

            $rules = [
                'description_uz' => 'required|string|min:20',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }

            $dataImagePath = '/upload/about/';
            if ($request->hasFile('image')) {
                $fileName = 'innoweek__' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path() . $dataImagePath, $fileName);
                $data->image = $dataImagePath . $fileName;
            }
            if ($request->hasFile('file_1_uz')) {
                $fileName = 'uz_innoweek_file_b_' . time() . '.' . $request->file('file_1_uz')->getClientOriginalExtension();
                $request->file('file_1_uz')->move(public_path() . $dataImagePath, $fileName);
                $data->file_1_uz = $dataImagePath . $fileName;
            }

            if ($request->hasFile('file_1_ru')) {
                $fileName = 'ru_innoweek_file_b_' . time() . '.' . $request->file('file_1_ru')->getClientOriginalExtension();
                $request->file('file_1_ru')->move(public_path() . $dataImagePath, $fileName);
                $data->file_1_ru = $dataImagePath . $fileName;
            }

            if ($request->hasFile('file_1_en')) {
                $fileName = 'en_innoweek_file_b_' . time() . '.' . $request->file('file_1_en')->getClientOriginalExtension();
                $request->file('file_1_en')->move(public_path() . $dataImagePath, $fileName);
                $data->file_1_en = $dataImagePath . $fileName;
            }

            if ($request->hasFile('file_2_uz')) {
                $fileName = 'uz_innoweek_file_program_' . time() . '.' . $request->file('file_2_uz')->getClientOriginalExtension();
                $request->file('file_2_uz')->move(public_path() . $dataImagePath, $fileName);
                $data->file_2_uz = $dataImagePath . $fileName;
            }

            if ($request->hasFile('file_2_ru')) {
                $fileName = 'ru_innoweek_file_program_' . time() . '.' . $request->file('file_2_ru')->getClientOriginalExtension();
                $request->file('file_2_ru')->move(public_path() . $dataImagePath, $fileName);
                $data->file_2_ru = $dataImagePath . $fileName;
            }

            if ($request->hasFile('file_2_en')) {
                $fileName = 'en_innoweek_file_program_' . time() . '.' . $request->file('file_2_en')->getClientOriginalExtension();
                $request->file('file_2_en')->move(public_path() . $dataImagePath, $fileName);
                $data->file_2_en = $dataImagePath . $fileName;
            }

            $data->user_id = Auth::user()->id;
            $data->description_uz = $inputs['description_uz'];
            $data->description_ru = $inputs['description_ru'];
            $data->description_en = $inputs['description_en'];
            $data->status = 'active';
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
        $tmpFilePath = 'upload/about/';
        $hardPath =  Str::slug('about', '-') . '-' . uniqid();
        $imagine = new \Imagine\Gd\Imagine();
        $image = $imagine->open($image);
        $image->save($tmpFilePath . $hardPath . '.png');
        return response()->json(['location' => '/' . $tmpFilePath . $hardPath . '.png']);
    }

    public function destroyData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = About::findOrFail($inputs['data_id']);
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
