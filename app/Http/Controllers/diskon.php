<?php

namespace App\Http\Controllers;

use App\Models\sementara;
use Illuminate\Http\Request;

class diskon extends Controller
{

    public function handle_qty(Request $request, $id)
    {
        $request->validate([
            'qty' => ['required', 'numeric']
        ]);
        // ambil data diskonya
        $qty = (int)$request->qty;
        $jumlah = sementara::findOrFail($id);
        if ($jumlah->diskon == null) {
            $data =  preg_replace('/\D/', '', $request->harga_barang);
            $harga_barang = intval($data);
            $harga_diskon = $qty  * $harga_barang;
            $ongkir  = $harga_diskon + $jumlah->ongkir;
            if ($jumlah->ongkir == null) {
                $jumlah->qty = $qty;
                $jumlah->harga_diskon = $harga_diskon;
                $jumlah->save();
                return redirect()->back();
            } else {
                $jumlah->qty = $qty;
                $jumlah->harga_diskon = $ongkir;
                $jumlah->save();
                return redirect()->back();
            }
        } else {
            $data =  preg_replace('/\D/', '', $request->harga_barang);
            $harga_barang = intval($data);
            $harga_diskon = $qty  * $harga_barang;
            $data_diskon = ($jumlah->diskon  / 100) * $harga_diskon;
            $harga_real_diskon = $harga_diskon - $data_diskon;
            $ongkir = $harga_real_diskon + $jumlah->ongkir;
            if ($jumlah->ongkir == null) {
                $jumlah->qty = $qty;
                $jumlah->harga_diskon = $harga_real_diskon;
                $jumlah->save();
                return redirect()->back();
            } else {
                $jumlah->qty = $qty;
                $jumlah->harga_diskon = $ongkir;
                $jumlah->save();
                return redirect()->back();
            }
        }
    }

    public function handle_diskon(Request $request, $id)
    {
        $request->validate([
            'diskon' => ['required', 'numeric']
        ]);
        // ambil data diskonya
        $diskon = (int)$request->diskon;
        // ambil data harga lalu rubah menjadi angka
        $data =  preg_replace('/\D/', '', $request->harga_barang);
        $harga_barang = intval($data);
        // logika diskon
        $harga_diskon = ($diskon / 100) * $harga_barang;
        $harga_real = $harga_barang - $harga_diskon;
        $diskon_harga = sementara::findOrFail($id);
        // jika tidak ada diskon
        $data_harga =  preg_replace('/\D/', '', $request->harga);
        $tidak_diskon = intval($data_harga);
        $qty = $diskon_harga->qty;
        $harga = $qty * $tidak_diskon;
        if ($diskon == 0) {
            $diskon_harga->diskon = $diskon;
            $diskon_harga->harga_diskon = $harga;
            $diskon_harga->save();
        } else {
            $diskon_harga->diskon = $diskon;
            $diskon_harga->harga_diskon = $harga_real;
            $diskon_harga->save();
        }
        return redirect()->back();
    }

    public function handle_ongkir(Request $request, $id)
    {
        $request->validate([
            'ongkir' => ['required']
        ]);
        $inputan_ongkir =  preg_replace('/\D/', '', $request->ongkir);
        $input_ongkir = intval($inputan_ongkir);
        $jumlah = sementara::findOrFail($id);
        // cek apakah diskon null atau tidak
        if ($jumlah->diskon == null) {
            // cek qty itu satu atau tidak
            if ($jumlah->qty == 1) {
                // logika untuk ongkir
                $harga_ongkir = $input_ongkir;
                $harga_setelah_kena_ongkir = $jumlah->harga_diskon + $harga_ongkir;
                $jumlah->ongkir = $input_ongkir;
                $jumlah->harga_diskon = $harga_setelah_kena_ongkir;
                $jumlah->save();
                return redirect()->back();
            } else {
                // ambil qty barang
                $data =  preg_replace('/\D/', '', $request->harga_barang);
                $harga_barang = intval($data);
                $qty_barang = $jumlah->qty;
                $harga_sebelum_kena_ongkir = $qty_barang * $harga_barang;
                $ongkir = $input_ongkir + $harga_sebelum_kena_ongkir;
                $jumlah->ongkir = $input_ongkir;
                $jumlah->harga_diskon = $ongkir;
                $jumlah->save();
                return redirect()->back();
            }
        } else {
            $data =  preg_replace('/\D/', '', $request->harga_barang);
            $harga_barang = intval($data);
            $harga_diskon = $jumlah->qty  * $harga_barang;
            $data_diskon = ($jumlah->diskon  / 100) * $harga_diskon;
            $harga_real_diskon = $harga_diskon - $data_diskon;
            $ongkir = $harga_real_diskon + $input_ongkir;
            $jumlah->ongkir = $input_ongkir;
            $jumlah->harga_diskon = $ongkir;
            $jumlah->save();
            return redirect()->back();
        }
    }
}
