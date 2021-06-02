<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Validator;

class BrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_brands'])->only('index');
        $this->middleware(['permission:create_brands'])->only('create');
        $this->middleware(['permission:update_brands'])->only('edit');
        $this->middleware(['permission:delete_brands'])->only('destroy');
    }

    public function index()
    {
        $brands = Brand::OrderBy('created_at', 'desc');
        if (request()->ajax()) {
            $brands = $brands->get();
            return datatables()->of($brands)->make(true);
        }
        return view('admin.brands.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'user_id'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'       =>   $request->name,
            'user_id'    =>   $request->user_id
        );

        Brand::create($request_data);

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Brand::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Brand $brand)
    {
        $rules = array(
            'user_id'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'       =>   json_encode($request->name, JSON_UNESCAPED_UNICODE),
            'user_id'    =>   $request->user_id
        );

        $brand::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated.']);
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Brand::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }
}
