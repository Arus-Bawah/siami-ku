<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CmsMiddleware;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\UsersController;
use App\Http\Controllers\CMS\UnitController;
use Faker\Factory as Faker;

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

Route::get('/csrf', function () {
    return response()->json([
        'status' => true,
        'message' => 'Token has been created',
        'data' => csrf_token()
    ]);
});

Route::get('/', function () {
    return redirect()->to(route('auth.login'));
});

/**
 * New Route CMS
 */
Route::group([
    'middleware' => [CmsMiddleware::class]
], function () {
    Route::group([
        'prefix' => 'auth',
        'as' => 'auth.',
    ], function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'doLogin'])->name('login.submit');
        Route::get('/logout', [AuthController::class, 'doLogout'])->name('logout');
    });

    Route::group([
        'prefix' => 'dashboard',
        'as' => 'dashboard.',
    ], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    Route::group([
        'prefix' => 'master/users',
        'as' => 'master.users.',
    ], function () {
        Route::get('/', [UsersController::class, 'index'])->name('index');
        Route::get('/add', [UsersController::class, 'add'])->name('add');
        Route::post('/save', [UsersController::class, 'save'])->name('save');
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UsersController::class, 'update'])->name('update');
        Route::post('/delete/{id?}', [UsersController::class, 'delete'])->name('delete');
    });

    Route::group([
        'prefix' => 'master/unit',
        'as' => 'master.unit.',
    ], function () {
        Route::get('/', [UnitController::class, 'index'])->name('index');
        Route::get('/add', [UnitController::class, 'add'])->name('add');
        Route::post('/save', [UnitController::class, 'save'])->name('save');
        Route::get('/edit/{id}', [UnitController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [UnitController::class, 'update'])->name('update');
        Route::post('/delete/{id?}', [UnitController::class, 'delete'])->name('delete');
    });
});

Route::get('/export/pdf', function () {
    $faker = Faker::create('id_ID');
    $pdf = \Illuminate\Support\Facades\App::make('dompdf.wrapper');
    $pdf->loadView('export.audit-internal', ['faker' => $faker]);
    $pdf->setOptions([
        'dpi' => 150,
        'defaultFont' => 'sans-serif',
        'font_height_ratio' => '1',
        //        'isRemoteEnabled' => true,
        //        'isHtml5ParserEnabled' => true,
    ]);
    $pdf->setPaper('A4', 'portrait');
    return $pdf->stream();

    //    return view('export.audit-internal', []);
});
