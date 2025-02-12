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

        //route untuk menu navbar pada domain 
        Route::get('/domain/kebijakan', [AdminController::class, 'clientsDomainKebijakan']);
        Route::get('/domain/tatakelola', [AdminController::class, 'clientsDomainTatakelola']);
        Route::get('/domain/manajemen', [AdminController::class, 'clientsDomainManajemen']);
        Route::get('/domain/layanan', [AdminController::class, 'clientsDomainLayanan']);
        
        //Route untuk menu navbar pada material dan regulasi
        Route::get('/material', [AdminController::class, 'material'])->name('admin.material');
        Route::get('/regulasi', [AdminController::class, 'regulasi'])->name('admin.regulasi');

        Route::get('/artikel-klien', [AdminController::class, 'clientsArticle']);
        Route::get('/tentang-klien', [AdminController::class, 'clientsAbout']);
        Route::get('/aplikasi', [AdminController::class, 'application'])->name('admin.application');
        Route::post('/aplikasi/store', [AdminController::class, 'storeApplication'])->name('admin.application.store');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');

        // Menambahkan route untuk create,update, dan delete untuk beranda
        Route::get('clientsHome', [AdminController::class, 'clientsHome'])->name('admin.clientsHome');
        Route::post('homeContent', [AdminController::class, 'storeHomeContent'])->name('admin.storeHomeContent');
        Route::post('/admin/home-content/{id}', [AdminController::class, 'updateHomeContent'])->name('admin.updateHomeContent');

         // Route untuk menampilkan daftar domain kebijakan
        Route::get('domain-kebijakan', [AdminController::class, 'clientsDomainKebijakan'])->name('admin.domain.kebijakan');

        // Route untuk menyimpan domain kebijakan
        Route::post('domain-kebijakan/store', [AdminController::class, 'storeDomainKebijakan'])->name('admin.domain.kebijakan.store');

        // Route untuk mengupdate domain kebijakan
        Route::put('domain-kebijakan/update/{id}', [AdminController::class, 'updateDomainKebijakan'])->name('admin.domain.kebijakan.update');

        // Route untuk menghapus domain kebijakan
        Route::delete('domain-kebijakan/delete/{id}', [AdminController::class, 'deleteDomainKebijakan'])->name('admin.domain.kebijakan.delete');


        // Route untuk menampilkan daftar domain tatakelola
        Route::get('domain-tatakelola', [AdminController::class, 'clientsDomainTatakelola'])->name('admin.domain.tatakelola');

        // Route untuk menyimpan domain tatakelola
        Route::post('domain-tatakelola/store', [AdminController::class, 'storeDomainTatakelola'])->name('admin.domain.tatakelola.store');

        // Route untuk mengupdate domain tatakelola
        Route::put('domain-tatakelola/update/{id}', [AdminController::class, 'updateDomainTatakelola'])->name('admin.domain.tatakelola.update');

        // Route untuk menghapus domain tatakelola
        Route::delete('domain-tatakelola/delete/{id}', [AdminController::class, 'deleteDomainTatakelola'])->name('admin.domain.tatakelola.delete');

        // Route untuk menampilkan daftar domain manajemen
        Route::get('domain-manajemen', [AdminController::class, 'clientsDomainManajemen'])->name('admin.domain.manajemen');

        // Route untuk menyimpan domain manajemen
        Route::post('domain-manajemen/store', [AdminController::class, 'storeDomainManajemen'])->name('admin.domain.manajemen.store');

        // Route untuk mengupdate domain manajemen
        Route::put('domain-manajemen/update/{id}', [AdminController::class, 'updateDomainManajemen'])->name('admin.domain.manajemen.update');

        // Route untuk menghapus domain manajemen
        Route::delete('domain-manajemen/delete/{id}', [AdminController::class, 'deleteDomainManajemen'])->name('admin.domain.manajemen.delete');

        // Route untuk menampilkan daftar domain layanan
        Route::get('domain-layanan', [AdminController::class, 'clientsDomainLayanan'])->name('admin.domain.layanan');

        // Route untuk menyimpan domain layanan
        Route::post('domain-layanan/store', [AdminController::class, 'storeDomainLayanan'])->name('admin.domain.layanan.store');

        // Route untuk mengupdate domain layanan
        Route::put('domain-layanan/update/{id}', [AdminController::class, 'updateDomainLayanan'])->name('admin.domain.layanan.update');

        // Route untuk menghapus domain layanan
        Route::delete('domain-layanan/delete/{id}', [AdminController::class, 'deleteDomainLayanan'])->name('admin.domain.layanan.delete');


        // Menambahkan route untuk create,update, dan delete untuk artikel
        Route::get('/clients-article', [AdminController::class, 'clientsArticle'])->name('clients.article');
        Route::post('/clients-article/store', [AdminController::class, 'storeArticle'])->name('clients.article.store');
        Route::post('/clients-article/update/{id}', [AdminController::class, 'updateArticle'])->name('clients.article.update');
        Route::delete('/clients-article/delete/{id}', [AdminController::class, 'deleteArticle'])->name('clients.article.delete');

        Route::post('/clientsAbout/store', [AdminController::class, 'storeClientsAbout'])->name('clientsAbout.store');

        // Route untuk CRUD Material di Material Controller 
        Route::post('/materials/store', [AdminController::class, 'storeMaterial'])->name('materials.store'); 
        Route::put('/materials/update/{id}', [AdminController::class, 'updateMaterial'])->name('materials.update'); 
        Route::delete('/materials/delete/{id}', [AdminController::class, 'destroyMaterial'])->name('materials.destroy');

        // Routes untuk Regulation 
        Route::get('/admin/regulasi', [AdminController::class, 'regulasi']) ->name('admin.regulasi'); 
        Route::post('/regulasi', [AdminController::class, 'storeRegulation'])->name('regulations.store'); // Menyimpan regulasi baru 
        Route::put('/regulasi/{id}', [AdminController::class, 'updateRegulation'])->name('regulations.update'); // Mengupdate regulasi 
        Route::delete('/regulasi/{id}', [AdminController::class, 'deleteRegulation'])->name('regulations.destroy'); // Menghapus 

       // Routes untuk Application 
        Route::get('/admin/application', [AdminController::class, 'application'])->name('applications.index'); 
        Route::post('/admin/application', [AdminController::class, 'storeApplication'])->name('applications.store'); 
        Route::put('/admin/application/{id}', [AdminController::class, 'updateApplication'])->name('applications.update'); 
        Route::delete('/admin/application/{id}', [AdminController::class, 'deleteApplication'])->name('applications.destroy'); 
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

