<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Projects\Project;
use App\Models\Projects\ProjectType;
use App\Models\Regions\Region;
use App\Models\UserDepartment;
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
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

    public function index(Request $request)
    {
        if (Auth::user()->hasRole('region-admin') && !isset($inputs['region_id'])) {
            $inputs = $request->all();
            return view('panel.pages.dashRegion', compact('districtStat', 'regionData', 'farmers_count', 'area_count', 'district_count'));
            //return redirect()->route('panel.farmers.index', ['region_id' => Auth::user()->region_id]);
        }
        $inputs = $request->all();
        $total_projects_count = Project::count();
        $approved_projects_count = Project::where([['status', 'approved']])->count();
        $canceled_projects_count = Project::where([['status', 'editing']])->count();
        $coop_projects_count = Project::where([['passport_file', '!=', null]])->count();
        $region_projects = Region::select('id', 'name_uz as name')->withCount('startup_projects')->withCount('com_projects')->withCount('edu_projects')->withCount('projects')->withCount('local_projects')->orderBy('id', 'ASC')->get();

        $projects_chart = ProjectType::select('id', 'name_uz as name')->withCount('projects')->withCount('approved_projects')->orderBy('id', 'ASC')->get();
        $projects_dept_chart = UserDepartment::select('id', 'name_uz as name')->withCount('projects')->withCount('approved_projects')->orderBy('id', 'ASC')->get();
        $projects_per_chart = ProjectType::select('id', 'name_uz as name')->withCount('projects')->orderBy('id', 'ASC')->get();
        return view('admin.index', compact('total_projects_count', 'approved_projects_count', 'canceled_projects_count', 'coop_projects_count', 'region_projects', 'projects_chart', 'projects_per_chart', 'projects_dept_chart'));
    }
}
