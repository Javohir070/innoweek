<?php

namespace App\Http\Controllers;

use App\Models\Regions\Country;
use App\Models\Regions\District;
use App\Models\Regions\Region;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function getRegionsByCountryIdJSON(Request $request)
    {
        $data = Region::select('id', 'name_uz as name')->where('country_id', $request->country_id)->orderBy('name_uz', 'ASC')->get();
        return view('admin.components.json.ajaxRegionDataList', compact('data'));
    }

    public function getDistrictByRegionIdJSON(Request $request)
    {
        $data = District::select('id', 'name_uz as name')->where('region_id', $request->region_id)->orderBy('name_uz', 'ASC')->get();
        return view('admin.components.json.ajaxRegionDataList', compact('data'));
    }
}
