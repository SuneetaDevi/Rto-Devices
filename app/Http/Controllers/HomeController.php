<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Seo;
use App\Models\Blog;
use App\Models\Card;
use App\Models\Plan;
use App\Models\User;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Contract;
use App\Models\Language;
use App\Mail\SendContact;
use App\Models\CustomPage;
use App\Models\Newsletter;
use App\Models\SocialIcon;
use App\Models\HomeContent;
use App\Models\RequestDemo;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ContractDocument;
use App\Models\PartnerApplication;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{


    public function changeCardLanguage(Request $request)
    {

        Session::put('cardLang', $request->input('locale'));
        return redirect()->back();
    }

    public function index()
    {
        $setting = getSetting();
        $data['title'] = $setting->site_name;
        $data['og_title'] = $setting->site_name;
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        // $data['faqs']           = Faq::where('is_active', 1)->orderBy('order_id','asc')->get();
        // $data['seo']            = Seo::where('page_slug', 'home')->first();
        // $data['homeContent']    = HomeContent::first();
        // $data['plans']          = Plan::where('status', '1')->get();
        $data['testimonials'] = Testimonial::where('status', '1')->orderBy('order_id')->get();
        return view('frontend.index', $data);
    }

    public function privacyPolicy()
    {
        $setting = getSetting();
        $data['title'] = __('messages.footer.privacy_policy');
        $data['og_title'] = 'Privacy Policy | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['row'] = CustomPage::where('url_slug', 'privacy-policy')->where('is_active', 1)->firstOrFail();
        return view('frontend.privacy', $data);
    }

    public function termsCondition()
    {
        $setting = getSetting();
        $data['title'] = __('messages.footer.terms_conditions');
        $data['og_title'] = 'Terms & Condition | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['row'] = CustomPage::where('url_slug', 'terms-and-conditions')->where('is_active', 1)->firstOrFail();

        return view('frontend.terms', $data);
    }

    public function imprint()
    {
        $setting = getSetting();
        $data['title'] = __('messages.footer.imprint');
        $data['og_title'] = 'Imprint | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['row'] = CustomPage::where('url_slug', 'imprint')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }
    public function rightOfWithdrawal()
    {
        $setting = getSetting();
        $data['title'] = __('messages.footer.right-of-withdrawal');
        $data['og_title'] = 'Right of Withdrawal | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['row'] = CustomPage::where('url_slug', 'right-of-withdrawal')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }
    public function generalTermsConditions()
    {
        $setting = getSetting();
        $data['title'] = __('messages.footer.general-terms-and-conditions');
        $data['og_title'] = 'General Terms & Conditions | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['row'] = CustomPage::where('url_slug', 'general-terms-and-conditions')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }

    public function faq()
    {
        $setting = getSetting();
        $data['title'] = 'FAQ';
        $data['og_title'] = 'FAQ | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['faqs'] = Faq::where('is_active', 1)->orderBy('order_id', 'asc')->get();
        $data['seo'] = Seo::where('page_slug', 'faq')->first();
        return view('frontend.faq', $data);
    }
    public function dataProtectionDeclaration()
    {
        $setting = getSetting();
        $data['title'] = __('messages.footer.data-protection-declaration');
        $data['og_title'] = 'Data Protection Declaration | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['row'] = CustomPage::where('url_slug', 'data-protection-declaration')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }
    public function shippingConditions()
    {
        $setting = getSetting();
        $data['title'] = __('messages.footer.shipping-conditions');
        $data['og_title'] = 'Shipping Conditions | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['row'] = CustomPage::where('url_slug', 'shipping-conditions')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }

    public function returns()
    {
        $setting = getSetting();
        $data['title'] = __('messages.footer.returns');
        $data['og_title'] = 'Returns | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['row'] = CustomPage::where('url_slug', 'returns')->where('is_active', 1)->firstOrFail();
        return view('frontend.custom_page', $data);
    }
    public function about()
    {
        $setting = getSetting();
        $data['title'] = "About Us | RTO Devices";
        $data['og_title'] = 'About-Us | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        return view('frontend.about', $data);
    }
    public function blogs()
    {
        $setting = getSetting();
        $data['title'] = "Blogs | RTO Devices";
        $data['og_title'] = 'Blogs | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['rows'] = Blog::where('status', 1)->get();
        return view('frontend.blog', $data);
    }
    public function demo()
    {
        $setting = getSetting();
        $data['title'] = "Rquest Demo | RTO Devices";
        $data['og_title'] = 'Rquest Demo | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        return view('frontend.demo', $data);
    }


    public function blogsDetails($slug)
    {
        $setting = getSetting();
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;

        // Get current blog
        $data['blog'] = Blog::where('slug', $slug)->firstOrFail();
        // dd($data['blog']->details);

        $data['title'] = $data['blog']->title . " | RTO Devices";
        $data['og_title'] = $data['title'];
        // Get 3 related blogs from the same category, excluding the current one
        $data['related_blogs'] = Blog::where('category_id', $data['blog']->category_id)
            ->where('id', '!=', $data['blog']->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.blog_details', $data);
    }

    public function testimonials()
    {
        $setting = getSetting();
        $data['title'] = 'Testimonials | RTO Devices';
        $data['og_title'] = "Testimonials | RTO Devices";
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        return view('frontend.testimonials', $data);
    }

    public function pricing()
    {
        $setting = getSetting();
        $data['title'] = 'Pricing';
        $data['og_title'] = 'Pricing | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['seo'] = Seo::where('page_slug', 'pricing')->first();
        $data['plans'] = Plan::where('status', '1')->get();
        $data['homeContent'] = HomeContent::first();
        return view('frontend.pricing', $data);
    }

    public function contact()
    {
        $setting = getSetting();
        $data['title'] = 'Contact';
        $data['og_title'] = 'Contact | RTO Devices';
        $data['og_description'] = $setting->seo_meta_description;
        $data['og_image'] = $setting->site_logo;
        $data['meta_keywords'] = $setting->seo_keywords;
        $data['setting'] = $setting;
        return view('frontend.contact', $data);
    }



    public function partnerApplicationstore(Request $request)
    {
        $request->validate([
            'companyName' => 'required|string|max:255',
            'partnerType' => 'required|string',
            'contactName' => 'required|string|max:255',
            'email' => 'required|email|unique:partner_applications,email',
            'phone' => 'required|string|max:50',
            'website' => 'nullable|url',
            'message' => 'nullable|string',
            'agreeTerms' => 'required|in:on,1,true',
        ]);

        try {
            PartnerApplication::create([
                'companyName' => $request->companyName,
                'partnerType' => $request->partnerType,
                'contactName' => $request->contactName,
                'email' => $request->email,
                'phone' => $request->phone,
                'website' => $request->website,
                'message' => $request->message,
                'agreeTerms' => true,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your partnership application has been submitted successfully!'
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, please try again!'
            ], 500);
        }
    }

    public function requestDemoSubmit(Request $request)
    {
        // Validate the form input
        $this->validate($request, [
            'companyName' => 'required|max:150|string',
            'numberOfStores' => 'required|integer|min:1',
            'firstName' => 'required|max:100|string',
            'lastName' => 'required|max:100|string',
            'email' => 'required|email|max:100|string',
            'phone' => 'required|max:20|string',
            'address' => 'required|max:255|string',
            'suite' => 'nullable|max:50|string',
            'zipCode' => 'required|max:20|string',
            'city' => 'required|max:100|string',
            'state' => 'required|max:100|string',
        ]);

        DB::beginTransaction();
        try {
            $demo = new RequestDemo();
            $demo->company_name = $request->companyName;
            $demo->number_of_stores = $request->numberOfStores;
            $demo->first_name = $request->firstName;
            $demo->last_name = $request->lastName;
            $demo->email = $request->email;
            $demo->phone = $request->phone;
            $demo->address = $request->address;
            $demo->suite = $request->suite;
            $demo->zip_code = $request->zipCode;
            $demo->city = $request->city;
            $demo->state = $request->state;
            $demo->save();

            DB::commit();

            Toastr::success('Your request has been submitted successfully', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        } catch (\Exception $e) {

            DB::rollback();
            // dd($e->getMessage());
            Toastr::error('An unexpected error occurred while submitting your request', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
    public function newsletterSub(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email',
        ]);
        try {
            Newsletter::create([
                'email' => $request->email,
            ]);
            Toastr::success('Your request has been submitted successfully', 'Success', ["positionClass" => "toast-top-right"]);

        } catch (\Throwable $th) {
            dd($th->getMessage());
            Toastr::error('An unexpected error occurred while submitting your request', 'Error', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();

    }


    public function contactSub(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'companyName' => 'nullable|max:150|string',
            'firstName' => 'required|max:100|string',
            'lastName' => 'required|max:100|string',
            'email' => 'required|email|max:80|string',
            'phone' => 'nullable|max:20|string',
            'message' => 'required|max:512|string'
        ]);

        DB::beginTransaction();

        try {
            // Save the contact
            $contact = new Contact();
            $contact->name = $request->firstName . ' ' . $request->lastName;
            $contact->company = $request->companyName ?? null;
            $contact->email = $request->email;
            $contact->phone = $request->phone ?? null;
            $contact->message = $request->message;
            $contact->save();

            // Prepare email data
            $data = [
                'greeting' => 'Hello, Admin,',
                'body' => 'A user sent a contact message to your system. Please review and respond to the query as soon as possible.',
                'name' => 'User name: ' . $request->firstName . ' ' . $request->lastName,
                'email' => 'User email: ' . $request->email,
                'phone' => 'User phone: ' . ($request->phone ?? 'N/A'),
                'company' => 'Company: ' . ($request->companyName ?? 'N/A'),
                'link' => route('admin.contact.index'),
                'msg' => 'Click here to navigate to the query',
                'thanks' => 'Thank you and stay with ' . config('app.name'),
                'site_url' => route('home'),
                'footer' => '0',
                'site_name' => config('app.name'),
                'copyright' => '© ' . Carbon::now()->format('Y') . ' ' . config('app.name') . ' All rights reserved.',
            ];

            $setting = Setting::first();
            $support_email = $setting->email ?? $setting->support_email;

            if ($support_email) {
                Mail::to($support_email)->send(new SendContact($data));
            }

            DB::commit();

            Toastr::success(trans('Your query is submitted'), 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error(trans('An unexpected error occurred while submitting your query'), 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function userRegister(Request $request)
    {
        $setting = getSetting();

        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:users,email",
            'password' => "required|confirmed|min:8|max:50",
        ]);

        $created = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($created) {
            Auth::guard('user')->logout();
            Auth::guard('admin')->logout();
            Auth::guard('user')->login($created);
            if ($setting->customer_email_verification) {
                return redirect()->route('verification.notice');
            } else {
                return redirect()->route('user.dashboard');
            }
        }
    }

    public function testEmail()
    {
        $message = [
            'msg' => 'Test mail'
        ];
        $mail = false;
        try {
            Mail::to(ENV('MAIL_FROM_ADDRESS'))->send(new \App\Mail\TestMail($message));
            $mail = true;
        } catch (\Exception $e) {
            dd($e);
            Toastr::success(trans('Email configuration wrong.'), 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        if ($mail == true) {

            Toastr::success(trans('Test mail send successfully.'), 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }

    public function getPreview(Request $request, $cardurl)
    {

        $card = Card::where('url_alias', $cardurl)->first();


        if (!isset($card) && !empty($card)) {
            abort(404);
        }

        //  check plan validity, if expired then redirect to home page
        $planValidity = User::where('id', $card->user_id)->first('current_pan_valid_date')->current_pan_valid_date;
        $currentDay = Carbon::today();

        if ($currentDay->greaterThan($planValidity)) { {
                abort(404);
            }
        }

        if (!empty($card)) {
            $icons = SocialIcon::where('vcard_id', $card->id)->first();

            if ($card->status == "0") {
                // if ($request->headers->get('referer')) {
                //     Toastr::warning('This card has been de-activated, please contact with Linksmartt');
                //     return redirect()->back();
                // } else {
                abort(404);
                // }
                // return redirect()->back();
            }
            if ($card->status == "2") {
                // if ($request->headers->get('referer')) {
                //     Toastr::warning('This card has been deleted');
                //     return redirect()->back();
                // } else {
                abort(404);
                // }

            }
            // DB::table('business_cards')->where('id', $card->id)->increment('total_view', 1);
            // $inserted_id = self::insertHistory($card, "history_card_browsing");

            return view('user.card.preview.template' . $card->template_id, compact('card', 'icons'));
        }
    }






    public function showUploadPage($pub_ref)
    {
        $contract = Contract::where('pub_ref', $pub_ref)->firstOrFail();

        $data['contract_ref'] = $contract->pub_ref;

        return view('contract-upload', $data);
    }




    public function uploadDocument(Request $request, $ref)
    {
        $request->validate([
            'id_front' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
            'id_back' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
            'customer' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
        ]);

        try {
            $contract = Contract::where('pub_ref', $ref)->firstOrFail();

            $uploadedFiles = [];

            // Loop expected file fields
            $fileFields = ['id_front', 'id_back', 'customer'];

            foreach ($fileFields as $field) {

                if ($request->hasFile($field)) {
                    $file = $request->file($field);

                    // Create folder if not exists
                    $folder = public_path('contracts/' . $contract->public_ref);
                    if (!file_exists($folder)) {
                        mkdir($folder, 0755, true);
                    }

                    // Generate unique file name
                    $filename = time() . '_' . $file->getClientOriginalName();

                    // Move file to public/contracts/{public_ref}
                    $file->move($folder, $filename);

                    // Store relative path in DB
                    $path = 'contracts/' . $contract->public_ref . '/' . $filename;

                    // Save/update in DB
                    ContractDocument::updateOrCreate(
                        [
                            'contract_id' => $contract->id,
                            'document_type' => $field,
                        ],
                        [
                            'file_path' => $path,
                            'is_uploaded' => true
                        ]
                    );

                    // Add to uploaded files array for API response
                    $uploadedFiles[$field] = asset($path);
                }

            }

            if (empty($uploadedFiles)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No files were uploaded.',
                ], 422);
            }

            return response()->json([
                'success' => true,
                'message' => 'Document(s) uploaded successfully.',
                'files' => $uploadedFiles
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed.',
                'error' => $th->getMessage()
            ], 500);
        }
    }



}
