use App\Http\Controllers\VisitorController;

Route::get('/api/visitor-data', [VisitorController::class, 'getVisitorData']);