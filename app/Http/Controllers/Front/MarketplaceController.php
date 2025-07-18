<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Projects\Project;
use App\Models\Projects\ProjectCategory;
use App\Models\Projects\ProjectType;
use Illuminate\Http\Request;

class MarketplaceController extends Controller
{

    public function index(Request $request)
    {
        $lang = "uz"; //\App::getLocale();

        $startup_projects = Project::select('id', 'project_title as title', 'created_at', 'author_id', 'category_id', 'type_id')
            ->with('author')
            ->with('image')
            ->with('category')
            ->with('project_type')
            ->where([['type_id', 1], ['status', 'publish']])->orderBy('created_at', 'DESC')->take(4)->get();


        $commercial_projects = Project::select('id', 'project_title as title', 'created_at', 'author_id', 'category_id', 'type_id')
        ->with('author')
            ->with('image')
            ->with('category')
            ->with('project_type')
            ->where([['type_id', 2], ['status', 'publish']])->orderBy('created_at', 'DESC')->take(4)->get();

        $science_projects = Project::select('id', 'project_title as title', 'created_at', 'author_id', 'category_id', 'type_id')
        ->with('author')
            ->with('image')
            ->with('category')
            ->with('project_type')
            ->where([['type_id', 4], ['status', 'publish']])->orderBy('created_at', 'DESC')->take(4)->get();

        $local_projects = Project::select('id', 'project_title as title', 'created_at', 'author_id', 'category_id', 'type_id')
        ->with('author')
            ->with('image')
            ->with('category')
            ->with('project_type')
            ->where([['type_id', 10], ['status', 'publish']])->orderBy('created_at', 'DESC')->take(4)->get();

        $categories = ProjectCategory::select('id', 'name_' . $lang . ' as title')->get();
        return view('front.marketplace.index', compact('startup_projects', 'commercial_projects', 'science_projects', 'local_projects', 'categories'));
    }

    public function indexByTypeID($type_id, Request $request)
    {
        $inputs = $request->all();
        $lang = "uz"; //\App::getLocale();

        $projects = Project::select('id', 'project_title as title', 'created_at', 'author_id', 'category_id', 'type_id')
        ->with('author')
        ->with('image')
        ->with('category')
        ->with('project_type')
        ->where([['type_id', $type_id], ['status', 'publish']])->orderBy('created_at', 'DESC')->paginate(40);

        $projectType = ProjectType::select('id', 'name_' . $lang . ' as title')->findOrFail($type_id);
        return view('front.marketplace.projectByType', compact('projects',  'projectType'));
    }

    public function projectShow($id)
    {
        $lang = "uz"; // \App::getLocale();

        $project = Project::select('id', 'project_title as title', 'description', 'created_at', 'author_id', 'category_id', 'type_id')
        ->with('author')
        ->with('image')
            ->with('category')
            ->with('project_type')
            ->where([['status', 'publish'], ['id', $id]])->first();
        return view('front.marketplace.projectDetail', compact('project'));
    }
}
