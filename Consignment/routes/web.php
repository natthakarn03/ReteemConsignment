<?php

use Illuminate\Support\Facades\Route;

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
// courier
Route::get('/testing', 'ControllerHalaman@index');
Route::post('/testing', 'ControllerHalaman@submit');
Route::get('/province/{id}/cities', 'ControllerHalaman@getCities');




Route::get('/', 'ControllerHalaman@home');

//ini routing untuk pindah halaman. '/pindahHalaman disesuaikan dengan link pada komponen'
//<a> pada view

//middleware dari file CekRole.php
//middleware untuk admin

Route::group(['middleware' => ['CekRole:admin']], function () {//['CekRole:(parameter $role)'] lihat di file CekRole.php

    Route::get('/admin', 'ControllerHalaman@admin');
    Route::get('/daftaradmin', 'ControllerHalaman@daftaradmin');
    Route::get('/daftarbank', 'ControllerHalaman@daftarbank');
    Route::get('/daftarTransaksi', 'ControllerHalaman@daftarTransaksi');
    Route::get('/daftarPengirimanDana', 'ControllerHalaman@daftarPengirimanDana');
    Route::get('/daftarjenis', 'ControllerHalaman@daftarjenis');
    Route::get('/daftarmerk', 'ControllerHalaman@daftarmerk');
    Route::get('/daftarretur', 'ControllerHalaman@daftarretur');
    Route::get('/approved', 'ControllerHalaman@approved');
    Route::get('/notapproved', 'ControllerHalaman@notapproved');
    Route::get('/bayarPenjual/{id}', 'ControllerHalaman@bayarPenjual');
});
Route::get('/register', 'ControllerHalaman@register');
Route::get('/login', 'ControllerHalaman@login');

// });


//middleware untuk user
Route::group(['middleware' => ['CekRole:user']], function () {
    Route::get('/katalog', 'ControllerHalaman@katalog');
    Route::get('/pengajuan', 'ControllerHalaman@pengajuan');
    Route::get('/barangreject', 'ControllerHalaman@barangreject');
    Route::get('/retur', 'ControllerHalaman@retur');
    Route::get('/barangSaya','ControllerHalaman@barangSaya');
    Route::get('/statusbarang', 'ControllerHalaman@statusbarang');
    Route::get('/returResi/{id}','ControllerHalaman@returResi');
});


Route::get('/detailsbarang/{id}', 'ControllerHalaman@detailsbarang');
Route::get('/detailpengajuan', 'ControllerHalaman@detailpengajuan');
Route::get('/detailTransaksi/{id}', 'ControllerHalaman@detailTransaksi');



Route::get('/profile', 'ControllerHalaman@profile');

Route::get('/detailbarangreject', 'ControllerHalaman@detailbarangreject');


Route::get('/back','ControllerHalaman@back');
Route::get('/cekPengiriman', 'ControllerHalaman@checkPengiriman');


Route::post('/doRegister', 'ControllerHalaman@doRegister');
Route::post('/doDeleteRetur', 'ControllerHalaman@doDeleteRetur');
Route::post('/doLogin', 'ControllerHalaman@doLogin');
Route::post('/doSubmit', 'ControllerHalaman@doSubmit');
Route::post('/doApply', 'ControllerHalaman@doApply');
Route::get('/doLogout', 'ControllerHalaman@doLogout');
Route::post('/addAdmin', 'ControllerHalaman@addAdmin');
Route::post('/deleteAdmin', 'ControllerHalaman@deleteAdmin');
Route::post('/addBank', 'ControllerHalaman@addBank');
Route::post('/deleteBank', 'ControllerHalaman@deleteBank');
Route::post('/addJenis', 'ControllerHalaman@addJenis');
Route::post('/addMerk', 'ControllerHalaman@addMerk');
Route::post('/post_checkout/{id}', 'ControllerHalaman@checkout');
Route::post('/bayar', 'ControllerHalaman@bayar');
Route::post('/sendResi', 'ControllerHalaman@sendResi');
Route::post('/sendResiRetur', 'ControllerHalaman@sendResiRetur');
Route::get('/con', 'ControllerHalaman@konfirmasi');

Route::get('/toDetail/{id}', 'ControllerHalaman@toDetail');
Route::get('/detailbarangreject/{id}', 'ControllerHalaman@detailbarangreject');
Route::get('/detailbarangku/{id}', 'ControllerHalaman@detailbarangku');
Route::get('/batalTransaksi', 'ControllerHalaman@batalTransaksi');
Route::get('/doApprove', 'ControllerHalaman@doApprove');
Route::get('/doDelete/{id}', 'ControllerHalaman@doDelete');
Route::get('/changeProfile', 'ControllerHalaman@changeProfile');
Route::post('/doRetur', 'ControllerHalaman@doRetur');

Route::post('/membayar','ControllerHalaman@membayar');
Route::post('/doSell','ControllerHalaman@doSell');
Route::post('/doPay','ControllerHalaman@doPay');


// Route::get('/doApprove/{id}', 'ControllerHalaman@doApprove');
