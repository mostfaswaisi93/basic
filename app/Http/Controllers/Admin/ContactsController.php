<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ContactsController extends Controller
{

    public function index()
    {
        $contacts = Contact::with(['customer'])->get();

        if (request()->ajax()) {
            return datatables()->of($contacts)
                ->addColumn('customer', function ($data) {
                    return $data->customer->first_name;
                })->make(true);
        }
        return view('admin.contacts.index');
    }

    public function store(Request $request)
    {
        $rules = [
            'iso_code'      => 'required|max:3|unique:contacts',
            'phone_code'    => 'required|unique:contacts'
        ];

        $request->validate($rules);

        Contact::create($request->all());
        Toastr::success(__('admin.added_successfully'));
        return redirect()->route('admin.contacts.index');
    }

    public function show(Contact $contact)
    {
        $contacts = Contact::get();
        $contact->update(['readable' => 1]);
        return view('admin.contacts.show', compact('contacts', 'contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
    }
}
