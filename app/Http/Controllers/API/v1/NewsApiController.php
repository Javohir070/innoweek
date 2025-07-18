<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Carbon\Carbon;
use App\Http\Resources\GetDataCollection;

class NewsApiController extends Controller
{

    /***
     * GET BY ID
     * @var ID = INT
     */
    public function GetAllNews(Request $request)
    {
        try {
            $inputs = $request->all();
            $status = $inputs["status"] ?? 'active';
            $lang = $inputs["lang"] ?? 'uz';
            $categoryID = $inputs["category_id"] ?? 1;
            $limit = $inputs["limit"] ?? 10;
            $data = News::select('id', 'title_' . $lang . ' as title', 'description_' . $lang . ' as description', 'image', 'created_at')
                //->with('author')
                ->where([
                    ['status', $status],
                    ['category_id', $categoryID],
                ])->orderBy('created_at', 'DESC')
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

    public function GetByIDNews(Request $request, $id)
    {
        try {
            $lang = $request->input('lang', 'uz');
            $data = News::select('id', 'title_' . $lang . ' as title', 'description_' . $lang . ' as description', 'image', 'created_at')
                ->where('id', $id)
                ->first();

            if (empty($data)) {
                $message = "Nimadir xato bajarildi! iltimos ma'lumotlarni qayta tekshirib ko'ring.";
                $error = "Data not found";
                return _sendError(404, $message, $error);
            }
            $message = "Data found";
            return response()->json([
                'status' => 201,
                'success' => true,
                'message' => $message,
                'data' => $data
            ], 201);
        } catch (\Exception $error) {
            $message = "Что-то пошло не так! Пожалуйста, попробуйте позже!";
            return _sendError(402, $message, $error->getMessage());
        }
    }
}
