<?php

use App\Http\Controllers\CannedCommentController;
use App\Http\Controllers\DamageAreaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PreExistingConditionController;
use App\Http\Controllers\ProfileSettingController;
use App\Http\Controllers\QuotationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect(route('login'));
})->name('home');

Route::get('/admin/quotations/quotation-summary/{encoded_id?}', [QuotationController::class, 'quotationSummary'])->name('admin.quotation.quotation-summary');

Route::get('admin/quotations/print-summary/{encoded_id}', [QuotationController::class, 'printSummary'])->name('admin.quotation.print_summary');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/change-theme', [ProfileSettingController::class, 'changeTheme'])->name('change_theme');

    Route::get('/terms-conditions', function () {
        return view('pages.terms_and_conditions');
    })->name('terms_conditions');

    Route::get('/privacy-policy', function () {
        return view('pages.privacy_policy');
    })->name('privacy_policy');

    Route::get('/profile', [ProfileSettingController::class, 'profileSettings'])->name('profile');
    Route::get('/check-vehicle-registration', [ProfileSettingController::class, 'checkVehicleRegistration'])->name('check_vehicle_registration');
    Route::post('/update-profile', [ProfileSettingController::class, 'updateProfile'])->name('update_profile');
    Route::get('/change-password', [ProfileSettingController::class, 'getChangePassword'])->name('get_change_password');
    Route::post('/change-password', [ProfileSettingController::class, 'changePassword'])->name('change_password');
    Route::post('/update-company', [ProfileSettingController::class, 'updateCompany'])->name('update_company');
    Route::get('/email-and-comments', [ProfileSettingController::class, 'getEmailAndComments'])->name('get_email_and_comments');
    Route::post('/update-email-template', [ProfileSettingController::class, 'updateEmailTemplate'])->name('update_email_template');
    Route::resource('canned-comments', CannedCommentController::class);
    Route::resource('pre-existing-conditions', PreExistingConditionController::class);

    Route::prefix('quotations')->name('quotation.')->group(function () {
        Route::post('/customer-search', [QuotationController::class, 'customerSearch'])->name('customer_search');
        Route::post('/get-customer', [QuotationController::class, 'getCustomer'])->name('get_customer');
        Route::post('/submit-page-data', [QuotationController::class, 'submitPageData'])->name('submit_page_data');
        Route::post('/custom-damaged-area', [QuotationController::class, 'addCustomDamagedArea'])->name('add_custom_damaged_area');
        Route::post('/custom-part', [QuotationController::class, 'addCustomPart'])->name('add_custom_part');

        Route::get('/my-quotations', [QuotationController::class, 'myQuotations'])->name('my_quotations');

        Route::get('/new-quotation/{encoded_id?}', [QuotationController::class, 'create'])->name('new_quotation');

        Route::get('/cancel-quote', [QuotationController::class, 'cancelQuote'])->name('cancel_quote');

        Route::get('/submit-discount', [QuotationController::class, 'submitDiscount'])->name('submit_discount');

        // Route::get('/quotation_summary/{encoded_id}', [QuotationController::class, 'quotationSummary'])->name('quotation_summary');

        Route::get('/edit-quote/{encoded_id}', [QuotationController::class, 'editQuote'])->name('edit_quote');
        Route::get('/edit-quote-summary/{encoded_id}', [QuotationController::class, 'edit'])->name('edit_quote_summary');

        Route::post('/check-vehical-reg', [QuotationController::class, 'checkVehicalReg'])->name('check_vehical_reg');

        Route::get('/mark-complete/{encodedId}', function () {
            return 'mark_complete';
        })->name('mark_complete');

        Route::post('/submit-summary', [QuotationController::class, 'submitSummary'])->name('submit_summary');

        Route::post('/approve-current-quote', [QuotationController::class, 'approveCurrentQuote'])->name('approve_current_quote');
        Route::post('/update-quote/{quoteId}', [QuotationController::class, 'updateQuote'])->name('update_quote');
        Route::post('/update-summary/{quoteId}', [QuotationController::class, 'updateSummary'])->name('update_summary');
        Route::post('/delete-quote/{encodedId}', [QuotationController::class, 'destroy'])->name('delete_quote');

        Route::post('/upload-pre-images', [ImageController::class, 'uploadPreImages'])->name('upload_pre_images');
        Route::delete('/delete-quote-image/{id}', [ImageController::class, 'deleteQuoteImage'])->name('delete_quote_image');
        Route::post('/check-image-attached', [ImageController::class, 'checkImageAttached'])->name('check_image_attached');
        Route::post('/check-email-attachment/{quote}', [ImageController::class, 'checkEmailAttachment'])->name('check_email_attachment');

        Route::post('/parts/store', [PartController::class, 'store'])->name('parts.store');
        Route::post('/damage-areas/store', [DamageAreaController::class, 'store'])->name('damage_areas.store');

        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    });

});


require __DIR__.'/auth.php';
