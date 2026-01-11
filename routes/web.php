<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;
// admin
use App\Http\Controllers\HomeController;
// user
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\User\CardController;
use App\Http\Controllers\TenantAuthController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\TenantDashboardController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\PartnerApplicationController;
use App\Http\Controllers\User\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test-email', [HomeController::class, 'testEmail'])->name('test.email');
Route::post('/change-language', [HomeController::class, 'changeLanguage'])->name('change.language');
Route::post('/change-card-language', [HomeController::class, 'changeCardLanguage'])->name('change.card.language');



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('about', [HomeController::class, 'about'])->name('frontend.about');
Route::get('contact', [HomeController::class, 'contact'])->name('frontend.contact');
Route::post('contact-submit', [HomeController::class, 'contactSub'])->name('frontend.contact.submit');
Route::post('newsletter-submit', [HomeController::class, 'newsletterSub'])->name('frontend.newsletter.submit');
Route::post('request-demo-submit', [HomeController::class, 'requestDemoSubmit'])->name('frontend.demo.submit');
Route::get('pricing', [HomeController::class, 'pricing'])->name('frontend.pricing');
Route::get('faq', [HomeController::class, 'faq'])->name('frontend.faq');
Route::get('blogs', [HomeController::class, 'blogs'])->name('frontend.blogs');
Route::get('demo', [HomeController::class, 'demo'])->name('frontend.demo');
Route::get('blogs/details/{slug}', [HomeController::class, 'blogsDetails'])->name('frontend.blogs.details');
Route::get('testimonials', [HomeController::class, 'testimonials'])->name('frontend.testimonials');
Route::get('disclaimer', [HomeController::class, 'disclaimer'])->name('frontend.disclaimer');



Route::get('contract/{ref}/upload-documents', [HomeController::class, 'showUploadPage']);
Route::post('contract/{ref}/upload', [HomeController::class, 'uploadDocument']);





Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('frontend.privacy-policy');
Route::get('terms-condition', [HomeController::class, 'termsCondition'])->name('frontend.terms-condition');
Route::get('imprint', [HomeController::class, 'imprint'])->name('frontend.imprint');
Route::get('right-of-withdrawal', [HomeController::class, 'rightOfWithdrawal'])->name('frontend.right-of-withdrawal');
Route::get('general-terms-and-conditions', [HomeController::class, 'generalTermsConditions'])->name('frontend.general-terms-and-conditions');
Route::get('data-protection-declaration', [HomeController::class, 'dataProtectionDeclaration'])->name('frontend.data-protection-declaration');
Route::get('shipping-conditions', [HomeController::class, 'shippingConditions'])->name('frontend.shipping-conditions');
Route::get('returns', [HomeController::class, 'returns'])->name('frontend.returns');
Route::post('user-register', [HomeController::class, 'userRegister'])->name('user-register');
Route::post('/partnership-apply', [HomeController::class, 'partnerApplicationstore'])->name('partner.apply');

Route::get('/calculator', function () {
    return view('frontend.calculator');
})->name('frontend.calculator');

Route::get('/how-it-works', function () {
    return view('frontend.phone_retailers');
})->name('frontend.how_it_works');

Route::get('/partners', function () {
    return view('frontend.partners');
})->name('frontend.partners');

Route::get('/become_partner', function () {
    return view('frontend.become_partner');
})->name('frontend.become_partner');

Auth::routes();




















// Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['auth']], function () {

//     Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
//     Route::get('/profile', [UserDashboardController::class, 'profile'])->name('profile');
//     Route::get('/setting', [UserDashboardController::class, 'setting'])->name('setting');
//     Route::post('/profile/update', [UserDashboardController::class, 'profileUpdate'])->name('profile.update');
//     Route::post('/password/update', [UserDashboardController::class, 'passwordUpdate'])->name('password.update');
//     Route::get('/upgrade-plan', [UserDashboardController::class, 'upgradePlan'])->name('upgrade.plan');

//     Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
//     Route::get('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
//     Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
//     Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

//     Route::group(['as' => 'card.', 'prefix' => 'card'], function () {
//         Route::get('/', [CardController::class, 'index'])->name('index');
//         Route::get('theme', [CardController::class, 'theme'])->name('theme');
//         Route::get('create', [CardController::class, 'create'])->name('create');
//         Route::post('store', [CardController::class, 'store'])->name('store');
//         // Route::get('{id}/view', [CardController::class, 'view'])->name('view');
//         Route::get('{id}/edit', [CardController::class, 'edit'])->name('edit');
//         Route::post('{id}/update', [CardController::class, 'update'])->name('update');
//         Route::get('{id}/delete', [CardController::class, 'getDelete'])->name('delete');
//         Route::get('{id}/status', [CardController::class, 'status'])->name('status');
//         Route::post('upload/profie', [CardController::class, 'uploadImage'])->name('upload.image');
//         Route::post('upload/cover', [CardController::class, 'uploadCover'])->name('upload.cover');
//         Route::get('preview/template', [CardController::class, 'previewTemplate'])->name('preview.template');
//     });

//     Route::group(['as' => 'contact.', 'prefix' => 'contact'], function () {
//         Route::get('/', [ContactController::class, 'index'])->name('index');
//         Route::get('{id}/view', [ContactController::class, 'view'])->name('view');
//         Route::get('{id}/delete', [ContactController::class, 'getDelete'])->name('delete');
//     });

//     Route::group(['as' => 'transaction.', 'prefix' => 'transaction'], function () {
//         Route::get('/', [TransactionController::class, 'index'])->name('index');
//         Route::get('{id}/invoice-download', [TransactionController::class, 'invoiceDownload'])->name('invoice.download');
//     });

//     Route::group(['as' => 'analytics.', 'prefix' => 'analytics'], function () {
//         Route::get('/', [CardController::class, 'analytics'])->name('index');
//     });
// });

// Route::get('/admin', function () {
//     return redirect('/admin/login');
// });
// Route::get('/invoice/{id}/download', [TransactionController::class, 'invoiceDownload'])->name('invoice.download');
// Route::get('{id}/invoice-view', [TransactionController::class, 'invoiceView'])->name('invoice.view');
// Route::get('/{card_url}', [HomeController::class, 'getPreview'])->name('card.preview')->middleware(['analytics', 'setCardLanguage']);
// Route::post('exchange-contact', [CardController::class, 'contactSubmit'])->name('user.card.query.submit');
// Route::post('/update-contact/{card_id}', [CardController::class, 'updateContactSaved'])->name('update.contact.saved');
