<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetDataCollection;
use App\Models\Projects\Project;
use App\Models\Projects\ProjectCategory;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Carbon\Carbon;

class MarketplaceAPIController extends Controller
{
    /***
     * GET BY ID
     * @var ID = INT
     */
    public function GetAllProducts(Request $request)
    {
        try {
            $inputs = $request->all();
            $status = $inputs["status"] ?? 'publish';
            $lang = $inputs["lang"] ?? 'uz';

            $query = [];
            $query[] = ['status', $status];
            if (isset($inputs["category_id"]) && !empty($inputs["category_id"])) {
                $query[] = ['category_id', $inputs["category_id"]];
            }
            $data = Project::select('id', 'project_title as title', 'created_at', 'author_id', 'category_id', 'type_id')
                ->with('author')
                ->with('image')
                ->with('category')
                ->with('project_type')
                ->where($query)->orderBy('created_at', 'DESC')->paginate($inputs['limit']);

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

    /***
     * GET BY ID
     * @var ID = INT
     */
    public function GetProjectCategoryList(Request $request)
    {
        try {
            $inputs = $request->all();
            $status = $inputs["status"] ?? 'active';
            $lang = $inputs["lang"] ?? 'uz';

            $query = [];
            $query[] = ['status', $status];

            $data = ProjectCategory::select('name_' . $lang . ' as title', 'id', 'status')
            ->where($query)->orderBy('id', 'DESC')->paginate($inputs["limit"]);

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
