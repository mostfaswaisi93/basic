<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role as AppRole;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Validator;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_roles'])->only('index');
        $this->middleware(['permission:create_roles'])->only('create');
        $this->middleware(['permission:update_roles'])->only('edit');
        $this->middleware(['permission:delete_roles'])->only('destroy');
    }

    public function index()
    {
        $roles = AppRole::OrderBy('created_at', 'desc');
        if (request()->ajax()) {
            $roles = $roles->get();
            return datatables()->of($roles)
                ->editColumn('name', function ($roles) {
                    return ucwords(str_replace('_', ' ', $roles->name));
                })->make(true);
        }
        return view('admin.roles.index');
    }

    public function store(Request $request)
    {
        $rules = array(
            'name'    =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'      => strtolower(str_replace(' ', '_', $request->name))
        );

        Role::create($request_data);

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = Role::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, Role $role)
    {
        $rules = array(
            'name'    =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = array(
            'name'      => strtolower(str_replace(' ', '_', $request->name))
        );

        $role::whereId($request->hidden_id)->update($request_data);

        return response()->json(['success' => 'Data is Successfully Updated.']);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        AppRole::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }
}
