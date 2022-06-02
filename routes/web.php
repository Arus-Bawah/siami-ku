<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CmsMiddleware;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\UsersController;

use App\Http\Controllers\Backend\PelaksanaanController;
use App\Http\Controllers\Backend\PenjadwalanController;
use App\Http\Controllers\Module\AdminCmsMenuController;
use App\Http\Controllers\Backend\MasterFakultasController;
use App\Http\Controllers\Backend\MasterProgdiController;
use App\Http\Controllers\Backend\AuditorController;
use App\Http\Controllers\Backend\AuditeeController;
use App\Http\Controllers\Backend\VisitorController;
use App\Http\Controllers\Backend\MasterLembagaController;
use App\Http\Controllers\Backend\MasterBiroController;
use App\Http\Controllers\Backend\MasterUptController;
use App\Http\Controllers\Backend\MasterLabController;
use App\Http\Controllers\Module\UsersAdminController;
use App\Http\Controllers\Module\PrivilegesController;
use App\Http\Controllers\Backend\MasterTemplateController;
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
    return redirect('auth/login');
});

/**
 * New Route CMS
 */
Route::group([
    'middleware' => [CmsMiddleware::class]
], function () {
    Route::group([
        'prefix' => 'auth',
    ], function () {
        Route::get('/login', [AuthController::class, 'index']);
        Route::post('/login', [AuthController::class, 'doLogin']);
        Route::get('/logout', [AuthController::class, 'doLogout']);
    });

    Route::group([
        'prefix' => 'dashboard',
    ], function () {
        Route::get('/', [DashboardController::class, 'index']);
    });

    Route::group([
        'prefix' => 'master/users',
    ], function () {
        Route::get('/', [UsersController::class, 'index']);
        Route::get('/add', [UsersController::class, 'add']);
        Route::post('/save', [UsersController::class, 'save']);
        Route::get('/edit/{id}', [UsersController::class, 'edit']);
        Route::post('/update/{id}', [UsersController::class, 'update']);
        Route::post('/delete', [UsersController::class, 'delete']);
    });
});






Route::group([
    'prefix' => 'admin',
    "namespace" => 'Admin',
    'middleware' => ['adminAuth']
], function () {
    // Route::get('/dashboard', [DashboardController::class, 'getIndex']);

    Route::group([
        'prefix' => 'pelaksanaan',
        "namespace" => 'Pelaksanaan',
    ], function () {
        Route::get('/', [PelaksanaanController::class, 'getIndex']);
        Route::get('/add', [PelaksanaanController::class, 'getAdd']);
        Route::get('/edit/{id}', [PelaksanaanController::class, 'getEdit']);
        Route::get('/audit/{id}', [PelaksanaanController::class, 'getAudit']);
        Route::get('/submit-audit/{id}', [PelaksanaanController::class, 'getSubmitAudit']);
        Route::get('/do-audit/{id}', [PelaksanaanController::class, 'getDoAudit']);
        Route::get('/do-temuan/{id}', [PelaksanaanController::class, 'getTemuan']);
        Route::get('/do-perbaikan/{id}', [PelaksanaanController::class, 'getPerbaikan']);
        Route::post('/do-temuan/save/{id}', [PelaksanaanController::class, 'postTemuanSubmit']);
        Route::get('/list-temuan/{id}', [PelaksanaanController::class, 'getListTemuan']);
        Route::get('/delete-temuan/{id}', [PelaksanaanController::class, 'getDeleteTemuan']);
        Route::get('/data-audit/{id}', [PelaksanaanController::class, 'getAuditData']);
        Route::get('/delete/{id}', [PelaksanaanController::class, 'getDelete']);
        Route::post('/save', [PelaksanaanController::class, 'postSaveData']);
        Route::post('/save-answer', [PelaksanaanController::class, 'postSaveAnswer']);
    });

    Route::group([
        'prefix' => 'template',
        "namespace" => 'Template',
    ], function () {
        Route::get('/', [MasterTemplateController::class, 'getIndex']);
        Route::get('/list-data', [MasterTemplateController::class, 'getListData']);
        Route::get('/add', [MasterTemplateController::class, 'getAdd']);
        Route::get('/add/step-2/{id}', [MasterTemplateController::class, 'getStep2']);
        Route::get('/add/step-3/{id}', [MasterTemplateController::class, 'getStep3']);
        Route::get('/edit/{id}', [MasterTemplateController::class, 'getEdit']);
        Route::get('/delete/{id}', [MasterTemplateController::class, 'getDelete']);
        Route::get('/detail/{id}', [MasterTemplateController::class, 'getDetail']);
        Route::post('/save', [MasterTemplateController::class, 'postSaveData']);
        Route::get('/success', [MasterTemplateController::class, 'getSuccess']);
        Route::get('/add-question', [MasterTemplateController::class, 'getAddQuestion']);
        Route::get('/update-question', [MasterTemplateController::class, 'getUpdateQuestion']);
        Route::post('/add/kriteria', [MasterTemplateController::class, 'postSaveKriteria']);
        Route::get('/delete-kriteria', [MasterTemplateController::class, 'getDeleteKriteria']);
        Route::get('/update/kriteria', [MasterTemplateController::class, 'getUpdateKriteria']);
    });

    Route::group([
        'prefix' => 'penjadwalan',
        "namespace" => 'Penjadwalan',
    ], function () {
        Route::get('/', [PenjadwalanController::class, 'getIndex']);
        Route::get('/add', [PenjadwalanController::class, 'getAdd']);
        Route::get('/edit/{id}', [PenjadwalanController::class, 'getEdit']);
        Route::get('/delete/{id}', [PenjadwalanController::class, 'getDelete']);
        Route::get('/detail/{id}', [PenjadwalanController::class, 'getDetail']);
        Route::get('/publish/{id}', [PenjadwalanController::class, 'getPublish']);
        Route::get('/un-publish/{id}', [PenjadwalanController::class, 'getUnPublish']);
        Route::post('/save', [PenjadwalanController::class, 'postSaveData']);
    });

    Route::group([
        'prefix' => 'fakultas',
        "namespace" => 'Fakultas',
    ], function () {
        Route::get('/', [MasterFakultasController::class, 'getIndex']);
        Route::get('/add', [MasterFakultasController::class, 'getAdd']);
        Route::get('/edit/{id}', [MasterFakultasController::class, 'getEdit']);
        Route::get('/delete/{id}', [MasterFakultasController::class, 'getDelete']);
        Route::post('/save', [MasterFakultasController::class, 'postSaveData']);
    });

    Route::group([
        'prefix' => 'progdi',
        "namespace" => 'Progdi',
    ], function () {
        Route::get('/', [MasterProgdiController::class, 'getIndex']);
        Route::get('/add', [MasterProgdiController::class, 'getAdd']);
        Route::get('/edit/{id}', [MasterProgdiController::class, 'getEdit']);
        Route::get('/delete/{id}', [MasterProgdiController::class, 'getDelete']);
        Route::post('/save', [MasterProgdiController::class, 'postSaveData']);
    });

    Route::group([
        'prefix' => 'lembaga',
        "namespace" => 'Lembaga',
    ], function () {
        Route::get('/', [MasterLembagaController::class, 'getIndex']);
        Route::get('/add', [MasterLembagaController::class, 'getAdd']);
        Route::get('/edit/{id}', [MasterLembagaController::class, 'getEdit']);
        Route::get('/delete/{id}', [MasterLembagaController::class, 'getDelete']);
        Route::post('/save', [MasterLembagaController::class, 'postSaveData']);
    });

    Route::group([
        'prefix' => 'biro',
        "namespace" => 'Biro',
    ], function () {
        Route::get('/', [MasterBiroController::class, 'getIndex']);
        Route::get('/add', [MasterBiroController::class, 'getAdd']);
        Route::get('/edit/{id}', [MasterBiroController::class, 'getEdit']);
        Route::get('/delete/{id}', [MasterBiroController::class, 'getDelete']);
        Route::post('/save', [MasterBiroController::class, 'postSaveData']);
    });

    Route::group([
        'prefix' => 'upt',
        "namespace" => 'UPT',
    ], function () {
        Route::get('/', [MasterUptController::class, 'getIndex']);
        Route::get('/add', [MasterUptController::class, 'getAdd']);
        Route::get('/edit/{id}', [MasterUptController::class, 'getEdit']);
        Route::get('/delete/{id}', [MasterUptController::class, 'getDelete']);
        Route::post('/save', [MasterUptController::class, 'postSaveData']);
    });

    Route::group([
        'prefix' => 'lab',
        "namespace" => 'Lab',
    ], function () {
        Route::get('/', [MasterLabController::class, 'getIndex']);
        Route::get('/add', [MasterLabController::class, 'getAdd']);
        Route::get('/edit/{id}', [MasterLabController::class, 'getEdit']);
        Route::get('/delete/{id}', [MasterLabController::class, 'getDelete']);
        Route::post('/save', [MasterLabController::class, 'postSaveData']);
    });

    Route::get('/akun', [UsersAdminController::class, 'getProfile']);
    Route::group([
        'prefix' => '/users-admin',
        "namespace" => 'UsersAdmin',
    ], function () {
        Route::get('/', [UsersAdminController::class, 'getIndex']);
        Route::get('/add', [UsersAdminController::class, 'getAdd']);
        Route::get('/edit/{id}', [UsersAdminController::class, 'getEdit']);
        Route::get('/delete/{id}', [UsersAdminController::class, 'getDelete']);
        Route::post('/save', [UsersAdminController::class, 'postSaveData']);
        Route::post('/save-profile', [UsersAdminController::class, 'postSaveProfile']);
    });

    Route::group([
        'prefix' => 'privileges',
        "namespace" => 'Privileges',
    ], function () {
        Route::get('/', [PrivilegesController::class, 'getIndex']);
        Route::get('/add', [PrivilegesController::class, 'getAdd']);
        Route::get('/edit/{id}', [PrivilegesController::class, 'getEdit']);
        Route::get('/delete/{id}', [PrivilegesController::class, 'getDelete']);
        Route::post('/save', [PrivilegesController::class, 'postSaveData']);
    });

    Route::group([
        'prefix' => 'auditor',
        "namespace" => 'Auditor',
    ], function () {
        Route::get('/', [AuditorController::class, 'getIndex']);
        Route::get('/add', [AuditorController::class, 'getAdd']);
        Route::get('/edit/{id}', [AuditorController::class, 'getEdit']);
        Route::get('/delete/{id}', [AuditorController::class, 'getDelete']);
        Route::post('/save', [AuditorController::class, 'postSaveData']);
    });

    Route::group([
        'prefix' => 'auditee',
        "namespace" => 'Auditee',
    ], function () {
        Route::get('/', [AuditeeController::class, 'getIndex']);
        Route::get('/add', [AuditeeController::class, 'getAdd']);
        Route::get('/edit/{id}', [AuditeeController::class, 'getEdit']);
        Route::get('/delete/{id}', [AuditeeController::class, 'getDelete']);
        Route::post('/save', [AuditeeController::class, 'postSaveData']);
    });

    Route::group([
        'prefix' => 'visitor',
        "namespace" => 'Visitor',
    ], function () {
        Route::get('/', [VisitorController::class, 'getIndex']);
        Route::get('/add', [VisitorController::class, 'getAdd']);
        Route::get('/edit/{id}', [VisitorController::class, 'getEdit']);
        Route::get('/delete/{id}', [VisitorController::class, 'getDelete']);
        Route::post('/save', [VisitorController::class, 'postSaveData']);
    });

    Route::group([
        'prefix' => 'menu-manajemen',
        "namespace" => 'MenuManajement',
    ], function () {
        Route::get('/', [AdminCmsMenuController::class, 'getIndex']);
        Route::post('/add', [AdminCmsMenuController::class, 'postAdd']);
        Route::post('/save-menu', [AdminCmsMenuController::class, 'postSaveMenu']);
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
