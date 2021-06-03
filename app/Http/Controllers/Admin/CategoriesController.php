<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_categories'])->only('index');
        $this->middleware(['permission:create_categories'])->only('create');
        $this->middleware(['permission:update_categories'])->only('edit');
        $this->middleware(['permission:delete_categories'])->only('destroy');
    }

    public function index()
    {
        $categories = Category::OrderBy('created_at', 'desc');
        if (request()->ajax()) {
            $categories = $categories->get();
            return datatables()->of($categories)
                ->addColumn('user', function ($data) {
                    return ucfirst($data->user->first_name) . ' ' . ucfirst($data->user->last_name);
                })->make(true);
        }
        return view('admin.categories.index');
    }

    public function trashed()
    {
        $categories = Category::onlyTrashed()->get();
        if (request()->ajax()) {
            return datatables()->of($categories)
                ->addColumn('user', function ($data) {
                    return ucfirst($data->user->first_name) . ' ' . ucfirst($data->user->last_name);
                })->make(true);
        }
        return view('admin.categories.index');
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
            'name'       =>   $request->name,
            'user_id'    =>   Auth::user()->id
        );

        Category::create($request_data);

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Category::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Category $category)
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
        $category = Category::findOrFail($id);
        $category->delete();
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
    }

    public function force($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Category::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }
}
