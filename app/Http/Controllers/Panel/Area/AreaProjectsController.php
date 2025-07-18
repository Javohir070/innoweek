<?php

namespace App\Http\Controllers\Panel\Area;

use App\DataTables\Area\AreaProjectsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Projects\Project;
use App\Models\Projects\ProjectArea;
use App\Models\Projects\ProjectCategory;
use App\Models\Projects\ProjectType;
use App\Models\Regions\Country;
use App\Models\Regions\District;
use App\Models\Regions\Region;
use App\Models\User;
use App\Models\UserDepartment;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class AreaProjectsController extends Controller
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

    public function index(AreaProjectsDataTable $dataTable, Request $request)
    {
        $inputs = $request->all();
        $status = $inputs['status'] ?? 'publish';
        $query = ['status' => $status];

        $deptQuery = ['status' => 'active'];
        $projectQuery[] = ['status', '=', $status];
        //get only one dept
        if (Auth::user()->hasRole('moderator')) {
            $deptQuery['id'] = Auth::user()->department_id;
            $projectQuery['id'] = Auth::user()->department_id;
        }

        if (Auth::user()->hasRole('moderator')) {
            $query['department_id'] = Auth::user()->department_id;
        }

        if (isset($inputs['cooperation']) && !empty($inputs['cooperation'])) {
            //array_push($query , 'cooperation', true);
            $query['cooperation'] = true;
            $projectQuery[] = ['passport_file', '!=', null];
            //dd( $query);
        }

        if (isset($inputs['area'])) {
            //array_push($query , 'cooperation', true);
            $query['area'] = $inputs['area'] == 1 ? true : false;
            $projectQuery[] = ['area_id', $inputs['area'] == 1 ? '!=' : '=', null];
        }

        if (isset($inputs['author']) && !empty($inputs['author'])) {
            $query['author'] = $inputs['author'];
        }

        if (isset($inputs['department_id']) && !empty($inputs['department_id'])) {
            $query['department_id'] = $inputs['department_id'];
            $projectQuery[] = ['department_id', $inputs['department_id']];
        }

        if (isset($inputs['category_id']) && !empty($inputs['category_id'])) {
            $query['category_id'] = $inputs['category_id'];
            $projectQuery[] = ['category_id', $inputs['category_id']];
        }

        $data_count = Project::where($projectQuery)->count();
        $departments = UserDepartment::select('id', 'name_uz as name')->where($deptQuery)->get();
        $project_categories = ProjectCategory::select('id', 'name_uz as name')->where([['status', '!=', 'deleted']])->get();

        return $dataTable->with($query)->render('admin.area.projects', compact('data_count', 'departments', 'project_categories', 'inputs'));
    }


    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = Project::where('id', $dataID)->with('author')->with('gallery')->with('area')->with('country')->with('category')->with('project_type')->first();
        $dataQuery = [['status', 'active']];
        $parent_areas = ProjectArea::select('id', 'name_uz as name')->where($dataQuery)->get();

        return view('admin.area.addEditProjectArea', compact('data', 'parent_areas'));
    }


    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $project = Project::find($inputs['id']) ?? new Project;

            $rules = [
                'area_id' => 'nullable|exists:project_areas,id',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }

            $project->area_id = $inputs['area_id'];
            //$project->status = $inputs['status'] ?? 'approved';
            $project->save();

            \Session::flash('success', trans("Ma'lumotlar saqlandi!"));
            return \Redirect::back();
        } catch (\Exception $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }
}
