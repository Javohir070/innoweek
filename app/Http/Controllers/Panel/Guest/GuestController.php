<?php

namespace App\Http\Controllers\Panel\Guest;

use App\DataTables\Guest\CheckersDataTable;
use App\DataTables\Guest\GuestDataTable;
use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Models\Regions\Country;
use App\Models\Regions\District;
use App\Models\Regions\Region;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserVisit;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GuestController extends Controller
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

    public function index(Request $request, GuestDataTable $dataTable)
    {
        $inputs = $request->all();
        $query = ['id' => null];
        $dataQuery[] = ['status', '=', 'active'];
        $dataQuery[] = ['user_type', '=', 5];
        if (isset($inputs['user_type']) && $inputs['user_type'] == 1) {
            //array_push($query , 'cooperation', true);
            $query['country_id'] = true;
            $dataQuery[] = ['country_id', '=', 1];
            //dd( $query);
        }
        if (isset($inputs['user_type']) && $inputs['user_type'] != 1) {
            //array_push($query , 'cooperation', true);
            $query['country_id'] = false;
            $dataQuery[] = ['country_id', '!=', 1];
            //dd( $query);
        }
        if (isset($inputs['profession_id']) && !empty($inputs['profession_id'])) {
            //array_push($query , 'cooperation', true);
            $query['profession_id'] = $inputs['profession_id'];
            $dataQuery[] = ['profession_id', '=', $inputs['profession_id']];
            //dd( $query);
        }

        if (isset($inputs['country_id']) && !empty($inputs['country_id'])) {
            //array_push($query , 'cooperation', true);
            $query['country'] = $inputs['country_id'];
            $dataQuery[] = ['country_id', '=', $inputs['country_id']];
            //dd( $query);
        }
        $professions = Profession::select('id', 'name_uz as title')->get();
        $countries = Country::select('id', 'name_uz as title')->get();
        $guest_count = User::where($dataQuery)->count();
        return $dataTable->with($query)->render('admin.guests.index', compact('inputs', 'guest_count', 'professions', 'countries'));
        //return view('admin.companies.index');
    }


    public function indexCheckers(Request $request, CheckersDataTable $dataTable)
    {
        $inputs = $request->all();
        $query = ['id' => null];
        $dataQuery[] = ['status', '=', 'active'];
        $dataQuery[] = ['user_type', '=', 5];
        if (isset($inputs['user_type']) && $inputs['user_type'] == 1) {
            //array_push($query , 'cooperation', true);
            $query['country_id'] = true;
            $dataQuery[] = ['country_id', '=', 1];
            //dd( $query);
        }
        if (isset($inputs['user_type']) && $inputs['user_type'] != 1) {
            //array_push($query , 'cooperation', true);
            $query['country_id'] = false;
            $dataQuery[] = ['country_id', '!=', 1];
            //dd( $query);
        }
        if (isset($inputs['profession_id']) && !empty($inputs['profession_id'])) {
            //array_push($query , 'cooperation', true);
            $query['profession_id'] = $inputs['profession_id'];
            $dataQuery[] = ['profession_id', '=', $inputs['profession_id']];
            //dd( $query);
        }

        if (isset($inputs['country_id']) && !empty($inputs['country_id'])) {
            //array_push($query , 'cooperation', true);
            $query['country'] = $inputs['country_id'];
            $dataQuery[] = ['country_id', '=', $inputs['country_id']];
            //dd( $query);
        }
        $professions = Profession::select('id', 'name_uz as title')->get();
        $countries = Country::select('id', 'name_uz as title')->get();
        $guest_count = User::where($dataQuery)->count();

        $val_count = User::where([['profession_id', 9]])->count();
        $enters_count = UserVisit::where([['status', 'enter']])->count();
        $exits_count = UserVisit::where([['status', 'exit']])->count();

        return $dataTable->with($query)->render('admin.guests.checkers', compact('inputs', 'guest_count', 'professions', 'countries', 'val_count', 'enters_count', 'exits_count'));
        //return view('admin.companies.checkers');
    }


    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = User::where('id', $dataID)->with('visits')->first();

        $countries = Country::select('id', 'name_uz as name')->where([['status', 'active']])->orderBy('id', 'ASC')->get();
        $professions = Profession::select('id', 'name_uz as name')->where([['status', 'active']])->orderBy('id', 'ASC')->get();

        return  view('admin.guests.addEditGuest', compact('data', 'professions', 'countries'));
    }


    public function storeData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = User::where('id', $inputs['id'])->first() ?? new User;
            $rules = [
                'first_name' => 'required|string|max:30', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'last_name' => 'required|string|max:30',
                'email' => 'string|max:30|unique' . !empty($inputs['id']) ? ':users,email,' . $inputs['id'] : '',
                'phone' => 'string|max:30|unique' . !empty($inputs['id']) ? ':users,phone,' . $inputs['id'] : '',
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

            $data->user_type = 5; //Mehmon turi
            $data->first_name = $inputs['first_name'];
            $data->last_name = $inputs['last_name'];
            $data->middle_name = $inputs['middle_name'];
            $data->organization = Str::upper($inputs['organization']);
            $data->profession_id = $inputs['profession_id'] ? preg_replace('/\s+/', '', $inputs['profession_id']) : null;
            $data->country_id = $inputs['country_id'];
            $data->gender = $inputs['gender'];
            $data->birth_date = isset($inputs['birth_date']) ? Carbon::parse($inputs['birth_date']) : null;
            $data->email = $inputs['email'] ?? null;
            $data->phone = $inputs['phone'] ?? null;
            $data->password = Hash::make("@innoGFuest@102$#!");
            $data->status = 'active';
            $data->confirmed = true;
            //$data->blocked = $inputs['blocked'];
            $data->save();

            $userRole = UserRole::find($data->id) ?? new UserRole;
            $userRole->user_id = $data->id;
            $userRole->x_roles_id = 8;
            $userRole->save();

            \Session::flash('success', trans("Ma'lumotlar saqlandi!"));
            return \Redirect::back();
        }
        catch (\Exception  $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }


    public function destroyData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = User::findOrFail($inputs['data_id']);
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
