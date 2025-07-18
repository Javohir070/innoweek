<?php

namespace App\Http\Controllers\Panel\Inno;

use App\DataTables\Inno\EventMemberDataTable;
use App\Http\Controllers\Controller;
use App\Models\EventMember;
use App\Models\Inno\Schedule;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventMemberController extends Controller
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

    public function index(EventMemberDataTable $dataTable, Request $request)
    {
        $inputs = $request->all();
        //dd(User::with('userRole')->get());
        $query = ['id' => null];
        $dataQuery[] = ['id', '!=', null];

        if (isset($inputs['event_id']) && !empty($inputs['event_id'])) {
            $query['event_id'] = $inputs['event_id'];
            $dataQuery[] = ['event_id', $inputs['event_id']];
        }

        $data_count = EventMember::where($dataQuery)->count();
        $schedules = Schedule::select('id', 'title_uz as title')->get();
        return $dataTable->with($query)->render('admin.schedules.eventMember', compact('data_count', 'schedules', 'inputs'));
    }
}
