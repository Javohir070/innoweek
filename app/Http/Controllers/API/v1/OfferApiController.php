<?php

namespace App\Http\Controllers\APi\v1;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class OfferApiController extends Controller
{
    public function storeOffer(Request $request)
    {
        try{
            // Validate the request data
            $validatedData = [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $validatedData);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }

            // Create a new offer
            $offer = Offer::create($request->toArray());

            // Return a response
            return response()->json([
                'message' => 'Offer created successfully',
                'success' => true,
                'offer' => $offer
                ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating offer', 'error' => $e->getMessage()], 500);
        }
    }
}
