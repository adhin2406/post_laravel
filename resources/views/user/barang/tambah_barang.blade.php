@extends('template.master_auth')

@section('content')
    <div class="container-fluid" id="id_transaksi">
        <div class="d-sm-flex d-flex align-items-center justify-content-between mb-4" style="margin-top: 10%">
            <a href="{{ url('/') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-chevron-left  mr-2 fa-sm text-white-50"></i> Kembali</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#barang">tambah
                    barang</button>

                <!-- Modal -->
                <div class="modal fade" id="barang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/tambah_barang') }}" method="POST" autocomplete="off">
                                    @csrf

                                    <div class="form-group">
                                        <label for="no_transkasi">Kode barang</label>
                                        <input type="text" class="form-control" id="no_transkasi" name="kode" disabled
                                            value="{{ $kode_barang }}">
                                        <input type="hidden" name="kode" value="{{ $kode_barang }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama_barang">nama barang</label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama_barang" name="nama_barang">
                                        @error('nama')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="harga_barang">Harga</label>
                                        <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                            id="harga_barang" name="harga">
                                        @error('harga')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="stok_barang">stok barang</label>
                                        <input type="text" class="form-control @error('stok') is-invalid @enderror"
                                            id="stok_barang" name="stok">
                                        @error('stok')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary form-control">tambah barang <i
                                            class="fas fa-plus ml-2"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>nama Barang</th>
                                <th>Harga Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td class="d-flex">
                                        <a data-toggle="modal" data-target="#edit_barang{{ $item->id_barang }}"
                                            class="btn btn-primary mr-2">edit</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="edit_barang{{ $item->id_barang }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('/tambah_barang/' . $item->id_barang) }}"
                                                            method="POST" autocomplete="off">
                                                            @csrf
                                                            @method("put")
                                                            <div class="form-group">
                                                                <label for="no_transkasi">Kode barang</label>
                                                                <input type="text" class="form-control" id="no_transkasi"
                                                                    name="kode" disabled value="{{ $item->kode }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nama_barang">nama barang</label>
                                                                <input type="text"
                                                                    class="form-control @error('nama_barang') is-invalid @enderror"
                                                                    id="nama_barang" name="nama_barang"
                                                                    value="{{ $item->nama_barang }}">
                                                                @error('nama_barang')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="harga_barang">Harga</label>
                                                                <input type="text"
                                                                    class="form-control  @error('harga') is-invalid @enderror"
                                                                    id="edit_harga_barang" name="harga"
                                                                    value="{{ $item->harga }}">
                                                                @error('harga')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="stok_barang">stok barang</label>
                                                                <input type="text"
                                                                    class="form-control  @error('stok') is-invalid @enderror"
                                                                    id="stok_barang" name="stok"
                                                                    value="{{ $item->stok }}">
                                                                @error('stok')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <button type="submit" class="btn btn-primary form-control">edit
                                                                barang</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ url('/tambah_barang/' . $item->id_barang) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"
                                                onclick="delete_databarang()">Delete</button>
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
