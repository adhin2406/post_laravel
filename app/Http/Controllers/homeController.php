<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\customer;
use App\Models\sementara;
use App\Models\t_sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'MPOST',
            'data_transkasi' =>  sementara::join("m_barang", "m_barang.kode", "=", "sementara.kode_barang")->join("user", "user.id_user", "=", "sementara.user")->join("t_sales", "t_sales.kode_sementara", "=", "sementara.kode_sementara")->join('m_customer', "m_customer.kode_customer", "=", "t_sales.kode")->get(),
            'total' => sementara::join("m_barang", "m_barang.kode", "=", "sementara.kode_barang")->join("user", "user.id_user", "=", "sementara.user")->join("t_sales", "t_sales.kode_sementara", "=", "sementara.kode_sementara")->join('m_customer', "m_customer.kode_customer", "=", "t_sales.kode")->sum('harga_diskon')
        ];
        return view("user.home.index", $data);
    }

    public function transaksi()
    {
        $data = [
            'title' => 'Chekout',
            'no_transaksi' => t_sales::no_transaksi(10),
            'sementara' => sementara::join("m_barang", "m_barang.kode", "=", "sementara.kode_barang")->join("user", "user.id_user", "=", "sementara.user")->where(["id_user" => Auth::user()->id_user])->paginate(10),
            'barang' => barang::paginate(20),
            'kode_customer' => customer::kode_customer(10)
        ];
        return view("user.transaksi.transaksi", $data);
    }

    public function barang()
    {
        if (!session()->get('no_transaksi')) {
            return redirect('/transaksi');
        } else {
            $data = [
                'title' => 'barang yang dipilih',
                'barang' => barang::paginate(20),
                'data_sementara' => sementara::join("m_barang", "m_barang.kode", "=", "sementara.kode_barang")->join("user", "user.id_user", "=", "sementara.user")->where(["date" => date("Y-m-d", strtotime(now()))])->paginate(10),
                'data_harga_total' => sementara::where(['date' => date("Y-m-d", strtotime(now()))])->sum('harga_diskon')
            ];
            return view("user.barang.barang_yang_dipilih", $data);
        }
    }

    public function pilih_barang()
    {
        if (!session()->get('no_transaksi')) {
            return redirect('/transaksi');
        } else {
            $data = [
                'title' => 'pilih barang',
                'barang' => barang::paginate(20)
            ];

            return view("user.barang.pilih_barang", $data);
        }
    }

    public function tambah_barang()
    {
        $data = [
            'title' => 'Tambah barang',
            'kode_barang' => barang::kode_barang(5),
            'barang' => barang::paginate(20)
        ];

        return view("user.barang.tambah_barang", $data);
    }

    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $products = sementara::join("m_barang", "m_barang.kode", "=", "sementara.kode_barang")->join("user", "user.id_user", "=", "sementara.user")->join("t_sales", "t_sales.kode_sementara", "=", "sementara.kode_sementara")->join('m_customer', "m_customer.kode_customer", "=", "t_sales.kode")->where('nama_barang', 'LIKE', "%" . $request->cari . "%")->orWhere('m_customer.nama', 'LIKE', "%" . $request->cari . "%")->get();
            foreach ($products as $product) {
                $output .= '<tr>' .
                    '<td>' . 1 . '  </td>' .
                    '<td>' . $product->no_transaksi . '</td>' .
                    '<td>' .  date('d M Y', strtotime($product->tgl)) . '</td>' .
                    '<td>' . $product->nama . '</td>' .
                    '<td>' . $product->qty . '</td>' .
                    '<td>' . $product->harga_diskon . '</td>' .
                    '<td>' . $product->diskon . '</td>' .
                    '<td>' . $product->harga_diskon . '</td>' .
                    '</tr>';
            }
            return Response($output);
        }
    }
}
