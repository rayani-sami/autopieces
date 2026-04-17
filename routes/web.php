<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CatalogController;
use App\Http\Controllers\Frontend\VehicleController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\OrderAdminController;
use App\Http\Controllers\Admin\VehicleAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\CouponAdminController;
use App\Http\Controllers\Admin\SettingAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// FRONTEND
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/recherche', [SearchController::class, 'index'])->name('search');
Route::post('/recherche/immatriculation', [SearchController::class, 'byRegistration'])->name('search.registration');
Route::get('/article/{slug}', [CatalogController::class, 'category'])->name('catalog.category');
Route::get('/auto/{makeSlug}', [VehicleController::class, 'models'])->name('vehicle.models');
Route::get('/auto/{makeSlug}/{modelSlug}', [VehicleController::class, 'engines'])->name('vehicle.engines');
Route::get('/auto/{makeSlug}/{modelSlug}/{engineSlug}', [VehicleController::class, 'parts'])->name('vehicle.parts');
Route::get('/auto/{makeSlug}/{modelSlug}/{engineSlug}/{categorySlug}', [VehicleController::class, 'categoryParts'])->name('vehicle.category.parts');
Route::get('/produit/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/vehicule/selectionner/{engineId}', [VehicleController::class, 'select'])->name('vehicle.select');
Route::post('/vehicule/effacer', [VehicleController::class, 'clear'])->name('vehicle.clear');

// Panier
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/ajouter', [CartController::class, 'add'])->name('cart.add');
Route::patch('/panier/modifier/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/panier/supprimer/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/panier/coupon', [CartController::class, 'applyCoupon'])->name('cart.coupon');
Route::delete('/panier/coupon', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');

// Checkout
Route::middleware(['auth'])->group(function () {
    Route::get('/commande', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/commande/passer', [CheckoutController::class, 'place'])->name('checkout.place');
    Route::get('/commande/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
});

// Compte
Route::middleware(['auth'])->prefix('compte')->name('account.')->group(function () {
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::get('/commandes', [AccountController::class, 'orders'])->name('orders');
    Route::get('/commandes/{order}', [AccountController::class, 'orderDetail'])->name('order.detail');
    Route::get('/profil', [AccountController::class, 'profile'])->name('profile');
    Route::put('/profil', [AccountController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profil/password', [AccountController::class, 'updatePassword'])->name('profile.password');
    Route::get('/adresses', [AccountController::class, 'addresses'])->name('addresses');
    Route::post('/adresses', [AccountController::class, 'storeAddress'])->name('addresses.store');
    Route::put('/adresses/{address}', [AccountController::class, 'updateAddress'])->name('addresses.update');
    Route::delete('/adresses/{address}', [AccountController::class, 'deleteAddress'])->name('addresses.delete');
    Route::get('/vehicules', [AccountController::class, 'vehicles'])->name('vehicles');
    Route::post('/vehicules', [AccountController::class, 'storeVehicle'])->name('vehicles.store');
    Route::delete('/vehicules/{vehicle}', [AccountController::class, 'deleteVehicle'])->name('vehicles.delete');
});

// Pages
Route::get('/support', fn() => view('frontend.support'))->name('support');
Route::get('/conditions-generales-de-vente', fn() => view('frontend.cgv'))->name('cgv');
Route::get('/politique-de-confidentialite', fn() => view('frontend.privacy'))->name('privacy');
Route::get('/contact', fn() => view('frontend.contact'))->name('contact');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.send');

// AUTH
Route::get('/connexion', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/connexion', [LoginController::class, 'login'])->middleware('guest');
Route::post('/deconnexion', [LoginController::class, 'logout'])->name('logout');
Route::get('/inscription', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/inscription', [RegisterController::class, 'register'])->middleware('guest');
Route::get('/mot-de-passe-oublie', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/mot-de-passe-oublie', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reinitialiser/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reinitialiser', [ResetPasswordController::class, 'reset'])->name('password.update');

// ADMIN
Route::middleware(['auth', 'role:admin|manager'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('produits', ProductAdminController::class);
    Route::post('produits/{product}/images', [ProductAdminController::class, 'uploadImage'])->name('produits.images.upload');
    Route::delete('produits/images/{image}', [ProductAdminController::class, 'deleteImage'])->name('produits.images.delete');
    Route::post('produits/{product}/compatibilites', [ProductAdminController::class, 'updateCompatibilities'])->name('produits.compatibilities');
    Route::resource('categories', CategoryAdminController::class);
    Route::get('commandes', [OrderAdminController::class, 'index'])->name('commandes.index');
    Route::get('commandes/{order}', [OrderAdminController::class, 'show'])->name('commandes.show');
    Route::patch('commandes/{order}/statut', [OrderAdminController::class, 'updateStatus'])->name('commandes.status');
    Route::get('commandes/{order}/facture', [OrderAdminController::class, 'invoice'])->name('commandes.invoice');
    Route::resource('marques', VehicleAdminController::class)->parameters(['marques' => 'make']);
    Route::get('marques/{make}/modeles', [VehicleAdminController::class, 'modelIndex'])->name('marques.modeles.index');
    Route::post('marques/{make}/modeles', [VehicleAdminController::class, 'modelStore'])->name('marques.modeles.store');
    Route::get('modeles/{model}/motorisations', [VehicleAdminController::class, 'engineIndex'])->name('modeles.motorisations.index');
    Route::post('modeles/{model}/motorisations', [VehicleAdminController::class, 'engineStore'])->name('modeles.motorisations.store');
    Route::delete('modeles/{model}', [VehicleAdminController::class, 'modelDestroy'])->name('modeles.destroy');
    Route::delete('motorisations/{engine}', [VehicleAdminController::class, 'engineDestroy'])->name('motorisations.destroy');
    Route::resource('utilisateurs', UserAdminController::class)->parameters(['utilisateurs' => 'user']);
    Route::patch('utilisateurs/{user}/toggle', [UserAdminController::class, 'toggle'])->name('utilisateurs.toggle');
    Route::resource('coupons', CouponAdminController::class);
    Route::get('parametres', [SettingAdminController::class, 'index'])->name('settings.index');
    Route::post('parametres', [SettingAdminController::class, 'update'])->name('settings.update');
    Route::post('bannieres', [SettingAdminController::class, 'storeBanner'])->name('bannieres.store');
    Route::delete('bannieres/{banner}', [SettingAdminController::class, 'destroyBanner'])->name('bannieres.destroy');
});
