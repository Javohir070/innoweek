<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Models\Regions\Region;
use App\Models\Projects\Project;
use App\Models\Regions\District;
use App\Http\Controllers\Controller;
use App\Models\Projects\ProjectType;
use Illuminate\Support\Facades\Validator;
use App\DataTables\Projects\ProjectDataTable;
use App\Models\Projects\ProjectCategory;
use App\Models\Projects\ProjectGallery;
use App\Models\Regions\Country;
use App\Models\User;
use App\Models\UserDepartment;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Auth;
use Carbon\Carbon;

class ProjectController extends Controller
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
    
    public function index(ProjectDataTable $dataTable, Request $request)
    {
        $inputs = $request->all();
        $query = ['id' => null];
        $deptQuery = ['status' => 'active'];
        $projectQuery[] = ['status', '!=', 'deleted'];
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

        return $dataTable->with($query)->render('admin.projects.index', compact('data_count', 'departments', 'project_categories'));
    }

    public function ProjectInfo(Request $request)
    {
        $inputs = $request->all();
        $cooperation = $inputs['cooperation'] ?? false;
        $dataID = $inputs['project_id'] ?? null;
        $data = Project::where('id', $dataID)->with('gallery')->first();
        
        $companies = User::select('id', 'company_name')->where([['user_type', 4], ['status', 'active']])->get();
        $project_types = ProjectType::select('id', 'name_uz as name')->get();
        $project_categories = ProjectCategory::select('id', 'name_uz as name')->get();
        $countries = Country::select('id', 'name_uz as name')->where([['status', 'active']])->orderBy('id', 'ASC')->get();

        $regions = Region::select('id', 'name_uz as name', 'country_id');
        if (!empty($data->country_id)) {
            $regions = $regions->where('country_id', $data->country_id);
        } else {
            $regions = $regions->where('country_id', "XXX");
        }
        $regions = $regions->get();

        $districts = District::select('id', 'name_uz as name', 'region_id');
        if (!empty($data->region_id)) {
            $districts = $districts->where('region_id', $data->region_id);
        } else {
            $districts = $districts->where('region_id', "XXX");
        }
        $districts = $districts->get();
        
        return view('admin.projects.addEditProject', compact('data', 'cooperation', 'companies', 'project_types', 'project_categories', 'countries', 'regions', 'districts'));
    }

    public function storeProjectData(Request $request)
    {
        try {
            $inputs = $request->all();
            $project = Project::find($inputs['id']) ?? new Project;
            $cooperation = $inputs['cooperation'] ?? false;

            $rules = [
                'project_title' => 'required|string|max:255',
                'type_id' => 'nullable|exists:project_types,id',
                'category_id' => 'nullable|exists:project_categories,id',
                'author_id' => 'required|exists:users,id',
                'publish_year' => 'nullable|integer',
                'images.*' => 'image|mimes:jpeg,png,jpg|max:5120' // Adjust max file size as needed
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }
            
            $projectFilesPath = '/upload/project-files/';
            // Handle file uploads
            if ($request->hasFile('passport_file')) {
                $fileName = 'passport_' . time() . '.' . $request->file('passport_file')->getClientOriginalExtension();
                $request->file('passport_file')->move(public_path() . $projectFilesPath, $fileName);
                $project->passport_file = $projectFilesPath . $fileName;
            }

            if ($request->hasFile('locality_file')) {
                $fileName = 'locality_' . time() . '.' . $request->file('locality_file')->getClientOriginalExtension();
                $request->file('locality_file')->move(public_path() . $projectFilesPath, $fileName);
                $project->locality_file = $projectFilesPath . $fileName;
            }

            if ($request->hasFile('innovation_file')) {
                $fileName = 'innovation_' . time() . '.' . $request->file('innovation_file')->getClientOriginalExtension();
                $request->file('innovation_file')->move(public_path() . $projectFilesPath, $fileName);
                $project->innovation_file = $projectFilesPath . $fileName;
            }

            $projectVideosPath = '/upload/project-videos/';
            if ($request->hasFile('video_url')) {
                $fileName = 'video_' . time() . '.' . $request->file('video_url')->getClientOriginalExtension();
                $request->file('video_url')->move(public_path() . $projectVideosPath, $fileName);
                $project->video_url = $projectVideosPath . $fileName;
            }

            // Save project details
            if (Auth::user()->hasRole('super-admin', 'admin')) {
                $project->user_id = $project->user_id ?? Auth::user()->id;
            }
            else {
                $project->user_id = Auth::user()->id;
            }

            $project->department_id = $project->department_id ?? Auth::user()->department_id;
            $project->author_id = $inputs['author_id'] ?? Auth::user()->id();
            $project->project_title = $inputs['project_title'];
            $project->type_id = $inputs['type_id'] ?? null;
            $project->category_id = $inputs['category_id'] ?? null;
            $project->publish_year = $inputs['publish_year'] ?? 2024;
            $project->creation_year = $inputs['creation_year'] ?? null;
            $project->amount = $inputs['amount'] ?? null;
            $project->country_id = $inputs['country_id'] ?? null;
            $project->region_id = $inputs['region_id'] ?? null;
            $project->district_id = $inputs['district_id'] ?? null;
            $project->description = $inputs['description'] ?? null;
            //$project->video_url = $inputs['video_url'] ?? null;
            
            if ($cooperation) {
                $project->certificate_number = $inputs['certificate_number'] ?? null;
                $project->certificate_url = $inputs['certificate_url'] ?? null;
                $project->trademark = $inputs['trademark'] ?? null;
                $project->unit_type_id = $inputs['unit_type_id'] ?? null;
                $project->min_order_value = $inputs['min_order_value'] ?? null;
                $project->max_order_value = $inputs['max_order_value'] ?? null;
                $project->amount_per = $inputs['amount_per'] ?? 0.00;
                $project->amount_total = $inputs['amount_total'] ?? 0.00;
                $project->expiration_date = isset($inputs['expiration_date']) ? Carbon::parse($inputs['expiration_date']) : null;
                $project->delivery_date = $inputs['delivery_date'] ?? null;
                $project->delivery_type_id = $inputs['delivery_type_id'] ?? null;
                $project->warranty_period = $inputs['warranty_period'] ?? null;
                $project->wp_type_id = $inputs['wp_type_id'] ?? null;
                $project->warranty_policy = $inputs['warranty_policy'] ?? null;
                $project->innovation_desc = $inputs['innovation_desc'] ?? null;
            }
            $project->is_engineering = $inputs['is_engineering'] ?? null;
            $project->status = $inputs['status'] ?? 'approved';
            $project->save();

            // Handle image upload and save to storage
            if ($request->hasFile('images')) {
                $projectGalleryPath = '/upload/project-images/';
                foreach ($request->file('images') as $image) {
                    $projectImages = new ProjectGallery;
                    $imageName = 'gallery_' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path() . $projectGalleryPath, $imageName);
                    $projectImages->project_id = $project->id;
                    $projectImages->image_url = $projectGalleryPath . $imageName;
                    $projectImages->save();
                }
            }

            \Session::flash('success', trans("Ma'lumotlar saqlandi!"));
            return \Redirect::back();
        } catch (\Exception $ex) {
            \Session::flash('error', $ex->getMessage());
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }

    public function changeProjectStatus(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = Project::findOrFail($inputs['data_id']);
            if ($data) {
                $data->status = $inputs['status'];
                $data->save();
                \Session::flash('success', trans("Ma'lumotlar yangilandi"));
                return \Redirect::back();
            }
        } catch (\Exception $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }

    public function destroyData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = Project::findOrFail($inputs['project_id']);
            if ($data) {
                $data->delete();
                \Session::flash('success', trans('words.Data deleted successful!'));
                return \Redirect::back();
            }
        } catch (\Exception $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }



    public function destroyProjectImageData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = ProjectGallery::findOrFail($inputs['id']);
            if ($data) {
                \File::delete(public_path() . $data->image_url);
                $data->delete();
                return response()->json($data, 200);
            }
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 401);
        }
    }
}
