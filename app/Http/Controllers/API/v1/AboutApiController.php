<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\About\About;
use App\Models\News\InnoGallery;
use App\Models\Profession;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Carbon\Carbon;
use App\Http\Resources\GetDataCollection;
use App\Models\Inno\LiveVideos;
use App\Models\Inno\Schedule;

class AboutApiController extends Controller
{

    /***
     * GET BY ID
     * @var ID = INT
     */
    public function GetAbout(Request $request)
    {
        try {
            $inputs = $request->all();
            $status = $inputs["status"] ?? 'active';
            $lang = $inputs["lang"] ?? 'uz';
            $data = About::select('description_' . $lang . ' as description', 'image', 'file_1', 'file_2', 'created_at')
                ->where([
                    ['status', $status],
                ])->paginate(1);

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

    /***
     * GET BY ID
     * @var ID = INT
     */
    public function GetSchedulesDays(Request $request)
    {
        try {
            $inputs = $request->all();
            $status = $inputs["status"] ?? 'active';
            $lang = $inputs["lang"] ?? 'uz';
            $archive_id = $inputs["archive_id"] ?? 'uz';
            $data = Schedule::select('date')
                ->where([
                    ['archive_id', $archive_id],
                    ['status', $status],
                ])->groupBy('date')->paginate(10);

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

    public function GetScheduleListByDate(Request $request)
    {
        try {
            $inputs = $request->all();

            $status = $inputs["status"] ?? 'active';
            $lang = $inputs["lang"] ?? 'uz';
            $archive_id = $inputs["archive_id"] ?? 7;
            $date = $inputs["date"] ?? null;

            $data = Schedule::select('id', 'title_' . $lang . ' as title', 'description_' . $lang . ' as description', 'date', 'address_' . $lang . ' as address', 'started_at', 'stopped_at')
                ->where([['archive_id', $archive_id], ['status', $status]])->orderBy('started_at', 'ASC')
                ->whereDate('date', '=', \Carbon\Carbon::parse($date))
                ->paginate(50);

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

    public function GetLiveVideos(Request $request)
    {
        try {
            $inputs = $request->all();
            $status = $inputs["status"] ?? 'active';
            $lang = $inputs["lang"] ?? 'uz';
            $typeID = $inputs["type_id"] ?? 1;
            $archiveID = $inputs["archive_id"] ?? 7;
            $data = LiveVideos::select('id', 'title_' . $lang . ' as title', 'type_id', 'date', 'started_at', 'youtube_url', 'created_at')
                ->where([
                    ['status', $status],
                    ['type_id', $typeID],
                    ['archive_id', $archiveID],
                ])->paginate(100);

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

    public function GetInnoGallery(Request $request)
    {
        try {
            $inputs = $request->all();
            $archiveID = $inputs["archive_id"] ?? 7;
            $data = InnoGallery::select('id', 'image', 'status', 'archive_id', 'created_at')
                ->where([
                    ['archive_id', $archiveID],
                ])->paginate(100);

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


    public function GetProfession(Request $request)
    {
        try {
            $inputs = $request->all();
            $status = $inputs["status"] ?? 'active';
            $lang = $inputs["lang"] ?? 'uz';
            $limit = $inputs["limit"] ?? 20;
            $data = Profession::select('id', 'name_' . $lang . ' as name', 'status', 'created_at')
                ->where([
                    ['status', $status],
                ])->paginate($limit);

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
}
