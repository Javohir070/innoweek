<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ScienceIdController extends Controller
{
    public function getScienceId($scienceid)
    {
        $response = Http::withBasicAuth('PxNhTIvMGoVdUSFOsmfaVrc3fwb5HABmZ9Y4WLYb', '4JnUEYZ3rWBntf3Rxatl2bwQ8tepv06gmh5WkKCl0YNHc4C8I0wHms5oG4EkTvWz2wMAhqVliOTnZHwPXjKbv5jZufjEeS3WftD9hRPef7OclBUuesIixWKOSpus8zZm')
            ->get("https://api-id.ilmiy.uz/api/users/by-science-id/{$scienceid}");

        return response()->json([
            'status' => $response->status(),
            'success' => $response->successful(),
            'data' => $response->json()
        ]);
    }
}
