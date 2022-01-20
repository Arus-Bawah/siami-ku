<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
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

Route::get('/', function () {
    return redirect(adminUrl());
});

Route::group(['prefix' => 'auth'] ,function () {
    Route::get('/login', [AuthController::class, 'getIndex']);
    Route::get('/logout', [AuthController::class, 'getLogout']);
    Route::post('/login', [AuthController::class, 'postLogin']);
});

Route::group(['prefix' => 'admin', "namespace" => 'Admin', 'middleware' => ['adminAuth']] ,function () {
    Route::get('/dashboard', [DashboardController::class, 'getIndex']);

    Route::get('/pelaksanaan', [PelaksanaanController::class, 'getIndex']);
    Route::get('/pelaksanaan/add', [PelaksanaanController::class, 'getAdd']);
    Route::get('/pelaksanaan/edit/{id}', [PelaksanaanController::class, 'getEdit']);
    Route::get('/pelaksanaan/audit/{id}', [PelaksanaanController::class, 'getAudit']);
    Route::get('/pelaksanaan/do-audit/{id}', [PelaksanaanController::class, 'getDoAudit']);
    Route::get('/pelaksanaan/do-temuan/{id}', [PelaksanaanController::class, 'getTemuan']);
    Route::get('/pelaksanaan/data-audit/{id}', [PelaksanaanController::class, 'getAuditData']);
    Route::get('/pelaksanaan/delete/{id}', [PelaksanaanController::class, 'getDelete']);
    Route::post('/pelaksanaan/save', [PelaksanaanController::class, 'postSaveData']);
    Route::post('/pelaksanaan/save-answer', [PelaksanaanController::class, 'postSaveAnswer']);

    Route::get('/template', [MasterTemplateController::class, 'getIndex']);
    Route::get('/template/list-data', [MasterTemplateController::class, 'getListData']);
    Route::get('/template/add', [MasterTemplateController::class, 'getAdd']);
    Route::get('/template/add/step-2/{id}', [MasterTemplateController::class, 'getStep2']);
    Route::get('/template/add/step-3/{id}', [MasterTemplateController::class, 'getStep3']);
    Route::get('/template/edit/{id}', [MasterTemplateController::class, 'getEdit']);
    Route::get('/template/delete/{id}', [MasterTemplateController::class, 'getDelete']);
    Route::get('/template/detail/{id}', [MasterTemplateController::class, 'getDetail']);
    Route::post('/template/save', [MasterTemplateController::class, 'postSaveData']);
    Route::get('/template/add-question', [MasterTemplateController::class, 'getAddQuestion']);
    Route::get('/template/update-question', [MasterTemplateController::class, 'getUpdateQuestion']);
    Route::post('/template/add/kriteria', [MasterTemplateController::class, 'postSaveKriteria']);
    Route::get('/template/update/kriteria', [MasterTemplateController::class, 'getUpdateKriteria']);

    Route::get('/penjadwalan', [PenjadwalanController::class, 'getIndex']);
    Route::get('/penjadwalan/add', [PenjadwalanController::class, 'getAdd']);
    Route::get('/penjadwalan/edit/{id}', [PenjadwalanController::class, 'getEdit']);
    Route::get('/penjadwalan/delete/{id}', [PenjadwalanController::class, 'getDelete']);
    Route::get('/penjadwalan/detail/{id}', [PenjadwalanController::class, 'getDetail']);
    Route::get('/penjadwalan/publish/{id}', [PenjadwalanController::class, 'getPublish']);
    Route::get('/penjadwalan/un-publish/{id}', [PenjadwalanController::class, 'getUnPublish']);
    Route::post('/penjadwalan/save', [PenjadwalanController::class, 'postSaveData']);

    // fakultas
    Route::get('/fakultas', [MasterFakultasController::class, 'getIndex']);
    Route::get('/fakultas/add', [MasterFakultasController::class, 'getAdd']);
    Route::get('/fakultas/edit/{id}', [MasterFakultasController::class, 'getEdit']);
    Route::get('/fakultas/delete/{id}', [MasterFakultasController::class, 'getDelete']);
    Route::post('/fakultas/save', [MasterFakultasController::class, 'postSaveData']);

    // fakultas
    Route::get('/progdi', [MasterProgdiController::class, 'getIndex']);
    Route::get('/progdi/add', [MasterProgdiController::class, 'getAdd']);
    Route::get('/progdi/edit/{id}', [MasterProgdiController::class, 'getEdit']);
    Route::get('/progdi/delete/{id}', [MasterProgdiController::class, 'getDelete']);
    Route::post('/progdi/save', [MasterProgdiController::class, 'postSaveData']);

    // fakultas
    Route::get('/lembaga', [MasterLembagaController::class, 'getIndex']);
    Route::get('/lembaga/add', [MasterLembagaController::class, 'getAdd']);
    Route::get('/lembaga/edit/{id}', [MasterLembagaController::class, 'getEdit']);
    Route::get('/lembaga/delete/{id}', [MasterLembagaController::class, 'getDelete']);
    Route::post('/lembaga/save', [MasterLembagaController::class, 'postSaveData']);

    // fakultas
    Route::get('/biro', [MasterBiroController::class, 'getIndex']);
    Route::get('/biro/add', [MasterBiroController::class, 'getAdd']);
    Route::get('/biro/edit/{id}', [MasterBiroController::class, 'getEdit']);
    Route::get('/biro/delete/{id}', [MasterBiroController::class, 'getDelete']);
    Route::post('/biro/save', [MasterBiroController::class, 'postSaveData']);

    // fakultas
    Route::get('/upt', [MasterUptController::class, 'getIndex']);
    Route::get('/upt/add', [MasterUptController::class, 'getAdd']);
    Route::get('/upt/edit/{id}', [MasterUptController::class, 'getEdit']);
    Route::get('/upt/delete/{id}', [MasterUptController::class, 'getDelete']);
    Route::post('/upt/save', [MasterUptController::class, 'postSaveData']);

    // fakultas
    Route::get('/lab', [MasterLabController::class, 'getIndex']);
    Route::get('/lab/add', [MasterLabController::class, 'getAdd']);
    Route::get('/lab/edit/{id}', [MasterLabController::class, 'getEdit']);
    Route::get('/lab/delete/{id}', [MasterLabController::class, 'getDelete']);
    Route::post('/lab/save', [MasterLabController::class, 'postSaveData']);

    // auditor
    Route::get('/users-admin', [UsersAdminController::class, 'getIndex']);
    Route::get('/users-admin/add', [UsersAdminController::class, 'getAdd']);
    Route::get('/akun', [UsersAdminController::class, 'getProfile']);
    Route::get('/users-admin/edit/{id}', [UsersAdminController::class, 'getEdit']);
    Route::get('/users-admin/delete/{id}', [UsersAdminController::class, 'getDelete']);
    Route::post('/users-admin/save', [UsersAdminController::class, 'postSaveData']);
    Route::post('/users-admin/save-profile', [UsersAdminController::class, 'postSaveProfile']);

    // auditor
    Route::get('/privileges', [PrivilegesController::class, 'getIndex']);
    Route::get('/privileges/add', [PrivilegesController::class, 'getAdd']);
    Route::get('/privileges/edit/{id}', [PrivilegesController::class, 'getEdit']);
    Route::get('/privileges/delete/{id}', [PrivilegesController::class, 'getDelete']);
    Route::post('/privileges/save', [PrivilegesController::class, 'postSaveData']);

    // auditor
    Route::get('/auditor', [AuditorController::class, 'getIndex']);
    Route::get('/auditor/add', [AuditorController::class, 'getAdd']);
    Route::get('/auditor/edit/{id}', [AuditorController::class, 'getEdit']);
    Route::get('/auditor/delete/{id}', [AuditorController::class, 'getDelete']);
    Route::post('/auditor/save', [AuditorController::class, 'postSaveData']);

    // auditor
    Route::get('/auditee', [AuditeeController::class, 'getIndex']);
    Route::get('/auditee/add', [AuditeeController::class, 'getAdd']);
    Route::get('/auditee/edit/{id}', [AuditeeController::class, 'getEdit']);
    Route::get('/auditee/delete/{id}', [AuditeeController::class, 'getDelete']);
    Route::post('/auditee/save', [AuditeeController::class, 'postSaveData']);

    // auditor
    Route::get('/visitor', [VisitorController::class, 'getIndex']);
    Route::get('/visitor/add', [VisitorController::class, 'getAdd']);
    Route::get('/visitor/edit/{id}', [VisitorController::class, 'getEdit']);
    Route::get('/visitor/delete/{id}', [VisitorController::class, 'getDelete']);
    Route::post('/visitor/save', [VisitorController::class, 'postSaveData']);

    // super admin
    Route::get('/menu-manajemen', [AdminCmsMenuController::class, 'getIndex']);
    Route::post('/menu-manajemen/add', [AdminCmsMenuController::class, 'postAdd']);
    Route::post('/menu-manajemen/save-menu', [AdminCmsMenuController::class, 'postSaveMenu']);
});
