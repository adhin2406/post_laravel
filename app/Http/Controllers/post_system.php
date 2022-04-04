<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\customer;
use App\Models\sementara;
use App\Models\t_sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class post_system extends Controller
{
    public function handle_barang(Request $request)
    {
        $request->validate([
            'nama_barang' => ['required', 'string', 'unique:m_barang'],
            'harga' => ['required', "max:200"],
            'stok' => ['required', "max:200"]
        ]);

        barang::create($request->all());
        return redirect()->back()->with('success', 'berhasil menyimpan barang');
    }

    public function update_barang(Request $request, $id)
    {
        $barang = barang::findOrFail($id);
        $barang->nama_barang = $request->nama_barang;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->save();
        return redirect()->back()->with('success', 'data berhasil di ubah');
    }

    public function insert_data(Request $request)
    {
        $request->validate([
            'tanggal' => ['required', 'date'],
            'nama_customer' => ['required'],
            'no_telp' => ['required', 'numeric', 'alpha_num', 'min:12']
        ]);

        $request->session()->put([
            'no_transaksi' => $request->no_transaksi,
            'kode' => $request->kode_customer,
            'tgl' =>  $request->tanggal,
            'tanggal' =>  date("Y-m-d", strtotime($request->tanggal)),
            "nama" => $request->nama_customer,
            "no_tlp" => $request->no_telp
        ]);

        return redirect("barang");
    }


    public function handle_pilih_barang(Request $request)
    {
        $harga = substr($request->harga, 4);
        $data =  preg_replace('/\D/', '', $harga);
        $harga_barang = intval($data);
        $request->session()->put([
            'kode_barang' =>  $request->id_sementara
        ]);
        $id = session()->get('kode_barang');
        $data_sementara = barang::join('sementara', 'sementara.barang_id', '=', 'm_barang.id_barang')->where(['date' => date("Y-m-d", strtotime(now()))])->find($id);
        if ($data_sementara == null) {
            sementara::create([
                'kode_barang' => $request->kode_barang,
                'user' => Auth::user()->id_user,
                'qty' => 1,
                'kode_sementara' => sementara::kode_sementara(6),
                'harga_diskon' => $harga_barang,
                'time' => date("h:i:s"),
                'date' =>  date("Y-m-d", strtotime(now())),
                'barang_id' => $request->id_sementara
            ]);
            return redirect('barang');
        } else {
            if ($data_sementara->id_barang == session()->get('kode_barang')) {
                if ($data_sementara->diskon == null) {
                    $harga = substr($data_sementara->harga, 4);
                    $data =  preg_replace('/\D/', '', $harga);
                    $harga_barang = intval($data);
                    $id_sementara = $data_sementara->id_sementara;
                    $data_barang = sementara::findOrFail($id_sementara);
                    $qty = $data_barang->qty + 1;
                    $data_barang->qty = $qty;
                    $harga_real = $qty * $harga_barang;
                    // onkir
                    if ($data_barang->ongkir == null) {
                        $ongkir = null;
                    } else {
                        $ongkir = $harga_real + $data_barang->ongkir;
                    }
                    $data_barang->harga_diskon = $harga_real;
                    $data_barang->ongkir = $ongkir;
                    $data_barang->save();
                    return redirect('barang');
                } else {
                    $harga = substr($data_sementara->harga, 4);
                    $data =  preg_replace('/\D/', '', $harga);
                    $harga_barang = intval($data);
                    $id_sementara = $data_sementara->id_sementara;
                    $data_barang = sementara::findOrFail($id_sementara);
                    $qty = $data_barang->qty + 1;
                    $data_barang->qty = $qty;
                    $harga_real = $qty * $harga_barang;
                    $data_diskon = ($data_sementara->diskon  / 100) * $harga_real;
                    $harga_real_diskon = $harga_real - $data_diskon;
                    if ($data_barang->ongkir == null) {
                        $ongkir = null;
                    } else {
                        $ongkir = $harga_real_diskon + $data_barang->ongkir;
                    }
                    $data_barang->harga_diskon = $harga_real_diskon;
                    $data_barang->ongkir = $ongkir;
                    $data_barang->save();
                    return redirect('barang');
                }
            } else {
                sementara::create([
                    'kode_barang' => $request->kode_barang,
                    'user' => Auth::user()->id_user,
                    'qty' => 1,
                    'kode_sementara' => sementara::kode_sementara(6),
                    'harga_diskon' => $harga_barang,
                    'barang_id' => $request->id_sementara
                ]);
                return redirect('barang');
            }
        }
    }


    public function handle_chekout(Request $request)
    {
        $data_sementaras = barang::join('sementara', 'sementara.barang_id', '=', 'm_barang.id_barang')->where(['date' => date("Y-m-d", strtotime(now()))])->get();
        foreach ($data_sementaras as $data_sementara) {
            if ($data_sementara->stok <= $data_sementara->qty) {
                // session()->put([
                //     'error' => 'stok barang ' . $data_sementara->nama_barang . ' tidak cukup'
                // ]);
                return  redirect("/barang")->withError('Maaf! Stok ' . $data_sementara->nama_barang . ' tidak cukup silahkan dirubah terlebih dahulu');
            } else {
                $id_barang = $data_sementara->id_barang;
                $data_barang = barang::find($id_barang);
                $data_barang->stok = $data_sementara->stok - $data_sementara->qty;
                $data_barang->save();
                t_sales::create([
                    'no_transaksi' => session()->get('no_transaksi'),
                    'sementara_id' => $request->id_sementara,
                    'barang_id' => $request->id_barang,
                    'tgl' => session()->get('tanggal'),
                    'kode_sementara' => $data_sementara->kode_sementara,
                    'user' =>  Auth::user()->id_user,
                    'kode' => session()->get('kode'),
                    'cust_id' => Auth::user()->id_user,
                    'subtotal' => sementara::sum('harga_diskon'),
                    'total_bayar' => sementara::sum('harga_diskon'),
                ]);
            }
        }

        customer::create([
            'kode_customer' => session()->get('kode'),
            'user_id' =>   Auth::user()->id_user,
            "nama" => session()->get('nama'),
            "no_tlp" => session()->get('no_tlp')
        ]);
        sementara::where(['date' => date("Y-m-d", strtotime(now()))])->update(['status' => 1]);
        return redirect("/")->with("success", "Transaksi mu sudah disimpan oleh sistem");
    }

    public function delete_sementara($id)
    {
        $data_sementara = sementara::findOrFail($id);
        $data_sementara->delete();
        return redirect()->back()->withSuccess('barang berhasil dihapus');
    }

    public function delete_barang($id)
    {
        $barang = barang::findOrFail($id);
        $barang->delete();
        return redirect()->back()->with('success', 'barang berhasil dihapus');
    }
}
