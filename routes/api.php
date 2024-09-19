<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\API\CannedCommentController;
use App\Http\Controllers\API\PreExistingConditionController;
use App\Http\Controllers\API\ProfileSettingController;
use App\Http\Controllers\API\QuotationController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');

Route::get('/print-summary/{encodeId}', [QuotationController::class, 'getPrintSummary'])->middleware('guest');

// Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
//                 ->middleware('guest')
//                 ->name('password.reset');

// Route::post('/reset-password', [NewPasswordController::class, 'store'])
//                 ->middleware('guest')
//                 ->name('password.update');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Profile Settings APIs
    Route::get('/profile-details', [ProfileSettingController::class, 'getProfileDetails']);
    Route::post('/profile-details', [ProfileSettingController::class, 'updateProfileDetails']);

    Route::post('/change-password', [ProfileSettingController::class, 'changePassword']);
    Route::post('/change-theme', [ProfileSettingController::class, 'changeTheme']);

    Route::get('/company-details', [ProfileSettingController::class, 'getCompanyDetails']);
    Route::get('/timezone-list', [ProfileSettingController::class, 'getTimezoneList']);
    Route::post('/company-details', [ProfileSettingController::class, 'updateCompanyDetails']);

    Route::get('/email-template', [ProfileSettingController::class, 'getEmailTemplate']);
    Route::post('/email-template', [ProfileSettingController::class, 'updateEmailTemplate']);

    Route::get('/canned-comments', [CannedCommentController::class, 'getCannedComments']);
    Route::get('/all-canned-comments', [CannedCommentController::class, 'getAllCannedComments']);
    Route::post('/canned-comments', [CannedCommentController::class, 'createCannedComment']);
    Route::post('/canned-comments/{id}', [CannedCommentController::class, 'deleteCannedComment']);

    Route::get('/pre-existing-conditions', [PreExistingConditionController::class, 'getPreExistingConditions']);

    Route::get('/quotations', [QuotationController::class, 'index']);
    Route::post('/quotations', [QuotationController::class, 'store']);
    Route::post('/quotations/delete/{id}', [QuotationController::class, 'destroyQuotation']);
    Route::get('/quotations/edit/{id}', [QuotationController::class, 'editQuotation']);
    Route::post('/quotations/edit/{id}', [QuotationController::class, 'updateQuotation']);
    Route::get('/quotations/edit-summary/{id}', [QuotationController::class, 'editSummary']);
    Route::post('/quotations/edit-summary/{id}', [QuotationController::class, 'updateSummary']);
    Route::post('/custom-damaged-area', [QuotationController::class, 'addCustomDamagedArea']);
    Route::post('/custom-part', [QuotationController::class, 'addCustomPart']);
    Route::post('/check-vehicle-reg', [QuotationController::class, 'checkVehicleReg']);
    Route::get('/states', [QuotationController::class, 'getStates']);
    Route::get('/damaged-areas', [QuotationController::class, 'getDamagedAreas']);
    Route::get('/parts', [QuotationController::class, 'getParts']);
    Route::get('/customers-list', [QuotationController::class, 'getCustomersList']);
    Route::post('/customer-detail', [QuotationController::class, 'getCustomerDetail']);

    Route::get('/quotation-summary/{encodedId}', [QuotationController::class, 'getSummaryData']);
    Route::post('/quotation-summary/approve', [QuotationController::class, 'approveSummary']);

    Route::get('/notifications', [NotificationController::class, 'index']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
