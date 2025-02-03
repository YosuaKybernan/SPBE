<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;

Route::get('/', [ClientController::class, 'index']);
Route::get('/kebijakan-spbe', [ClientController::class, 'policy']);
Route::get('/tata-kelola-spbe', [ClientController::class, 'governance']);
Route::get('/manajemen-spbe', [ClientController::class, 'management']);
Route::get('/layanan-spbe', [ClientController::class, 'service']);
Route::get('/artikel-spbe', [ClientController::class, 'article']);
Route::get('/materi-spbe', [ClientController::class, 'material']);
Route::get('/visi-misi', [ClientController::class, 'vis_mis']);
Route::get('/tujuan-sasaran', [ClientController::class, 'goals_obj']);
Route::get('/regulasi-spbe', [ClientController::class, 'regulation']);
Route::get('/artikel-spbe/{id?}', [ClientController::class, 'article'])->name('article');

Route::redirect('/admin', '/admin/dashboard');

Route::prefix('admin')->group(function () {
    // Rute yang memerlukan autentikasi
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
        Route::get('/assessment', [AdminController::class, 'assessment']);
        Route::get('/assessment-mandiri/buat', [AdminController::class, 'createAssessment']);
        Route::get('/assessment-details/{id}', [AdminController::class, 'getAssessmentDetails']);
        Route::post('/update-assessment/{id}', [AdminController::class, 'updateAssessment']);
        Route::get('/beranda-klien', [AdminController::class, 'clientsHome']);
        Route::get('/domain-klien', [AdminController::class, 'clientsDomain']);
        Route::get('/artikel-klien', [AdminController::class, 'clientsArticle']);
        Route::get('/tentang-klien', [AdminController::class, 'clientsAbout']);
        Route::get('/aplikasi', [AdminController::class, 'application'])->name('admin.application');
        Route::post('/aplikasi/store', [AdminController::class, 'storeApplication'])->name('admin.application.store');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');

        // Menambahkan route untuk create,update, dan delete untuk beranda
        Route::get('clientsHome', [AdminController::class, 'clientsHome'])->name('admin.clientsHome');
        Route::post('homeContent', [AdminController::class, 'storeHomeContent'])->name('admin.storeHomeContent');
        Route::post('/admin/home-content/{id}', [AdminController::class, 'updateHomeContent'])->name('admin.updateHomeContent');

        // Menambahkan route untuk create,update, dan delete untuk artikel
        Route::get('/clients-article', [AdminController::class, 'clientsArticle'])->name('clients.article');
        Route::post('/clients-article/store', [AdminController::class, 'storeArticle'])->name('clients.article.store');
        Route::post('/clients-article/update/{id}', [AdminController::class, 'updateArticle'])->name('clients.article.update');
        Route::delete('/clients-article/delete/{id}', [AdminController::class, 'deleteArticle'])->name('clients.article.delete');

        Route::post('/clientsAbout/store', [AdminController::class, 'storeClientsAbout'])->name('clientsAbout.store');

        // Routes untuk Material
        Route::post('/materials/store', [AdminController::class, 'storeMaterial'])->name('materials.store');
        Route::post('/materials/update/{id}', [AdminController::class, 'updateMaterial'])->name('materials.update');
        Route::delete('/materials/delete/{id}', [AdminController::class, 'destroyMaterial'])->name('materials.destroy');

        // Routes untuk Regulation
        Route::post('/regulations/store', [AdminController::class, 'storeRegulation'])->name('regulations.store');
        Route::post('/regulations/update/{id}', [AdminController::class, 'updateRegulation'])->name('regulations.update');
        Route::delete('/regulations/delete/{id}', [AdminController::class, 'destroyRegulation'])->name('regulations.destroy');
        });

    // Rute untuk login, signup, dan logout
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/signup', [AuthController::class, 'showSignupForm']);
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::get('/check-email', [AuthController::class, 'checkEmail']);
    Route::get('/check-username', [AuthController::class, 'checkUsername']);
    Route::get('/account-created', [AuthController::class, 'accountCreated']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
