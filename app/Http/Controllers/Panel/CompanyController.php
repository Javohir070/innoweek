<?php

namespace App\Http\Controllers\Panel;

use App\DataTables\Projects\CompanyDataTable;
use App\Http\Controllers\Controller;
use App\Models\Regions\Country;
use App\Models\Regions\District;
use App\Models\Regions\Region;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanyController extends Controller
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

    public function index(Request $request, CompanyDataTable $dataTable)
    {

        if (Auth::user()->hasRole('region-admin') && !isset($inputs['region_id'])) {
            $inputs = $request->all();
            return view('panel.pages.dashRegion', compact('districtStat', 'regionData', 'farmers_count', 'area_count', 'district_count'));
            //return redirect()->route('panel.farmers.index', ['region_id' => Auth::user()->region_id]);
        }
        $inputs = $request->all();
        $company_count = User::where([['user_type', 4], ['status', 'active']])->count();
        return $dataTable->render('admin.companies.index', compact('company_count'));
        //return view('admin.companies.index');
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function CompanyInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['company_id'] ?? null;
        $data = User::where('id', $dataID)->first();

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

        return  view('admin.companies.addEditCompany', compact('data', 'regions', 'districts', 'countries'));
    }

    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = User::where('id', $inputs['id'])->first() ?? new User;
            $rules = [
                'first_name' => 'required|string|max:30', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'last_name' => 'required|string|max:30',
                'company_name' => 'required|string|max:255',
                //'company_inn' => 'required',
                //'region_id' => 'required',
                'company_inn' => 'required|string|max:30|unique' . !empty($inputs['company_inn']) ? ':users,company_inn,' . $inputs['id'] : '',
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

            //Company
            $companyLogoPath = '/upload/companies/';
            $companyLogoFile = $request->file('company_logo');
            if ($companyLogoFile) {
                $fileName = $companyLogoPath . time() . '_' . $companyLogoFile->getClientOriginalName();
                $companyLogoFile->move(public_path() . $companyLogoPath, $fileName);
                $data->company_logo = $fileName;
            }
            $data->user_type = 4;
            $data->first_name = $inputs['first_name'];
            $data->last_name = $inputs['last_name'];
            $data->middle_name = $inputs['middle_name'];
            $data->company_name = Str::upper($inputs['company_name']);
            $data->company_inn = preg_replace('/\s+/', '', $inputs['company_inn']);
            $data->pinfl = $inputs['pinfl'] ? preg_replace('/\s+/', '', $inputs['pinfl']) : null;
            $data->passport_serial = Str::upper($inputs['passport_serial']) ?? null;
            $data->passport_number = $inputs['passport_number'] ?? null;
            $data->address = $inputs['address'] ?? null;
            $data->country_id = $inputs['country_id'];
            $data->region_id = $inputs['region_id'];
            $data->district_id = $inputs['district_id'] ?? null;
            $data->email = $inputs['email'];
            $data->phone = $inputs['phone'] ?? "";
            $data->username = $inputs['username'] ?? null;

            if (isset($inputs['password']) && !empty($inputs['password'])) {
                $data->password = Hash::make($inputs['password']);
            }

            $data->status = 'active';
            $data->confirmed = true;
            //$data->blocked = $inputs['blocked'];
            $data->save();

            $userRole = UserRole::find($data->id) ?? new UserRole;
            $userRole->user_id = $data->id;
            $userRole->x_roles_id = 7;
            $userRole->save();

            \Session::flash('success', trans("Ma'lumotlar saqlandi!"));
            return \Redirect::back();
        } 
        // catch (\Illuminate\Validation\ValidationException $ve) {
        //     dd($ve);
        // }
        catch(\Illuminate\Database\QueryException $qe) {
            $errorCode = $qe->errorInfo[1];
            switch ($errorCode) {
                case 1062: //code dublicate entry 
                    \Session::flash('warning', "Siz bir xil email yoki STIR kirityapsiz. Iltimos kiritilayotgan ma'lumotlarda unikal ma'lumot kiriting! Tashkilot elektron pochtasi uchun tashkilot_nomi@innoweek.uz kabi ko'rinishda kiriting!");
                    return \Redirect::back();
                    break;
                default:
                    \Session::flash('warning', "Kiritilgan ma'lumotlarda xatolik mavjud iltimos tekshirib qayta urunib ko'ring!");
                    return \Redirect::back();
                    break;
            }
        }
        catch (\Exception  $ex) {
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
