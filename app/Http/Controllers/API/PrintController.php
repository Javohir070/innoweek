<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Models\UserTicket;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Validator;
use PDF;

class PrintController extends Controller
{

    public function register(Request $request)
    {
        try {
            $data = \Request::except(array('_token'));
            $inputs = $request->all();
            $rule = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone_or_email' => 'required|string|max:30',
                //'email' => 'required|string|email|max:255|unique:users',
                //'password' => 'required|string|min:8',
            ];

            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                $response = [
                    'status' => 402,
                    'success' => false,
                    'message' => "Kiritilgan ma'lumotlarda xatolik mavjud!",
                ];
                return response()->json($response, 402);
            }
            $contains = Str::contains($inputs['phone_or_email'], ['@']);
            if ($contains) {
                $qWhere = ['email', $inputs['phone_or_email']];
            }
            else {
                $qWhere = ['phone', $inputs['phone_or_email']];
                if (isset($inputs['phone_or_email']) && strlen($inputs['phone_or_email']) > 9) {
                    $response = [
                        'status' => 402,
                        'success' => false,
                        'message' => "Telefon raqamni 901234567 ko'rinishda kiriting!",
                    ];
                    return response()->json($response, 402);
                }
            }
        
            $user = User::where([$qWhere])->first() ?? new User;
            $user->first_name = $inputs['first_name'];
            $user->last_name = $inputs['last_name'];
            $user->email = $contains ? $inputs['phone_or_email'] : null;
            $user->phone = !$contains ? $inputs['phone_or_email'] : null;
            $user->gender = $inputs['gender'] ?? 1;
            $user->country_id = $request->has('country_id') && $inputs['country_id'] ? $inputs['country_id'] : null;
            $user->country_name = $request->has('country_name') && $inputs['country_name'] ? $inputs['country_name'] : "Uzbekistan";
            $user->profession_id = $request->has('profession_id') && $inputs['profession_id'] ? $inputs['profession_id'] : null;
            $user->organization = $request->has('organization') && $inputs['organization'] ? $inputs['organization'] : null;
            $user->birth_date = Carbon::parse(Carbon::now());
            $user->password = Hash::make(Str::random(12));
            $user->save();

            $userRole = UserRole::find($user->id) ?? new UserRole;
            $userRole->user_id = $user->id;
            $userRole->x_roles_id = 8;
            $userRole->save();

            $userticket = UserTicket::where('user_id', $user->id)->first() ??   new UserTicket;
            if (!isset($userticket->id)) {
                $userticket->user_id = $user->id;
                $userticket->ticket_id = $user->id + 1000000;
                $userticket->archive_id = 7;
                $userticket->save();
            }

            $data = [
                'imagePath'    => public_path('/print/qr-code/' . $userticket->ticket_id . '.jpg'),
                'full_name'         => Str::upper($user->last_name) . "\n" . Str::upper($user->first_name),
                'qrCode'      => \QrCode::format('png')->size(450)->generate(route('front.members.getTicket', ['data_id' =>  $userticket->ticket_id]), '../public/print/qr-code/' . $userticket->ticket_id . '.jpg'),
            ];
            //$pdf = PDF::loadView('frontend.cerf', $data);
            $customPaper = [0, 0, 300, 570];
            
            PDF::loadView('front.certificates.print', $data)
                ->setPaper($customPaper, 'landscape')
                ->save(public_path("/print/pdf/{$userticket->ticket_id}.pdf"));

            $response = [
                'status' => 201,
                'success' => true,
                'message' => "Success",
                'data' => $user,
                'badge_path' => url("/") . "/print/pdf/{$userticket->ticket_id}.pdf",
                'badge_name' => "{$userticket->ticket_id}.pdf"
            ];
            return response()->json($response, 201);
        } catch (\Exception $ex) {
            $response = [
                'status' => 401,
                'success' => false,
                'message' => "Ma'lumotlarni saqlashda xatolik yuz berdi.". $ex->getMessage(),
                'error' => $ex->getTrace()
            ];
            return response()->json($response, 401);
        }
    }
}
