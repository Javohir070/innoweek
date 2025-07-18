<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;

class CertificateController extends Controller
{
    private const _TG_TOKEN = "Csdae@_dsadae!fre345#axdAs1247@97!#";

    public function getCerf()
    {
        $data = [
            'imagePath'     => public_path('/certificate/qr-code/ticket_id.jpg'),
            'full_name'     => "Muhammadjonov Muhammadali", //$ticket->last_name . " " . $ticket->first_name,
            'qrCode'        => \QrCode::format('png')->size(240)->generate(url('/') . "/certificate/pdf/ticket_code.pdf", '../public/certificate/qr-code/ticket_id.jpg'),
            'date' => Carbon::parse("14.11.2024")->format('d.m.Y'),
        ];
        //$customPaper = [0, 0, 841, 593];
        //$pdf = 
        PDF::loadView('front.certificates.certificate', $data)
        ->setPaper('a4', 'landscape')->save(public_path("/certificate/pdf/ticket_code.pdf"));
        //return $pdf->stream('resume.pdf');
        return redirect("/certificate/pdf/ticket_code.pdf");
    }

    public function checkUserCertificate(Request $request)
    {
        try {
            $inputs = $request->all();

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

            $userData = User::select("id", 'first_name', 'last_name', 'profession_id', 'status')->with('profession')->with('ticket')->with('visit')->with('visitExit')->where($query)->first();

            if (empty($userData)) {
                return _sendError(404, "Ma'lumot topilmadi.");
            }
            if (!isset($userData->visit->created_at)) {
                return _sendError(404, "Siz tadbirda ishtirok etmagansiz.", $userData);
            }

            $data = [
                'imagePath'     => public_path('/certificate/qr-code/'. $userData->ticket->ticket_id. '.jpg'),
                'full_name'     => $userData->last_name . " " . $userData->first_name,
                'profession_name'     => isset($userData->profession->name_uz) ? $userData->profession->name_uz : "Boshqa",
                'ticketCode'     => $userData->ticket->ticket_id,
                'qrCode'        => \QrCode::format('png')->size(240)->generate(url('/') ."/certificate/pdf/" . $userData->ticket->ticket_id . ".pdf", '../public/certificate/qr-code/' . $userData->ticket->ticket_id . '.jpg'),
                'date' => Carbon::parse($userData->visit->created_at)->format('d/m/Y'),
                'date_exit' => isset($userData->visitExit->created_at) ? Carbon::parse($userData->visitExit->created_at)->format('d/m/Y') : null,
                'enter_day' => Carbon::parse($userData->visit->created_at)->format('d'),
                'exit_day' => isset($userData->visitExit->created_at) ? Carbon::parse($userData->visitExit->created_at)->format('d') : null,
            ];


            //$customPaper = [0, 0, 841, 593];
            //$pdf = 
            PDF::loadView('front.certificates.certificate', $data)
            ->setPaper('a4', 'landscape')->save(public_path('/certificate/pdf/'. $userData->ticket->ticket_id . '.pdf'));
            //return $pdf->stream('resume.pdf');
            //return redirect("/certificate/pdf/". $userData->ticket->ticket_id .".pdf");
            $pdfData = [
                'file_path' => "/certificate/pdf/" . $userData->ticket->ticket_id . ".pdf"
            ];
            return _sendResponse(201, "Sertifikat mavjud...", $pdfData);

        } catch (\Exception  $ex) {
            return _sendError(500, "Xatolik yuz berdi", $ex->getMessage());
        }
    }

    public function checkUserCertificateTelegram(Request $request)
    {
        try {
            $inputs = $request->all();

            $rules = [
                'token_key' => 'required|string|max:60', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
                'phone_or_email' => 'required|string|max:60', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return _sendError(422, "Ma'lumotlarda xatolik mavjud", $validator->messages());
            }
            if (self::_TG_TOKEN != $inputs['token_key']) {
                return _sendError(419, "Foydalanuvchi kalit mos kelmadi");
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

            $userData = User::select("id", 'first_name', 'last_name', 'status')->with('ticket')->with('visit')->where($query)->first();
            if (empty($userData)) {
                return _sendError(404, "Ma'lumot topilmadi.");
            }
            if (!isset($userData->visit->created_at)) {
                return _sendError(404, "Siz tadbirda ishtirok etmagansiz.");
            }

            $data = [
                'imagePath'     => public_path('/certificate/qr-code/' . $userData->ticket->ticket_id . '.jpg'),
                'full_name'     => $userData->last_name . " " . $userData->first_name,
                'qrCode'        => \QrCode::format('png')->size(240)->generate(url('/') . "/certificate/pdf/". $userData->ticket->ticket_id .".pdf", '../public/certificate/qr-code/' . $userData->ticket->ticket_id . '.jpg'),
                'date' => Carbon::parse($userData->visit->created_at)->format('d/m/Y'),
            ];
            //$customPaper = [0, 0, 841, 593];
            //$pdf = 
            PDF::loadView('front.certificates.certificate', $data)
                ->setPaper('a4', 'landscape')->save(public_path('/certificate/pdf/' . $userData->ticket->ticket_id . '.pdf'));
            //return $pdf->stream('resume.pdf');
            //return redirect("/certificate/pdf/". $userData->ticket->ticket_id .".pdf");
            $pdfData = [
                'file_path' => url('/')."/certificate/pdf/" . $userData->ticket->ticket_id . ".pdf"
            ];
            return _sendResponse(201, "Sertifikat mavjud...", $pdfData);
        } catch (\Exception  $ex) {
            return _sendError(500, "Xatolik yuz berdi", $ex->getMessage());
        }
    }
}
