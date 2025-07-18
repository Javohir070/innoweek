<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Models\User;
use App\Models\UserTicket;
use App\Models\UserVisit;
//use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Http\Request;
use Auth;

class ApiController extends Controller
{

    public function checkTicket(Request $request)
    {
        $data = \Request::except(array('_token'));
        $inputs = $request->all();
        $dataID = $inputs['ticket_id'];

        $rule['ticket_id'] = 'required|string|max:255';

        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            $response = [
                'status' => 403,
                'success' => false,
                'message' => $validator->messages(),
            ];
            return response()->json($response, 403);
        }
        $ticket = UserTicket::select('u.id as user_id', 'user_tickets.id as ticket_id', 'u.first_name as first_name', 'u.last_name as last_name', 'u.created_at as registered_at')
            ->where('ticket_id', $dataID)
            ->leftJoin('users as u', 'user_tickets.user_id', '=', 'u.id')
            ->first();

        if ($ticket) {
            $response = [
                'status' => 201,
                'success' => true,
                'message' => "Ticket found on database",
                'data' => $ticket
            ];
            return response()->json($response, 201);
        }
        $response = [
            'status' => 404,
            'success' => false,
            'message' => "Data not found, try again",
        ];
        return response()->json($response, 404);
    }

    public function approveTicket(Request $request)
    {
        $data = \Request::except(array('_token'));
        $inputs = $request->all();
        $dataID = $inputs['ticket_id'];
        $dataStatus = isset($inputs['status']) && $inputs['status'] == 2 ? "exit" : "enter";

        $checkerUser = auth('sanctum')->user();

        $rule['ticket_id'] = 'required|string|max:255';

        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            $response = [
                'status' => 403,
                'success' => false,
                'message' => $validator->messages(),
            ];
            return response()->json($response, 403);
        }

        $ticket = UserTicket::where('id', $dataID)->first();
        if ($ticket) {
            $visited = new UserVisit;
            $visited->user_id = 1;
            $visited->ticket_id = $ticket->id;
            $visited->checker_id = $checkerUser->id ?? null;
            $visited->status = $dataStatus;
            $visited->save();
            $response = [
                'status' => 201,
                'success' => true,
                'message' => "Data saved successfully",
                'data' => $ticket
            ];
            return response()->json($response, 201);
        }
        $response = [
            'status' => 404,
            'success' => false,
            'message' => "Data not found, try again",
        ];
        return response()->json($response, 404);
    }

    public function loginChecker(Request $request)
    {
        try {
            $inputs = $request->all();

            $rules = [
                'phone_or_email' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL) && !preg_match('/^9\d{8}$/', $value)) {
                            $fail($attribute . ' maydoni to\'g\'ri email yoki telefon raqam formatida bo\'lishi kerak.');
                        }
                    }
                ],
                //'auth_key' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }

            // Email yoki telefon ekanligini tekshirish
            $phoneOrEmail = $inputs['phone_or_email'];
            // Foydalanuvchini telefon orqali qidirish
            $data = User::select('users.id as id', 'first_name', 'last_name', 'users.status as status')
                ->where([['phone', $phoneOrEmail], ['profession_id', 9]])
                ->first();

            if ($data) {
                $token = $data->createToken('auth_token')->plainTextToken;

                return _sendResponse(200, 'Successfully logged', [
                    'access_token' => $token,
                    'token_type' => 'Bearer'
                ]);
            }
            return _sendError(419, "Foydalanuvchi topilmadi yoki foydalanuvchi valyantor emas!");

        } catch (\Exception $ex) {
            return _sendError(500, "Xatolik yuz berdi." . $ex->getMessage(), $ex->getTrace());
        }
    }

    /**
     * GET CURRENT USER INFO
     */
    public function GetUserInfo(Request $request)
    {
        try {
            $user = auth('sanctum')->user();
            if (!$user) {
                $message = "Data not found";
                return _sendError(404, $message);
            }
            $message = "Data found";
            return _sendResponse(201, $message, $user);

        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже! " . $error->getMessage();
            return _sendError(402, $message, $error->getTrace());
        }
    }

    public function checkUserTicket(Request $request)
    {
        try {
            $inputs = $request->all();
            //$inputs = \Request::except(array('_token'));

            $rules = [
                'phone_or_email' => 'required|string|max:60', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }
            $query = [];
            $query[] = ['status', 'active'];

            $contains = Str::contains($inputs['phone_or_email'], ['@']);
            if ($contains) {
                $inputs['email'] = $inputs['phone_or_email'];
                unset($inputs['phone_or_email']);
                $query[] = ['email', $inputs['email']];
            } else {
                if (isset($inputs['phone_or_email']) && strlen($inputs['phone_or_email']) > 9) {
                    return _sendError(422, "Telefon raqamni 901234567 ko'rinishda kiriting!");
                }
                $inputs['phone'] = Str::substr($inputs['phone_or_email'], -9);
                unset($inputs['phone_or_email']);
                $query[] = ['phone', $inputs['phone']];
            }

            $userData = User::select("id", 'first_name', 'last_name', 'status')->with('ticket')->where($query)->first();
            if (!empty($userData)) {
                return _sendResponse(201, "Ma'lumot mavjud...", $userData);
            } else {
                return _sendError(404, "Ma'lumot topilmadi.");
            }

        } catch (\Exception $ex) {
            return _sendError(500, "Xatolik yuz berdi", $ex->getMessage());
        }
    }

    public function getMemberTicket(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = UserTicket::where('ticket_id', $dataID)->with('user')->first();

        $profession = Profession::select('id', 'name_uz as name')->where([['status', 'active'], ['id', $data->user->profession_id ?? null]])->first();

        if (!empty($userData)) {
            return _sendResponse(201, "Ma'lumot mavjud...", [$userData, $profession]);
        } else {
            return _sendError(404, "Ma'lumot topilmadi.");
        }

        // return  view('front.users.userTicket', compact('data', 'profession'));
    }
}
