@extends('template.master_auth')

@section('content')
    <div class="container-fluid" id="id_transaksi">
        <div class="d-sm-flex d-flex align-items-center justify-content-between mb-4" style="margin-top: 10%">
            <a href="{{ url('/barang') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-chevron-left  mr-2 fa-sm text-white-50"></i> Kembali</a>
        </div>

        <div class="card shadow mb-4" id="ujicoba">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok barang</th>
                                <th>Harga Barang</th>
                                <th>pilih barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td class="d-flex">
                                        <form action="{{ url('/pilih_barang') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="kode_barang" value="{{ $item->kode }}" id="kode">
                                            <input type="hidden" name="id_sementara" value="{{ $item->id_barang }}">
                                            <input type="hidden" name="harga" value="{{ $item->harga }}">
                                            <input type="hidden" name="id_barang"
                                                value="{{ session()->get('kode_barang') }}">
                                            <button type="submit" id="pilih" class="btn btn-success">pilih</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
