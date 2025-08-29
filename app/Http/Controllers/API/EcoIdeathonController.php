<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\GetDataCollection;
use App\Models\EcoIdeathon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;
use Auth;

class EcoIdeathonController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        try {
            $inputs = $request->all();
            $status = $inputs["status"] ?? 'pending';
            $limit = $inputs["limit"] ?? 10;

            $data = EcoIdeathon::with('region')->where('user_id', auth()->id())->where('status', $status)->paginate($limit);

            if (empty($data)) {
                $message = "Nimadir xato bajarildi! iltimos ma'lumotlarni qayta tekshirib ko'ring.";
                $error = "Data not found";
                return _sendError(404, $message, $error);
            }
            $message = "Data found";
            return response()->json(new GetDataCollection($data), 201);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
            return _sendError(402, $message, $error->getMessage());
        }
    }

    public function getAllEcoIdeathons(Request $request)
    {
        try {
            $inputs = $request->all();
            $status = $inputs["status"] ?? 'pending';
            $limit = $inputs["limit"] ?? 10;

            $data = EcoIdeathon::with('region')->where('status', $status)->paginate($limit);

            if (empty($data)) {
                $message = "Nimadir xato bajarildi! iltimos ma'lumotlarni qayta tekshirib ko'ring.";
                $error = "Data not found";
                return _sendError(404, $message, $error);
            }
            $message = "Data found";
            return response()->json(new GetDataCollection($data), 201);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
            return _sendError(402, $message, $error->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $ecoideathon = EcoIdeathon::find($id);
            if (empty($ecoideathon)) {
                $message = "Nimadir xato bajarildi! iltimos ma'lumotlarni qayta tekshirib ko'ring.";
                $error = "Data not found";
                return _sendError(404, $message, $error);
            }
            $message = "Data found";
            return response()->json(['status' => 200, 'message' => $message, 'data' => $ecoideathon->load('region')], 200);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
            return _sendError(402, $message, $error->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            $validatedData = [
                'region_id' => 'required|exists:regions,id',
                'full_name' => 'required|string|max:255',
                'age' => 'required|integer|min:0',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'project_name' => 'required|string|max:1000',
                'project_brief' => 'required|string',
                'project_goal' => 'required|string',
                'project_problem' => 'required|string',
                'implementation_plan' => 'required|string',
                'team_info' => 'required|string',
                'why_chosen' => 'required|string',
                'presentation' => 'required|file|mimes:pdf,ppt,pptx|max:10240',
            ];

            $validator = Validator::make($request->all(), $validatedData);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }

            if ($request->hasFile("presentation")) {
                $fileName = time() . '_' . $request->file('presentation')->getClientOriginalName();
                $filePath = $request->file('presentation')->storeAs('presentations', $fileName);
            }

            $ecoideathon = EcoIdeathon::create([
                'user_id' => auth()->user()->id,
                'region_id' => $request->input('region_id'),
                'full_name' => $request->input('full_name'),
                'age' => $request->input('age'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'project_name' => $request->input('project_name'),
                'project_brief' => $request->input('project_brief'),
                'project_goal' => $request->input('project_goal'),
                'project_problem' => $request->input('project_problem'),
                'implementation_plan' => $request->input('implementation_plan'),
                'team_info' => $request->input('team_info'),
                'why_chosen' => $request->input('why_chosen'),
                'presentation' => $filePath,
            ]);
            $message = "Data created successfully";
            return response()->json(['status' => 201, 'message' => $message, 'data' => $ecoideathon->load('region')], 201);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
            return _sendError(402, $message, $error->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = [
                'region_id' => 'nullable|exists:regions,id',
                'full_name' => 'nullable|string|max:255',
                'age' => 'nullable|integer|min:0',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'project_name' => 'nullable|string|max:1000',
                'project_brief' => 'nullable|string',
                'project_goal' => 'nullable|string',
                'project_problem' => 'nullable|string',
                'implementation_plan' => 'nullable|string',
                'team_info' => 'nullable|string',
                'why_chosen' => 'nullable|string',
                'presentation' => 'nullable|file|mimes:pdf,ppt,pptx|max:10240',
            ];

            if ($request->status == 'approved' || $request->status == 'rejected') {
                
                $validatedData['status'] = 'required|in:approved,rejected';
                $ecoideathon = EcoIdeathon::findOrFail($id);
                $ecoideathon->update($validatedData);

            } else {

                $validator = Validator::make($request->all(), $validatedData);
                if ($validator->fails()) {
                    return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
                }
                $ecoideathon = EcoIdeathon::findOrFail($id);

                if ($request->hasFile("presentation")) {
                    $fileName = time() . '_' . $request->file('presentation')->getClientOriginalName();
                    $filePath = $request->file('presentation')->storeAs('presentations', $fileName);

                    if ($ecoideathon->presentation && Storage::disk('public')->exists($ecoideathon->presentation)) {
                        Storage::disk('public')->delete($ecoideathon->presentation);
                    }
                }

                $ecoideathon->update([
                    'region_id' => $request->input('region_id') ?? $ecoideathon->region_id,
                    'full_name' => $request->input('full_name') ?? $ecoideathon->full_name,
                    'age' => $request->input('age') ?? $ecoideathon->age,
                    'phone' => $request->input('phone') ?? $ecoideathon->phone,
                    'email' => $request->input('email') ?? $ecoideathon->email,
                    'project_name' => $request->input('project_name') ?? $ecoideathon->project_name,
                    'project_brief' => $request->input('project_brief') ?? $ecoideathon->project_brief,
                    'project_goal' => $request->input('project_goal') ?? $ecoideathon->project_goal,
                    'project_problem' => $request->input('project_problem') ?? $ecoideathon->project_problem,
                    'implementation_plan' => $request->input('implementation_plan') ?? $ecoideathon->implementation_plan,
                    'team_info' => $request->input('team_info') ?? $ecoideathon->team_info,
                    'why_chosen' => $request->input('why_chosen') ?? $ecoideathon->why_chosen,
                    'presentation' => $filePath ?? $ecoideathon->presentation,
                ]);
                $message = "Data updated successfully";
            }

            return response()->json(['status' => 200, 'message' => $message, 'data' => $ecoideathon->load('region')], 200);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
            return _sendError(402, $message, $error->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $ecoideathon = EcoIdeathon::findOrFail($id);
            if ($ecoideathon->presentation && Storage::disk('public')->exists($ecoideathon->presentation)) {
                Storage::disk('public')->delete($ecoideathon->presentation);
            }
            $ecoideathon->delete();
            $message = "Data deleted successfully";
            return response()->json(['status' => 200, 'message' => $message], 200);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
            return _sendError(402, $message, $error->getMessage());
        }
    }
}
