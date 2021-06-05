<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MultipicsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_multipics'])->only('index');
        $this->middleware(['permission:create_multipics'])->only('create');
        $this->middleware(['permission:update_multipics'])->only('edit');
        $this->middleware(['permission:delete_multipics'])->only('destroy');
    }

    public function index()
    {
        return view('admin.multipics.index');
    }
}
