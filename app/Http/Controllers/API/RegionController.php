<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Regions\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function getAllRegions()
    {
        $regions = Region::select('id', 'name_uz')->get();

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => $regions
        ]);
    }
}
