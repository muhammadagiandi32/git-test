<?php

use App\Http\Controllers\MasterItem\MasteritemController;
use App\Http\Controllers\Pembayaran\PembayaranController;
use App\Http\Controllers\Penerimaan\PenerimaanController;
use App\Http\Controllers\PO\PoController;
use App\Http\Controllers\Report\ReportController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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

Route::get('/session', function (Request $request) {
    $data = $request->session()->all();
    dd($data);
});
Route::get('/', function (Request $request) {
    return "test";
});
Route::get('/{role}', function () {
    return view('home');
})->middleware('role');

Route::get('/test', function () {
    DB::enableQueryLog();
    // if ($request->ajax()) {
    $data =  DB::table('T_PO_Detail_Showroom')
        ->leftJoin('T_PO_Head_Showroom', 'T_PO_Detail_Showroom.poid', 'T_PO_Head_Showroom.idpo')
        ->selectRaw(
            'T_PO_Head_Showroom.nopo,
            T_PO_Head_Showroom.tgl,
            T_PO_Head_Showroom.Currency,
            T_PO_Head_Showroom.ppn,
            T_PO_Head_Showroom.JenisPPn,
            T_PO_Head_Showroom.Kat,
            sum(T_PO_Detail_Showroom.total) as Total'
        )
        ->where('Kat', 'PO')
        ->whereBetween('T_PO_Head_Showroom.tgl', ['2022-01-01', '2023-02-03'])
        ->groupBy('T_PO_Detail_Showroom.poid')
        ->toSql();


    // return response()->json($data);
    return $data;
    // }
    // return view('pages.Report.index');
});
Route::group(['as' => 'showroom.', 'prefix' => 'showroom'], function () {
    // Route::resource('users','UserController'); 
    Route::resource('master-items', MasteritemController::class);

    // Route Report
    Route::resource('report', ReportController::class);
    Route::post('report-post-po', [ReportController::class, 'po'])->name('report.post.po');
    Route::post('report-get-detail', [ReportController::class, 'getDetail'])->name('report.get.detail');

    Route::get('report-get-po/{id}', [ReportController::class, 'getDetailPembelian'])->name('get.detail.pembelian');
    Route::get('report-get-po-detail/{id}', [ReportController::class, 'getDetailPembelianBarang'])->name('get.detail.pembelian.barang');


    // Route PO / Pembelian
    Route::resource('po', PoController::class);
    Route::get('po/next/{id}', [PoController::class, 'next']);
    Route::get('po/previous/{id}', [PoController::class, 'previous']);
    Route::delete('delete-detail/{id}', [PoController::class, 'destroyDetails'])->name('po.delete-detail');

    // Route Penerimaan
    Route::resource('penerimaan', PenerimaanController::class);
    Route::get('penerimaan/next/{id}', [PenerimaanController::class, 'next']);
    Route::get('penerimaan/previous/{id}', [PenerimaanController::class, 'previous']);

    // Route Pembayaran
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('pembayaran/next/{id}', [PembayaranController::class, 'next']);
    Route::get('pembayaran/previous/{id}', [PembayaranController::class, 'previous']);
});

Route::get('po/min/', [PoController::class, 'min']);
Route::get('po/max/', [PoController::class, 'max']);
