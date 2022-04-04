@extends('template.master_auth')

@section('content')
    <div class="container-fluid" id="id_transaksi">
        <div class="d-sm-flex d-flex align-items-center justify-content-between mb-4" style="margin-top: 10%">
            <a href="{{ url('/') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-chevron-left  mr-2 fa-sm text-white-50"></i> Kembali</a>
        </div>


        <div class="card shadow mb-4" id="ujicoba">
            <div class="card-body">
                <form action="{{ url('transaksi') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <h5 class="card-title">Transaksi</h5>
                            <div class="form-group">
                                <label for="no_transkasi">No Transaksi</label>
                                <input type="text" class="form-control" id="no_transkasi" disabled
                                    value="{{ old('no_transaksi') ? old('no_transaksi') : $no_transaksi }}">
                                <input type="hidden" name="no_transaksi"
                                    value="{{ old('no_transaksi') ? old('no_transaksi') : $no_transaksi }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal">tanggal</label>
                                <input type="text" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                                    name="tanggal" value="{{ old('tanggal') ? old('tanggal') : session()->get('tgl') }}"
                                    placeholder="tanggal transaksi">
                                @error('tanggal')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12" id="customer">
                            <h5 class="card-title">Customer</h5>
                            <div class="form-group">
                                <label for="no_transkasi">Kode</label>
                                <input type="text" class="form-control" id="no_transkasi" disabled
                                    value="{{ old('kode_customer') ? old('kode_customer') : $kode_customer }}">
                                <input type="hidden" name="kode_customer"
                                    value="{{ old('kode_customer') ? old('kode_customer') : $kode_customer }}">
                            </div>
                            <div class="form-group">
                                <label for="nama">nama</label>
                                <input type="text" class="form-control @error('nama_customer') is-invalid @enderror"
                                    id="nama" placeholder="nama" name="nama_customer"
                                    value="{{ old('nama_customer') ? old('nama_customer') : session()->get('nama') }}">
                                @error('nama_customer')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="No_telp">No telp</label>
                                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="No_telp"
                                    placeholder="No_telp" name="no_telp"
                                    value="{{ old('no_telp') ? old('no_telp') : session()->get('no_tlp') }}">
                                @error('no_telp')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary form-control">Selanjutnya</button>
                </form>
            </div>
        </div>
    </div>
@endsection
