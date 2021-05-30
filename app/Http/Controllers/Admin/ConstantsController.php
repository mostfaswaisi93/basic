<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ConstantsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_constants'])->only('index');
        $this->middleware(['permission:create_constants'])->only('create');
        $this->middleware(['permission:update_constants'])->only('edit');
        $this->middleware(['permission:delete_constants'])->only('destroy');
    }

    public function index()
    {
        $constants = Constant::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        $type = request()->get('type');
        $types =  Constant::select(DB::raw('COUNT(id) as count'), 'type')
            ->groupBy('type')->having('count', '>=', 1)->get();
        if (request()->ajax()) {
            if (isset($enabled))
                $constants->where('enabled', $enabled)->get();
            if (isset($type))
                $constants->where('type', $type)->get();
            $constants = $constants->get();
            return datatables()->of($constants)
                ->editColumn('type', function ($constants) {
                    return ucwords(str_replace('_', ' ', $constants->type));
                })->make(true);
        }
        return view('admin.constants.index')->with('types', $types);
    }

    public function store(Request $request)
    {
        $rules = array(
            'type'    =>  'required'
        );

        foreach (config('translatable.locales') as $locale) {
            $rules += ['name.' . $locale => 'required'];
        }

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'      => $request->name,
            'type'      => strtolower(str_replace(' ', '_', $request->type))
        );

        Constant::create($request_data);

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Constant::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Constant $constant)
    {
        $rules = array(
            'type'    =>  'required'
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
            'type'       =>   strtolower(str_replace(' ', '_', $request->type))
        );

        $constant::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated.']);
    }

    public function destroy($id)
    {
        $constant = Constant::findOrFail($id);
        $constant->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        Constant::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $constant           = Constant::find($id);
        $enabled            = $request->get('enabled');
        $constant->enabled  = $enabled;
        $constant           = $constant->save();

        if ($constant) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated.']);
        }
    }
}
