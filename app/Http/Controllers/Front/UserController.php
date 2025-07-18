<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\EventMember;
use App\Models\Profession;
use App\Models\Regions\Country;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private const _SMS_TOKEN = "c1ed1023-a481-4155-b892-11d5bd1bb145";

    public function SendSMSVerify($phone)
    {
        $token = self::_SMS_TOKEN;

        $verify_code = rand(100000, 999999);
        if (!empty($token)) {
            $smsBody = [
                'message' => [
                    'recipients' => ['998' . $phone]
                ],
                'priority' => "default",
                'sms' => [
                    'content' => "INNOWEEK.UZ saytidan ro'yxatdan o'tish uchun maxsus kod: " . $verify_code,
                ],
            ];
            $msgSend = Http::timeout(30)
                ->withOptions([
                    'verify' => false,
                ])
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    //'Authorization' => "Bearer " . $token,
                ])
                ->post("http://api.smsuz.uz/v1/sms/send?token=".$token, $smsBody)->object();

            if (isset($msgSend) && isset($msgSend->message_id)) {
                session([
                    'verifyCode' => $verify_code,
                ]);
                return true;
            }
            return false;
        }
        return false;
    }

    public function validateUserData(Request $request)
    {
        try {
            $inputs = $request->all();
            $rules = [
                'first_name' => 'required|string|max:30', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'last_name' => 'required|string|max:30',
                'email' => 'string|email|max:255|unique:users',
                'phone' => 'string|max:255|unique:users',
            ];

            $message = [
                'email.unique' => 'Ushbu elektron pochta allaqachon foydalanilgan.',
                'phone.unique' => 'Ushbu telefon allaqachon foydalanilgan.'
            ];

            $validator = Validator::make($request->all(), $rules, $message);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }

            if (isset($inputs['phone']) && strlen($inputs['phone']) > 9) {
                return _sendError(422, "Telefon raqamni 901234567 ko'rinishda kiriting!");
            }

            if (isset($inputs['phone']) && !empty($inputs['phone'])) {
                $sentSMS = self::SendSMSVerify($inputs['phone']);
                if ($sentSMS) {
                    return _sendResponse(201, 'tasdiqlash kodi yuborildi...');
                }
            }

            if (isset($inputs['email']) && !empty($inputs['email'])) {
                $verify_code = rand(100000, 999999);
                // Tasdiqlash kodini foydalanuvchiga email orqali yuborish
                Mail::to($inputs['email'])->send(new \App\Mail\RegisterMail($verify_code));
                session([
                    'verifyCode' => $verify_code,
                ]);
                return _sendResponse(201, 'tasdiqlash kodi yuborildi...');
            }
        } catch (\Exception  $ex) {
            return _sendError(500, "Xatolik yuz berdi", $ex);
        }
    }

    public function registerMember(Request $request)
    {
        try {
            $inputs = $request->all();
            $codeSession = session()->get('verifyCode');

            $dataQuery = [];
            if (isset($inputs['email']) && !empty($inputs['email'])) {
                $dataQuery[] = ['email', 'LIKE', '%' . $inputs['email'] . '%'];
            }
            else {
                $dataQuery[] = ['phone', 'LIKE', '%' . $inputs['phone'] . '%'];
            }
            
            $data = User::where($dataQuery)->first() ?? new User;
            $rules = [
                'first_name' => 'required|string|max:30', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'last_name' => 'required|string|max:30',
                'verify_code' => 'required|string|max:6|min:6',
            ];

            if (isset($inputs['verify_code']) && $inputs['verify_code'] != $codeSession) {
                return _sendError(422, "Tasdiqlash kodini xato kiritdingiz!");
            }

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
                //return \Redirect::back();
            }

            $data->user_type = 5; //Mehmon turi
            $data->first_name = $inputs['first_name'];
            $data->last_name = $inputs['last_name'];
            $data->organization = isset($inputs['organization']) && $inputs['organization'] ? Str::upper($inputs['organization']) : null;
            $data->profession_id = $inputs['profession_id'] ?? null;
            $data->country_id = $inputs['country_id'] ?? 1;
            $data->gender = $inputs['gender'] ?? null;
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

            $userticket = new UserTicket();
            $userticket->user_id = $data->id;
            $userticket->ticket_id = $data->id + 1000000;
            $userticket->archive_id = 7;
            $userticket->save();
            //Remove all data from session
            session()->flush();
            $userData = User::select('id', 'first_name', 'last_name', 'status')->with('ticket')->where([['id', $data->id]])->first();
            // if (!is_null($data->email)) {
            //     return redirect()->route('front.members.getTicket', ['data_id' => $userData->ticket->ticket_id]);
            // }
            return _sendResponse(201, "Ma'lumotlar saqlandi...", $userData);
            //return redirect()->route('front.members.getTicket', ['data_id' => $data->id]);
        } catch (\Exception  $ex) {
            return _sendError(500, "Xatolik yuz berdi! Iltimos qayta urunib ko'ring... ". $ex->getMessage(), $ex->getTrace());
            //dd($ex);
            //return \Redirect::back()->withErrors($ex->getMessage());
        }
    }


    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['data_id'] ?? null;
        $data = UserTicket::where('ticket_id', $dataID)->with('user')->first();

        $profession = Profession::select('id', 'name_uz as name')->where([['status', 'active'], ['id', $data->user->profession_id ?? null]])->first();

        return  view('front.users.userTicket', compact('data', 'profession'));
    }

    /**
     * Check user]s ticket
     */
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
            }
            else {
                return _sendError(404, "Ma'lumot topilmadi.");
            }

        } catch (\Exception  $ex) {
            return _sendError(500, "Xatolik yuz berdi", $ex->getMessage());
        }
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
                $userEvent = EventMember::where([['user_id', $userData->id], ['event_id', $inputs['event_id']]])->first();;
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
        } catch (\Exception  $ex) {
            return _sendError(500, "Xatolik yuz berdi", $ex->getMessage());
        }
    }
 
    
}
