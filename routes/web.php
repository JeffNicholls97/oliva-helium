<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Livewire\AccountInvoiceList;

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

Route::get('/admin/', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth']);
Route::get('/admin/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth'])->name('admin.dashboard');

Route::get('/admin/accounts', [\App\Http\Controllers\AccountsController::class, 'index'])->middleware(['auth'])->name('admin.accounts');
Route::get('/admin/accounts/{id}', [\App\Http\Controllers\AccountsController::class, 'show'])->middleware(['auth'])->name('admin.accounts.show');

Route::get('/admin/invoices', [\App\Http\Controllers\InvoicesController::class, 'index'])->middleware(['auth'])->name('admin.invoices');

Route::get('/admin/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->middleware(['auth'])->name('admin.settings');

Route::get('/admin/downloadInvoice/{id}/{account}', [AccountInvoiceList::class, 'downloadInvoice'])->name('admin.download');


require __DIR__.'/auth.php';
