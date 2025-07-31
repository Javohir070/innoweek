<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\EventMember;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * GET CURRENT USER INFO
     */
    public function GetUserInfo(Request $request)
    {
        try {
            $dataID = Auth::user()->id;
            $data = User::with('ticket', 'country','profession')
                ->where('id', $dataID)->first();
            //$data = User::findOrFail($dataID)->leftJoin('user_roles ur', 'ur.user_id', '=', 'users.id');
            if (empty($data)) {
                $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
                $error = "Data not found";
                return _sendError(404, $message, $error);
            }

            $message = "Data found";
            return _sendResponse(201, $message, $data);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже! " . $error->getMessage();
            return _sendError(402, $message, $error);
        }
    }


    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'You have successfully logged out and the token was successfully deleted',
        ];
    }



    public function ChangePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return _sendError(422, "Ma'lumotlarda xatolik bor", $validator->messages());
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return _sendError(401, "Joriy parol noto‘g‘ri.");
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return _sendResponse(200, "Parol muvaffaqiyatli o‘zgartirildi.");
    }


    public function storeEventMember(Request $request)
    {
        try {
            $inputs = $request->all();
            //$inputs = \Request::except(array('_token'));

            $rules = [
                'phone_or_email' => 'required|string|max:60', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'event_id' => 'required', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
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
                $userEvent = EventMember::where([['user_id', $userData->id], ['event_id', $inputs['event_id']]])->first();
                ;
                if (!empty($userEvent)) {
                    return _sendError(422, trans("site.Registration.You already registered"));
                }

                $userEvent = new EventMember;
                $userEvent->user_id = $userData->id;
                $userEvent->event_id = $inputs['event_id'];
                $userEvent->save();

                return _sendResponse(201, "Ma'lumotlar saqlandi.", $userData);
            } else {
                return _sendError(404, trans("site.Registration.Please register first"));
            }
        } catch (\Exception $ex) {
            return _sendError(500, "Xatolik yuz berdi", $ex->getMessage());
        }
    }
}
