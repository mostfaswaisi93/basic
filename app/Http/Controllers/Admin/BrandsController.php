<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
            return datatables()->of($brands)
                ->make(true);
        }
        return view('admin.brands.index');
    }

    public function trashed()
    {
        $brands = Brand::onlyTrashed()->get();
        if (request()->ajax()) {
            return datatables()->of($brands)
                ->make(true);
        }
        return view('admin.brands.index');
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);
        $request_data = $request->except(['image']);

        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('images/brands/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }

        $brand = Brand::create($request_data);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.added_successfully'));
        } else {
            Toastr::success(__('admin.added_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.brands.index');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit')->with('brand', $brand);
    }

    public function update(Request $request, Brand $brand)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $request->validate($rules);
        $request_data = $request->except(['image']);

        if ($request->image) {
            if ($brand->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/brands/' . $brand->image);
            }

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('images/brands/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }

        $brand->update($request_data);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.brands.index');
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
    }

    public function restore($id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);
        $brand->restore();
    }

    public function force($id)
    {
        $brand = Brand::onlyTrashed()->findOrFail($id);
        if ($brand->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/brands/' . $brand->image);
        }
        $brand->forceDelete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Brand::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }
}
