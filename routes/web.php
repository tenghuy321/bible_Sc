<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\VlogsController;
use App\Http\Controllers\Frontend\PayWayController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\MissionController;
use App\Http\Controllers\Admin\ReadingDateController;
use App\Http\Controllers\Admin\VlogBackendController;
use App\Http\Controllers\Frontend\DonationController;
use App\Http\Controllers\Frontend\TelegramController;
use App\Http\Controllers\Admin\CatalogueBookController;
use App\Http\Controllers\Frontend\CataloguesController;
use App\Http\Controllers\Admin\VersionBackendController;
use App\Http\Controllers\Admin\CataloguesBackendController;


Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');
Route::get('/cata', [CataloguesController::class, 'index'])->name('cata');
Route::get('/cata/{cataslug}', [CataloguesController::class, 'show'])->name('catalogue.show');

Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/mission', [MissionController::class, 'index'])->name('mission');

Route::post('/send-order', [TelegramController::class, 'sendOrder'])->name('telegram.sendOrder');
Route::get('/vlogs', [VlogsController::class, 'index'])->name('vlogs');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/dashboard',function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('vlog-backend', VlogBackendController::class)->parameters(['vlog-backend' => 'vlog'])->except(['destroy', 'show']);
    Route::get('vlog-backend/delete/{vlog}', [VlogBackendController::class, 'delete'])->name('vlog-backend.delete');

    Route::resource('version-backend', VersionBackendController::class)->parameters(['version-backend' => 'version'])->except(['destroy', 'show']);
    Route::get('version-backend/delete/{version}', [VersionBackendController::class, 'delete'])->name('version-backend.delete');

    Route::resource('catalogues-backend', CataloguesBackendController::class)->parameters(['catalogues-backend' => 'catalogues'])->except(['destroy', 'show']);
    Route::get('catalogues-backend/delete/{catalogues}', [CataloguesBackendController::class, 'delete'])->name('catalogues-backend.delete');

    Route::resource('catabook-backend', CatalogueBookController::class)->parameters(['catabook-backend' => 'catabook'])->except(['destroy', 'show']);
    Route::get('catabook-backend/delete/{catabook}', [CatalogueBookController::class, 'delete'])->name('catabook-backend.delete');

    Route::resource('readingdate', ReadingDateController::class)->parameters(['readingdate' => 'reading'])->except(['destroy', 'show']);
    Route::get('readingdate/delete/{reading}', [ReadingDateController::class, 'delete'])->name('readingdate.delete');

    Route::resource('book', BookController::class)->parameters(['book' => 'book'])->except(['destroy', 'show']);
    Route::get('book/delete/{book}', [BookController::class, 'delete'])->name('book.delete');

    Route::resource('chapter', ChapterController::class)->parameters(['chapter' => 'chapter'])->except(['destroy', 'show']);
    Route::get('chapter/delete/{chapter}', [ChapterController::class, 'delete'])->name('chapter.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/donations/create-payment', [DonationController::class, 'createPayment'])->name('donations.create-payment');

Route::get('/{locale}/{versionSlug}', [HomeController::class, 'show'])->name('version.show');

require __DIR__ . '/auth.php';
