<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
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
            $data = User::with('ticket')
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
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже! ". $error->getMessage();
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
}
