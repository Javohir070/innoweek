<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Carbon\Carbon;
use App\Http\Resources\GetDataCollection;
use App\Models\Inno\Speaker;

class SpeakersAPIController extends Controller
{

    /***
     * GET BY ID
     * @var ID = INT
     */
    public function GetAllSpeakers(Request $request)
    {
        try {
            $inputs = $request->all();
            $status = $inputs["status"] ?? 'active';
            $lang = $inputs["lang"] ?? 'uz';
            $ArchiveID = $inputs["archive_id"] ?? 7;
            $limit = $inputs["limit"] ?? 10;
            $data = Speaker::select('full_name_' . $lang . ' as full_name', 'job_' . $lang . ' as position', 'image', 'created_at')
                //->with('author')
                ->where([
                    ['status', $status],
                    ['archive_id', $ArchiveID],
                ])->orderBy('id', 'ASC')
                ->paginate($limit);

            if (empty($data)) {
                $message = "Nimadir xato bajarildi! iltimos ma'lumotlarni qayta tekshirib ko'ring.";
                $error = "Data not found";
                return _sendError(404, $message, $error);
            }
            $message = "Data found";
            return response()->json(new GetDataCollection($data), 201);
            //return _sendResponse(201, $message, $data);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
            return _sendError(402, $message, $error->getMessage());
        }
    }
}
