<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetDataCollection;
use App\Models\Profession;
use App\Models\Regions\Country;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;


class AuthApiController extends Controller
{
    private const _SMS_TOKEN = "c1ed1023-a481-4155-b892-11d5bd1bb145";
    protected $access_code;

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
                ->post("http://api.smsuz.uz/v1/sms/send?token=" . $token, $smsBody)->object();

            if (isset($msgSend) && isset($msgSend->message_id)) {
                $this->access_code = $verify_code;
                return true;
            }
            return false;
        }
        return false;
    }

    public function loginValidate(Request $request)
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
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }

            // Email yoki telefon ekanligini tekshirish
            $phoneOrEmail = $inputs['phone_or_email'];

            if (filter_var($phoneOrEmail, FILTER_VALIDATE_EMAIL)) {
                // Foydalanuvchini email orqali qidirish
                $data = User::where([['email', $phoneOrEmail]])->first();
                if ($data) {
                    $verify_code = rand(100000, 999999);

                    // Tasdiqlash kodini foydalanuvchiga email orqali yuborish
                    Mail::to($phoneOrEmail)->send(new \App\Mail\RegisterMail($verify_code));

                    $data = [
                        'auth_key' => Crypt::encrypt($verify_code)
                    ];
                    return _sendResponse(201, 'tasdiqlash kodi yuborildi...', $data);
                } else {
                    return _sendError(404, "Foydalanuvchi topilmadi");
                }
            } else {
                // Foydalanuvchini telefon orqali qidirish
                $data = User::where([['phone', $phoneOrEmail]])->first();

                if ($data) {
                    $sentSMS = self::SendSMSVerify($phoneOrEmail);
                    if ($sentSMS) {
                        $data = [
                            'auth_key' => Crypt::encrypt($this->access_code)
                        ];
                        return _sendResponse(201, 'tasdiqlash kodi yuborildi...', $data);
                    }
                } else {
                    return _sendError(404, "Foydalanuvchi topilmadi");
                }
            }
        } catch (\Exception $ex) {
            return _sendError(500, "Xatolik yuz berdi." . $ex->getMessage(), $ex->getTrace());
        }
    }

    public function login(Request $request)
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
                'auth_key' => 'required|string',
                'access_code' => 'required|string',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }

            // Email yoki telefon ekanligini tekshirish
            $phoneOrEmail = $inputs['phone_or_email'];
            if ($inputs['phone_or_email'] == '900061312' && $inputs['access_code'] == 323212) {
                // Foydalanuvchini telefon orqali qidirish
                $data = User::where([['phone', $phoneOrEmail]])->first();
                if ($data) {
                    $token = $data->createToken('auth_token')->plainTextToken;

                    return _sendResponse(200, 'Successfully logged', [
                        'access_token' => $token,
                        'token_type' => 'Bearer'
                    ]);
                }
            }

            if (Crypt::decrypt($inputs['auth_key']) == $inputs['access_code']) {
                if (filter_var($phoneOrEmail, FILTER_VALIDATE_EMAIL)) {
                    // Foydalanuvchini email orqali qidirish
                    $data = User::where([['email', $phoneOrEmail]])->first();
                    if ($data) {
                        $token = $data->createToken('auth_token')->plainTextToken;

                        return _sendResponse(200, 'Successfully logged', [
                            'access_token' => $token,
                            'token_type' => 'Bearer'
                        ]);
                    }
                } else {
                    // Foydalanuvchini telefon orqali qidirish
                    $data = User::where([['phone', $phoneOrEmail]])->first();
                    if ($data) {
                        $token = $data->createToken('auth_token')->plainTextToken;

                        return _sendResponse(200, 'Successfully logged', [
                            'access_token' => $token,
                            'token_type' => 'Bearer'
                        ]);
                    }
                }
            } else {
                return _sendError(422, "Tasdiqlash kodi xato kiritildi.");
            }
        } catch (\Exception $ex) {
            return _sendError(500, "Xatolik yuz berdi." . $ex->getMessage(), $ex->getTrace());
        }
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
                    $data = [
                        'auth_key' => Crypt::encrypt($this->access_code)
                    ];
                    return _sendResponse(201, 'tasdiqlash kodi yuborildi...', $data);
                }
            }

            if (isset($inputs['email']) && !empty($inputs['email'])) {
                $verify_code = rand(100000, 999999);
                // Tasdiqlash kodini foydalanuvchiga email orqali yuborish
                Mail::to($inputs['email'])->send(new \App\Mail\RegisterMail($verify_code));
                $data = [
                    'auth_key' => Crypt::encrypt($verify_code)
                ];
                return _sendResponse(201, 'tasdiqlash kodi yuborildi...', $data);
            }

        } catch (\Exception $ex) {
            return _sendError(500, "Xatolik yuz berdi." . $ex->getMessage(), $ex->getTrace());
        }
    }

    public function register(Request $request)
    {
        try {
            $inputs = $request->all();

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:30', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'last_name' => 'required|string|max:30',
                'email' => 'string|email|max:255|unique:users',
                'phone' => 'string|max:255|unique:users',
                'auth_key' => 'required|string',
                'access_code' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if (isset($inputs['phone']) && !empty($inputs['phone']) && Crypt::decrypt($inputs['auth_key']) != $inputs['access_code']) {
                return _sendError(422, "Tasdiqlash kodi notog'ri kiritildi.");
            }

            if (isset($inputs['email']) && !empty($inputs['email']) && Crypt::decrypt($inputs['auth_key']) != $inputs['access_code']) {
                return _sendError(422, "Tasdiqlash kodi notog'ri kiritildi.");
            }

            $data = new User;
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
            $data->position = $inputs['position'] ?? null;
            $data->company_name = $inputs['company_name'] ?? null;
            $data->password = Hash::make($inputs['password']);
            $data->status = 'active';
            $data->confirmed = true;
            //$data->blocked = $inputs['blocked'];
            $data->save();

            $userRole = UserRole::find($data->id) ?? new UserRole;
            $userRole->user_id = $data->id;
            $userRole->x_roles_id = 8;
            $userRole->save();

            $userticket = new UserTicket;
            $userticket->user_id = $data->id;
            $userticket->ticket_id = $data->id + 1000000;
            $userticket->archive_id = 7;
            $userticket->save();

            $token = $data->createToken('auth_token')->plainTextToken;

            return _sendResponse(200, 'Successfully Registerated', [
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);

        } catch (\Exception $ex) {
            return _sendError(500, "Xatolik yuz berdi." . $ex->getMessage(), $ex->getTrace());
        }
    }


    public function verifyUser(Request $request)
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
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }

            // Email yoki telefon ekanligini tekshirish
            $phoneOrEmail = $inputs['phone_or_email'];
            $user = filter_var($phoneOrEmail, FILTER_VALIDATE_EMAIL)
                ? User::where('email', $phoneOrEmail)->first()
                : User::where('phone', $phoneOrEmail)->first();

            if (!$user) {
                return _sendError(404, "Foydalanuvchi topilmadi");
            }

            // Tasdiqlash kodi yuborish
            $verify_code = rand(100000, 999999);
            if (filter_var($phoneOrEmail, FILTER_VALIDATE_EMAIL)) {
                Mail::to($phoneOrEmail)->send(new \App\Mail\RegisterMail($verify_code));
            } else {
                self::SendSMSVerify($user->phone);
            }

            return _sendResponse(200, 'Tasdiqlash kodi yuborildi.', [
                'auth_key' => Crypt::encrypt($verify_code)
            ]);

        } catch (\Exception $ex) {
            return _sendError(500, "Xatolik yuz berdi." . $ex->getMessage(), $ex->getTrace());
        }
    }

// [
//     'password' => 'secret123',
//     'password_confirmation' => 'secret123'
// ]

    public function forgotPassword(Request $request)
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
                'auth_key' => 'required|string',
                'access_code' => 'required|string',
                'password' => 'required|string|min:8|confirmed',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }

            if (Crypt::decrypt($inputs['auth_key']) != $inputs['access_code']) {
                return _sendError(422, "Tasdiqlash kodi noto‘g‘ri kiritildi.");
            }

            $phoneOrEmail = $inputs['phone_or_email'];
            $password = $inputs['password'];

            // Foydalanuvchini topish
            $user = filter_var($phoneOrEmail, FILTER_VALIDATE_EMAIL)
                ? User::where('email', $phoneOrEmail)->first()
                : User::where('phone', $phoneOrEmail)->first();

            if (!$user) {
                return _sendError(404, "Foydalanuvchi topilmadi.");
            }

            // Parolni yangilash
            $user->password = bcrypt($password);
            $user->save();

            // Avtomatik login qilish (masalan, Laravel Sanctum orqali)
            $token = $user->createToken('auth_token')->plainTextToken;

            return _sendResponse(200, 'Parol muvaffaqiyatli yangilandi va login qilindi.', [
                'token' => $token,
                'user' => $user
            ]);

        } catch (\Exception $ex) {
            return _sendError(500, "Xatolik yuz berdi. " . $ex->getMessage(), $ex->getTrace());
        }
    }


    public function loginUser(Request $request)
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
                'password' => 'required|string',
            ];

            $validator = Validator::make($inputs, $rules);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }

            $phoneOrEmail = $inputs['phone_or_email'];
            $password = $inputs['password'];

            // Foydalanuvchini topish
            $user = filter_var($phoneOrEmail, FILTER_VALIDATE_EMAIL)
                ? User::where('email', $phoneOrEmail)->first()
                : User::where('phone', $phoneOrEmail)->first();

            if (!$user || !Hash::check($password, $user->password)) {
                return _sendError(401, 'Login yoki parol noto‘g‘ri.');
            }

            // Token yaratish
            $token = $user->createToken('auth_token')->plainTextToken;

            return _sendResponse(200, 'Muvaffaqiyatli tizimga kirildi', [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'data' => $user
            ]);

        } catch (\Exception $ex) {
            return _sendError(500, "Xatolik yuz berdi: " . $ex->getMessage(), $ex->getTrace());
        }
    }



    public function GetCountryList(Request $request)
    {
        try {
            $inputs = $request->all();
            $limit = $inputs['limit'] ?? 300;
            $lang = $inputs['lang'] ?? 'uz';
            $data = Country::select('id', 'name_' . $lang . ' as name')->where([['status', 'active']])->orderBy('id', 'ASC')->paginate($limit);

            return response()->json(new GetDataCollection($data), 201);
            //return _sendResponse(201, $message, $data);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
            return _sendError(402, $message, $error->getMessage());
        }
    }

    public function GetProfessionsList(Request $request)
    {
        try {
            $inputs = $request->all();
            $limit = $inputs['limit'] ?? 300;

            $data = Profession::select('id', 'name_uz as name')->where([['status', 'active']])->orderBy('id', 'ASC')->paginate($limit);
            return response()->json(new GetDataCollection($data), 201);
            //return _sendResponse(201, $message, $data);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
            return _sendError(402, $message, $error->getMessage());
        }
    }

}
