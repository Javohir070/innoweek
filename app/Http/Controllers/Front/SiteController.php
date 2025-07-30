<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About\About;
use App\Models\Inno\Schedule;
use App\Models\Inno\Speaker;
use App\Models\News\InnoGallery;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\Profession;
use App\Models\Regions\Country;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $lang = \App::getLocale();
        $countries = Country::select('id', 'name_' . $lang . ' as name')->where([['status', 'active']])->orderBy('id', 'ASC')->get();
        $professions = Profession::select('id', 'name_' . $lang . ' as name')->where([['status', 'active']])->orderBy('id', 'ASC')->get();
        $schedule_day_1 = Schedule::select('id', 'title_' . $lang . ' as title', 'description_' . $lang . ' as description', 'date', 'address_' . $lang . ' as address', 'started_at', 'stopped_at')
            ->where([['archive_id', 7], ['status', 'active']])->orderBy('id', 'ASC')
            ->whereDate('date', '=', \Carbon\Carbon::parse('14.11.2024'))
            ->get();

        $schedule_day_2 = Schedule::select('id', 'title_' . $lang . ' as title', 'description_' . $lang . ' as description', 'date', 'address_' . $lang . ' as address', 'started_at', 'stopped_at')
            ->where([['archive_id', 7], ['status', 'active']])->orderBy('id', 'ASC')
            ->whereDate('date', '=', \Carbon\Carbon::parse('15.11.2024'))
            ->get();

        $schedule_day_3 = Schedule::select('id', 'title_' . $lang . ' as title', 'description_' . $lang . ' as description', 'date', 'address_' . $lang . ' as address', 'started_at', 'stopped_at')
            ->where([['archive_id', 7], ['status', 'active']])->orderBy('id', 'ASC')
            ->whereDate('date', '=', \Carbon\Carbon::parse('16.11.2024'))
            ->get();

        $news = News::select('id', DB::raw('SUBSTRING(`title_' . $lang . '`, 1, 50) as title'), 'image', 'created_at')
            ->where('category_id', 1)
            ->where('status', '=', 'active')->orderBy('created_at', 'DESC')->take(3)->get();

        $photo_galleries = InnoGallery::select('id', 'archive_id', 'image', 'created_at')->where([['archive_id', 7], ['youtube_url', '=', null]])->orderBy('created_at', 'DESC')->take(12)->get();
        $video_galleries = InnoGallery::select('id', 'archive_id', 'youtube_url', 'created_at')->where([['archive_id', 7], ['youtube_url', '!=', null]])->orderBy('created_at', 'DESC')->take(12)->get();

        $statistics = Statistic::select('id', 'name_' . $lang . ' as name', 'icon', 'statistic', 'created_at')->where('status', '=', 'active')->orderBy('created_at', 'DESC')->latest()->get();

        $speakers = Speaker::select('id', 'full_name_' . $lang . ' as full_name', 'image', 'job_' . $lang . ' as position', 'created_at')->where('archive_id', 7)->where('status', '=', 'active')->orderBy('id', 'ASC')->take(12)->get();
        return view('front.index', compact('countries', 'professions', 'news', 'speakers', 'photo_galleries', 'video_galleries', 'statistics', 'schedule_day_1', 'schedule_day_2', 'schedule_day_3'));
    }

    public function certificate(Request $request)
    {
        $lang = "uz";
        return view('front.certificates.index'); //, compact('countries', 'professions', 'news'));
    }

    public function live(Request $request)
    {
        $lang = "uz";
        return view('front.pages.live'); //, compact('countries', 'professions', 'news'));
    }


    public function about(Request $request)
    {
        $lang = "uz";
        return view('front.pages.about'); //, compact('countries', 'professions', 'news'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function news(Request $req)
    {
        $lang = \App::getLocale();

        $news = News::select('id', 'title_' . $lang . ' as title', 'image', DB::raw('SUBSTRING(`description_' . $lang . '`, 1, 500) as text'), 'created_at')->where('status', 'active')->where('category_id', 1)->orderBy('created_at', 'DESC')->paginate(10);

        $categories = NewsCategory::select('id', 'name_' . $lang . ' as title')->get();
        return view('front.news.index', compact('news', 'categories'));
    }

    public function newsShow($id)
    {
        $lang = \App::getLocale();

        $news = News::select('id', 'title_' . $lang . ' as title', 'image', 'description_' . $lang . ' as text', 'created_at')->findOrFail($id);
        $categories = NewsCategory::select('id', 'name_' . $lang . ' as title')->get();
        return view('front.news.newsDetail', compact('news', 'categories'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function speakers(Request $req)
    {
        $lang = \App::getLocale();

        $speakers = Speaker::select('id', 'full_name_' . $lang . ' as full_name', 'image', 'job_' . $lang . ' as position', 'created_at')->where('status', 'active')->where('archive_id', 7)->orderBy('id', 'ASC')->paginate(20);

        return view('front.speakers.index', compact('speakers'));
    }

    public function YoungFest(Request $request)
    {
        return view('front.pages.redYoungs'); //, compact('countries', 'professions', 'news'));
    }

}
