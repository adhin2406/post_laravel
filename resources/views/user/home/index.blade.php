@extends('template.master_auth')

@section('content')
    <div class="container-fluid" id="id_transaksi">
        <div class="d-sm-flex d-flex align-items-center justify-content-between mb-4" style="margin-top: 10%">
            <h1 class="h3 mb-0 text-gray-800">Daftar Transaksi</h1>
            <a href="{{ url('/transaksi') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus mr-2 fa-sm text-white-50"></i> Tambah Transaksi</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form autocomplete="off">
                    <div class="form-group d-sm-flex d-flex float-right " style="margin-bottom: -.5% !important;">
                        <label for="cari" class="mt-2 mr-2">CARI </label>
                        <input type="text" id="cari" name="cari" class="form-control" placeholder="cari....">
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Nama Customer</th>
                                <th>Jumlah Barang</th>
                                <th>Sub total</th>
                                <th>Diskon</th>
                                <th>Ongkir</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="hasilPencarian">
                            @foreach ($data_transkasi as $item)
                                @if ($item->status == null)
                                    {{ sementara::join('m_barang', 'm_barang.kode', '=', 'sementara.kode_barang')->join('user', 'user.id_user', '=', 'sementara.user')->where(['date' => date('Y-m-d', strtotime(now()))])->delete() }}
                                @else
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->no_transaksi }}</td>
                                        <td>{{ date('d M Y', strtotime($item->tgl)) }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rp {{ number_format($item->harga_diskon) }}</td>
                                        <td>
                                            @if ($item->diskon == null)
                                                0%
                                            @else
                                                {{ $item->diskon }}%
                                            @endif
                                        </td>
                                        <td>
                                            Rp {{ number_format($item->ongkir) }}
                                        </td>
                                        <td>Rp {{ number_format($item->harga_diskon) }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="5">
                                    <h5 class="text-center">
                                        Grand Total
                                    </h5>
                                </td>
                                <td>Rp {{ number_format($total) }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
