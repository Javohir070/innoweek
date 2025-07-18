<?php

namespace App\Http\Controllers\Panel\News;

use App\DataTables\ArchiveYearDataTable;
use App\DataTables\News\GalleryDataTable;
use App\Http\Controllers\Controller;
use App\Models\ArchiveYear;
use App\Models\News\InnoGallery;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }


    public function index(ArchiveYearDataTable $dataTable)
    {
        //dd(User::with('userRole')->get());
        $data_count = ArchiveYear::count();
        return $dataTable->render('admin.gallery.index', compact('data_count'));
    }

    public function storeDataArchive(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = new ArchiveYear;
            $rules = [
                'year' => 'required', //|unique' . !empty($inputs['id']) ? ':news_categories,name_uz,' . $inputs['id'] : '',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }

            $data->user_id = Auth::user()->id;
            $data->year = $inputs['year'];
            $data->status = 'active';
            $data->save();
            \Session::flash('success', trans("Ma'lumotlar saqlandi!"));
            return \Redirect::back();
        } catch (\Exception  $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }


    public function DataInfo(Request $request)
    {
        $inputs = $request->all();
        $dataID = $inputs['archive_id'] ?? null;
        $data = ArchiveYear::where('id', $dataID)->with('gallery')->first();
        $dataQuery = [['status', 'active']];
        if (!empty($data)) {
            $dataQuery[] = ['id', '!=', $data->id];
        }
        return  view('admin.gallery.addEditGallery', compact('data'));
    }


    public function storeGalleryImage(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = new InnoGallery;

            $rules = [
                'image' => 'image|mimes:jpeg,png,jpg|max:5120', // Adjust max file size as needed
                //'video_url' => 'video|mimes:jpeg,png,jpg|max:5120' // Adjust max file size as needed
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                \Session::flash('warning', $validator->messages());
                return \Redirect::back();
            }

            $dataImagePath = '/upload/gallery/';
            if ($request->hasFile('image')) {
                $fileName = 'gallery_' . time() . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->move(public_path() . $dataImagePath, $fileName);
                $data->image = $dataImagePath . $fileName;
            }

            $data->user_id = Auth::user()->id;
            $data->youtube_url = $inputs['youtube_url'] ?? null;
            $data->archive_id = $inputs['archive_id'];
            $data->save();

            \Session::flash('success', trans("Ma'lumotlar saqlandi!"));
            return \Redirect::back();
        } catch (\Exception $ex) {
            return \Redirect::back()->withErrors($ex->getMessage());
        }
    }


    public function destroyGalleryImageData(Request $request)
    {
        try {
            $inputs = $request->all();
            $data = InnoGallery::findOrFail($inputs['id']);
            if ($data) {
                \File::delete(public_path() . $data->image);
                $data->delete();
                return response()->json($data, 200);
            }
        } catch (\Exception $ex) {
            return response()->json($ex->getMessage(), 401);
        }
    }
}
