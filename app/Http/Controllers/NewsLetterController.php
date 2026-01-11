<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class NewsLetterController extends Controller
{
    public function index()
    {
        $data['title'] = __('messages.common.contact');
        $data['emails'] = Newsletter::orderBy('id', 'desc')->get();
        return view('admin.newsletter.email_list', $data);
    }



    public function delete($id)
    {


        DB::beginTransaction();
        try {
            $contact = Newsletter::find($id);
            $contact->delete();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(__('messages.toastr.contact_delete_error'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.contact.index');
        }
        DB::commit();
        Toastr::success(__('messages.toastr.contact_delete_success'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.contact.index');
    }

}
