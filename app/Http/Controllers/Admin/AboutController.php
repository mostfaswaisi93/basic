<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeAbout;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_homeabout'])->only('index');
        $this->middleware(['permission:create_homeabout'])->only('create');
        $this->middleware(['permission:update_homeabout'])->only('edit');
        $this->middleware(['permission:delete_homeabout'])->only('destroy');
    }

    public function index()
    {
        $homeabout = HomeAbout::OrderBy('created_at', 'desc');
        if (request()->ajax()) {
            $homeabout = $homeabout->get();
            return datatables()->of($homeabout)
                ->addColumn('user', function ($data) {
                    return ucfirst($data->user->first_name) . ' ' . ucfirst($data->user->last_name);
                })->make(true);
        }
        return view('admin.homeabout.index');
    }

    public function trashed()
    {
        $homeabout = HomeAbout::onlyTrashed()->get();
        if (request()->ajax()) {
            return datatables()->of($homeabout)
                ->addColumn('user', function ($data) {
                    return ucfirst($data->user->first_name) . ' ' . ucfirst($data->user->last_name);
                })->make(true);
        }
        return view('admin.homeabout.index');
    }

    public function store(Request $request)
    {
        $rules = array();

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'       =>   $request->name
        );

        HomeAbout::create($request_data);

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = HomeAbout::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, HomeAbout $category)
    {
        $rules = array();

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'       =>   json_encode($request->name, JSON_UNESCAPED_UNICODE),
            'user_id'    =>   Auth::user()->id
        );

        $category::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated.']);
    }

    public function destroy($id)
    {
        $category = HomeAbout::findOrFail($id);
        $category->delete();
    }

    public function restore($id)
    {
        $category = HomeAbout::withTrashed()->findOrFail($id);
        $category->restore();
    }

    public function force($id)
    {
        $category = HomeAbout::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        HomeAbout::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }
}
