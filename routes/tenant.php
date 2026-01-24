<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantAuthController;
use App\Http\Controllers\CoreController; // Renamed/Refactored TenantDashboardController
use App\Http\Controllers\ContractController; // NEW
use App\Http\Controllers\SettingController;  // NEW
use App\Http\Controllers\ReportController;   // NEW

// Routes are prefixed with the shop domain for multi-tenancy
Route::prefix('shop/{tenant_domain}')->group(function () {

    // Authentication Routes (outside the main middleware group)
    Route::get('/login', [TenantAuthController::class, 'showLoginForm'])->name('tenant.login');
    Route::post('/login', [TenantAuthController::class, 'login']);

    // Protected Routes Group
    Route::middleware(['auth:tenant', 'identify.tenant', 'bind.current.store'])->group(function () {

        // --- 1. CORE & SIMPLE NAVIGATION (Handled by CoreController) ---
        // (Previously TenantDashboardController)
        Route::get('/dashboard', [CoreController::class, 'index'])->name('tenant.dashboard');
        Route::get('/device-mgmt', [CoreController::class, 'devicemgmt'])->name('tenant.device-mgmt');
        Route::get('/inventory', [CoreController::class, 'inventory'])->name('tenant.inventory');
        Route::get('/enrollment', [CoreController::class, 'enrollment'])->name('tenant.enrollment');
        Route::get('/reports', [CoreController::class, 'reports'])->name('tenant.reports'); // General reports page
        Route::get('/admin', [CoreController::class, 'admin'])->name('tenant.admin');
        Route::get('/support', [CoreController::class, 'support'])->name('tenant.support');
        Route::get('/swtichStore', [CoreController::class, 'switchStore'])->name('tenant.switch.store');
        Route::get('/training', [CoreController::class, 'training'])->name('tenant.training');
        Route::get('/provisioning', [CoreController::class, 'deviceProvisioning'])->name('tenant.device-provisioning');
        Route::get('/provisioning/create', [CoreController::class, 'deviceProvisioningCreate'])->name('tenant.device-provisioning.create');
        Route::post('/provisioning/verify/{batch}', [CoreController::class, 'verifyProvisionedDevice'])->name('tenant.device.verify');
        Route::get('/device-provisioning/{id}/edit', [CoreController::class, 'editDevice'])
        ->name('tenant.device-provisioning.edit');
        Route::put('/device-provisioning/{id}', [CoreController::class, 'updateDevice'])
            ->name('tenant.device-provisioning.update');
        Route::delete('/device-provisioning/{id}', [CoreController::class, 'deleteDevice'])
            ->name('tenant.device-provisioning.delete');
        Route::post('/provisioning/store', [CoreController::class, 'deviceProvisioningStore'])->name('tenant.device-provisioning.store');
        Route::get('/referral', [CoreController::class, 'referral'])->name('tenant.referral');
        Route::get('/resources', [CoreController::class, 'resources'])->name('tenant.resources');
        Route::get('/resources/{slug}', [CoreController::class, 'resourcesPage'])->name('tenant.resources.page');

        // --- 2. CONTRACT MANAGEMENT (Handled by ContractController) ---
        Route::prefix('contract')->group(function () {
            // General views
            Route::get('/', [ContractController::class, 'index'])->name('tenant.contract');
            Route::get('/search', [ContractController::class, 'search'])->name('tenant.contract.search');
            Route::get('/all', [ContractController::class, 'index'])->name('tenant.contract.index');
            Route::get('{id}/details/', [ContractController::class, 'details'])->name('tenant.contract.details');
            Route::post('reschedule/', [ContractController::class, 'reschedule'])->name('tenant.contract.reschedule');

            // Creation Steps (GET for form, POST for submission)
            Route::get('/create', [ContractController::class, 'create'])->name('tenant.contract.create');
            Route::match(['get', 'post'], 'step1', [ContractController::class, 'step1'])->name('tenant.contract.step1');
            Route::match(['get', 'post'], '{pub_ref}/step2', [ContractController::class, 'step2'])->name('tenant.contract.step2');
            Route::post('{pub_ref}/step2/address-verify', [ContractController::class, 'step2addressVerify'])
                ->name('tenant.contract.step2.addressVerify');

            Route::post('{pub_ref}/step2/email-verify', [ContractController::class, 'step2EmailVerify'])
                ->name('tenant.contract.step2.emailVerify');

            Route::post('{pub_ref}/step2/email-verify-confirm', [ContractController::class, 'step2EmailVerifyConfirm'])
                ->name('tenant.contract.step2.emailVerifyConfirm');
            Route::match(['get', 'post'], '{pub_ref}/step3', [ContractController::class, 'step3'])->name('tenant.contract.step3');
            Route::post('{pub_ref}/documentRequest', [ContractController::class, 'documentRequest'])->name('tenant.contract.documentRequest');
            Route::get('{pub_ref}/checkUploadedDocs', [ContractController::class, 'checkUploadedDocs'])->name('tenant.contract.checkUploadedDocs');
            Route::match(['get', 'post'], '{pub_ref}/step4', [ContractController::class, 'step4'])->name('tenant.contract.step4');
            Route::match(['get', 'post'], '{pub_ref}/step5', [ContractController::class, 'step5'])->name('tenant.contract.step5');
            Route::match(['get', 'post'], '{pub_ref}/step6', [ContractController::class, 'step6'])->name('tenant.contract.step6');
            Route::match(['get', 'post'], '{pub_ref}/step7', [ContractController::class, 'step7'])->name('tenant.contract.step7');
            Route::post('payment/{pub_ref}/process', [ContractController::class, 'processStripePayment'])->name('tenant.contract.processPayment');
            Route::get('{pub_ref}/step8', [ContractController::class, 'step8'])->name('tenant.contract.step8');

        });

        // --- 3. SETTINGS MANAGEMENT (Handled by SettingController) ---
        Route::prefix('setting')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('tenant.setting');

            // Store Settings
            Route::get('/stores', [SettingController::class, 'storesIndex'])->name('tenant.setting.stores');
            Route::get('/stores/{store}/edit', [SettingController::class, 'editStore'])->name('tenant.setting.stores.edit');
            Route::put('/stores/{store}/update', [SettingController::class, 'updateStore'])->name('tenant.setting.stores.update');

            // User Settings
            Route::get('/users', [SettingController::class, 'usersIndex'])->name('tenant.setting.users');
            Route::get('/users/create', [SettingController::class, 'usersCreate'])->name('tenant.setting.users.create');
            Route::post('/users/store', [SettingController::class, 'usersStore'])->name('tenant.setting.users.store');
            Route::get('/users/{id}/edit', [SettingController::class, 'usersEdit'])->name('tenant.setting.users.edit');
            Route::put('/users/{id}/update', [SettingController::class, 'usersUpdate'])->name('tenant.setting.users.update');
        });

        // --- 4. REPORT MANAGEMENT (Handled by ReportController) ---
        Route::prefix('report')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('tenant.report'); // Redundant with /reports above, keeping for consistency
            Route::get('/portfolio', [ReportController::class, 'portfolio'])->name('tenant.report.portfolio');
            Route::get('/sales', [ReportController::class, 'sales'])->name('tenant.report.sales');
            Route::get('/payment', [ReportController::class, 'payment'])->name('tenant.report.payment');
            Route::get('/dealer_contract_reconciliation', [ReportController::class, 'dealerContractReconciliation'])->name('tenant.report.dealer_contract_reconciliation');
            Route::get('/detailed_portfolio', [ReportController::class, 'detailedPortfolio'])->name('tenant.report.portfolio.detailed');
        });
    });
});
