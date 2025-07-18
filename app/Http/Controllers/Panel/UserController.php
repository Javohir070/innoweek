<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Users\UserDataTable;
use App\Models\Projects\ProjectType;
use App\Models\Regions\Country;
use App\Models\Regions\District;
use App\Models\Regions\Region;
use App\Models\User;
use App\Models\UserDepartment;
use App\Models\UserRole;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        //dd(User::with('userRole')->get());
        $data_count = UserRole::count();
        return $dataTable->render('admin.user.index', compact('data_count'));
    }

    public function UserInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['user_id'] ?? null;
        $data = User::where('id', $dataID)->with('role')->first();
        $project_types = ProjectType::select('id', 'name_uz as name')->get();
        $user_departments = UserDepartment::select('id', 'name_uz as name')->get();

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

        return  view('admin.user.addEditUser', compact('data', 'project_types', 'regions', 'districts', 'countries', 'user_departments'));
    }


    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = User::where('id', $inputs['id'])->first() ?? new User;
            $rules = [
                'first_name' => 'required|string|max:30', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'last_name' => 'required|string|max:30',
                //'region_id' => 'required',
                'email' => 'required|string|max:30|unique' . !empty($inputs['id']) ? ':users,email,' . $inputs['id'] : '',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }

            //User Logo
            $userLogoPath = '/upload/users/';
            $userLogoFile = $request->file('avatar');
            if ($userLogoFile) {
                $fileName = $userLogoPath . time() . '_' . $userLogoFile->getClientOriginalName();
                $userLogoFile->move(public_path() . $userLogoPath, $fileName);
                $data->avatar = $fileName;
            }

            $data->user_type = 1;
            $data->first_name = $inputs['first_name'];
            $data->last_name = $inputs['last_name'];
            $data->middle_name = $inputs['middle_name'];
            $data->pinfl = $inputs['pinfl'] ?? null;
            $data->passport_serial = $inputs['passport_serial'] ?? null;
            $data->passport_number = $inputs['passport_number'] ?? null;
            $data->address = $inputs['address'] ?? null;
            $data->country_id = $inputs['country_id']  ?? null;
            $data->region_id = $inputs['region_id']  ?? null;
            $data->district_id = $inputs['district_id'] ?? null;
            $data->p_type_id = $inputs['p_type_id'] ?? null;
            $data->department_id = $inputs['department_id'] ?? null;
            $data->email = $inputs['email'];
            $data->phone = $inputs['phone'] ?? "";

            if (isset($inputs['password']) && $inputs['password'] != null) {
                $data->password = Hash::make($inputs['password']);
            }

            $data->status = 'active';
            $data->confirmed = true;
            //$data->blocked = $inputs['blocked'];
            $data->save();

            $userRole = UserRole::find($data->id) ?? new UserRole;
            $userRole->user_id = $data->id;
            $userRole->x_roles_id = $inputs['role_id'];
            $userRole->save();

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
            $data = User::findOrFail($inputs['company_id']);
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
