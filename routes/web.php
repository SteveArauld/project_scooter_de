<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\FAQController;
use App\Http\Controllers\Front\CareerController;
use App\Http\Controllers\Front\StoresController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\Front\LegalController;
use App\Http\Controllers\Front\TermsController;
use App\Http\Controllers\Front\WithdrawalController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\DeliveryController;
use App\Http\Controllers\Front\WarrantyController;
use App\Http\Controllers\Front\CookiesController;
use App\Http\Controllers\Front\SitemapController;
use App\Http\Controllers\Front\MerchantFeedController;
use App\Http\Controllers\Front\RobotsController;

/*
|--------------------------------------------------------------------------
| Frontend-Routen – Onlineshop für E-Roller und E-Scooter
|--------------------------------------------------------------------------
| Alle URLs sind deutschsprachig (SEO + Google Merchant Center).
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Kategorien & Produkte
Route::get('/kategorie/{slug}', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/api/produkt/{slug}', [ProductController::class, 'quick'])->name('products.quick');
Route::prefix('produkte')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});

// Warenkorb (localStorage) & Bestellung
Route::get('/warenkorb', [CartController::class, 'index'])->name('cart');
Route::get('/kasse', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/kasse', [OrderController::class, 'store'])->name('order.store');

// Informationsseiten
Route::get('/ueber-uns', [AboutController::class, 'index'])->name('about');
Route::get('/kontakt', [ContactController::class, 'index'])->name('contact');
Route::post('/kontakt', [ContactController::class, 'send'])->name('contact.send');
Route::get('/faq', [FAQController::class, 'index'])->name('faq');
Route::get('/karriere', [CareerController::class, 'index'])->name('career');
Route::get('/filialen', [StoresController::class, 'index'])->name('stores');

/*
| Rechtlich erforderliche Seiten
| (Pflicht für den deutschen Markt und das Google Merchant Center)
*/
Route::get('/impressum', [LegalController::class, 'index'])->name('imprint');
Route::get('/datenschutz', [PrivacyController::class, 'index'])->name('privacy');
Route::get('/agb', [TermsController::class, 'index'])->name('terms');
Route::get('/widerrufsrecht', [WithdrawalController::class, 'index'])->name('withdrawal');
Route::get('/versand-und-rueckgabe', [DeliveryController::class, 'index'])->name('shipping');
Route::get('/zahlungsarten', [PaymentController::class, 'index'])->name('payment');
Route::get('/garantie', [WarrantyController::class, 'index'])->name('warranty');
Route::get('/cookie-richtlinie', [CookiesController::class, 'index'])->name('cookies');

// SEO
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Produktdatenfeed für das Google Merchant Center
Route::get('/merchant-feed.xml', [MerchantFeedController::class, 'index'])->name('merchant.feed');

Route::get('/robots.txt', [RobotsController::class, 'index'])->name('robots');
