<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    public function index()
    {
        // $users = User::OrderBy('created_at', 'desc')->role('admin')->get();
        $users = User::OrderBy('created_at', 'desc');
        $enabled = request()->get('enabled');
        if (request()->ajax()) {
            if (isset($enabled))
                $users->where('enabled', $enabled)->get();
            $users = $users->get();
            return datatables()->of($users)->make(true);
        }
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'first_name'    =>  'required',
            'last_name'     =>  'required',
            'email'         =>  'required|unique:users',
            'username'      =>  'required|unique:users',
            'image'         =>  'image',
            'password'      =>  'required|confirmed',
            'permissions'   =>  'required|min:1'
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        $user = User::create($request_data);
        $user->assignRole('doctor');

        return response()->json(['success' => 'Data Added Successfully.']);
    }

    public function storexx(Request $request)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|unique:users',
            'image'         => 'image',
            'password'      => 'required|confirmed',
            'permissions'   => 'required|min:1'
        ]);

        $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_data['password'] = bcrypt($request->password);

        if ($request->image) {
            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }

        $user = User::create($request_data);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $data = User::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => ['required', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'image' => 'image',
            'permissions' => 'required|min:1',
        ]);

        $request_data = $request->except(['permissions', 'image']);
        if ($request->image) {
            if ($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/users/' . $user->image);
            }

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('images/users/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }

        $user->update($request_data);
        $user->syncPermissions($request->permissions);

        if (app()->getLocale() == 'ar') {
            Toastr::success(__('admin.updated_successfully'));
        } else {
            Toastr::success(__('admin.updated_successfully'), '', ["positionClass" => "toast-bottom-left"]);
        }

        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/users/' . $user->image);
        }
        $user->delete();
    }

    public function multi_delete(Request $request)
    {
        $ids = $request->ids;
        User::whereIn('id', explode(",", $ids))->delete();
        return response()->json(['success' => 'The Data has been Deleted Successfully.']);
    }

    public function updateStatus(Request $request, $id)
    {
        $user           = User::find($id);
        $enabled        = $request->get('enabled');
        $user->enabled  = $enabled;
        $user           = $user->save();

        if ($user) {
            return response(['success' => true, "message" => 'Status has been Successfully Updated.']);
        }
    }
}
