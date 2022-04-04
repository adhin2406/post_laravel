<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\diskon;
use App\Http\Controllers\homeController;
use App\Http\Controllers\post_system;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get("/", [homeController::class, "index"])->name("home");
    Route::get("/transaksi", [homeController::class, "transaksi"]);
    Route::get("/tambah_barang", [homeController::class, "tambah_barang"]);
    Route::get("/barang", [homeController::class, "barang"]);
    Route::get("/pilih_barang", [homeController::class, "pilih_barang"]);
    Route::get('/pencarian', [homeController::class, 'cari']);
    // Route::post('/pencarian', [homeController::class, "cari"])->name("cari");

    // post systen controller
    Route::post("/tambah_barang", [post_system::class, "handle_barang"]);
    Route::delete("/tambah_barang/{id}", [post_system::class, "delete_barang"]);
    Route::delete("/delete_data/{id}", [post_system::class, 'delete_sementara']);
    Route::put("/tambah_barang/{id}", [post_system::class, "update_barang"]);
    Route::post("/transaksi", [post_system::class, "insert_data"]);
    Route::post("/pilih_barang", [post_system::class, "handle_pilih_barang"]);
    Route::post("/barang", [post_system::class, "handle_chekout"]);

    // auth controller
    Route::get("/logout", [AuthController::class, "logout"]);

    // diskon controller
    Route::put("/barang/{id}", [diskon::class, 'handle_diskon']);
    Route::put("/qty/{id}", [diskon::class, 'handle_qty']);
    Route::put("/ongkir/{id}", [diskon::class, "handle_ongkir"]);
    Route::get("/qty/{id}", [homeController::class, 'barang']);
    Route::get("/barang/{id}", [homeController::class, 'barang']);
    Route::get("/ongkir/{id}", [homeController::class, 'barang']);
});

Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, "index"])->name("login");
    Route::get("/daftar", [AuthController::class, "daftar"]);
    Route::post("/daftar", [AuthController::class, "handle_daftar"]);
    Route::post("/login", [AuthController::class, "handle_login"]);
});
