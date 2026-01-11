<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PartnerApplication;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class PartnerApplicationController extends Controller
{
    //

    public $user;
    protected $partner;

    public function __construct(PartnerApplication $partner)
    {
        $this->partner = $partner;
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    public function index()
    {
        $data['title'] = "Request Demo";
        $data['rows'] = PartnerApplication::all(); // Fetch all demo requests

        return view('admin.parter_applications.index', $data); // fixed from `request()` to `view()`
    }
    public function view()
    {

    }


    public function delete($id)
    {
        if (is_null($this->user) || !$this->user->can('admin.contact.delete')) {
            abort(403, 'Sorry !! You are Unauthorized.');
        }

        DB::beginTransaction();
        try {
            $contact = PartnerApplication::find($id);
            $contact->delete();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(__('messages.toastr.contact_delete_error'), 'Error', ["positionClass" => "toast-top-center"]);
            return redirect()->route('admin.partner-request.index');
        }
        DB::commit();
        Toastr::success(__('messages.toastr.contact_delete_success'), 'Success', ["positionClass" => "toast-top-center"]);
        return redirect()->route('admin.partner-request.index');
    }

}
