@extends('template.master_auth')

@section('content')
    <div class="container-fluid" id="id_transaksi">
        <div class="d-sm-flex d-flex align-items-center justify-content-between mb-4" style="margin-top: 10%">
            <a href="{{ url('/transaksi') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-chevron-left  mr-2 fa-sm text-white-50"></i> Kembali</a>
        </div>
        @if (session()->get('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        @if (session()->get('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ url('pilih_barang') }}" class="btn btn-success rounded">PILIH BARANG</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Harga Bandrol</th>
                                <th>Diskon</th>
                                <th>Ongkir</th>
                                <th>Harga Diskon</th>
                                <th>Total</th>
                                <th>hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data_sementara as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#input_qty{{ $item->kode_barang }}"
                                            class="text-decoration-none text-dark"
                                            style="cursor: pointer">{{ $item->qty }}</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="input_qty{{ $item->kode_barang }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Input qty
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('/qty/' . $item->id_sementara) }}"
                                                            method="POST" autocomplete="off">
                                                            @csrf
                                                            @method("put")
                                                            <div class="form-group">
                                                                <input type="text"
                                                                    class="form-control @error('qty') is-invalid @enderror"
                                                                    name="qty" placeholder="input qty "
                                                                    value="{{ old('qty') ? old('qty') : $item->qty }}">
                                                                @error('qty')
                                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                                @enderror
                                                                <input type="hidden" name="harga_barang"
                                                                    value="{{ old('harga_barang') ? old('harga_barang') : $item->harga }}">
                                                                <input type="hidden" name="harga_diskon"
                                                                    value="{{ $item->harga_diskon }}">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->harga }}</td>
                                    <td>
                                        @if ($item->diskon == null)
                                            <a data-toggle="modal" data-target="#input_diskon{{ $item->id_sementara }}"
                                                class="text-decoration-none text-dark" style="cursor: pointer">Input
                                                Diskon</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="input_diskon{{ $item->id_sementara }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Input Diskon
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/barang/' . $item->id_sementara) }}"
                                                                method="POST" autocomplete="off">
                                                                @csrf
                                                                @method("put")
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                        class="form-control @error('diskon') is-invalid @enderror"
                                                                        name="diskon" placeholder="input diskon"
                                                                        value="{{ old('diskon') }}">
                                                                    @error('diskon')
                                                                        <span
                                                                            class="invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                    <input type="hidden" name="harga_barang"
                                                                        value="{{ $item->harga_diskon }}">
                                                                    <input type="hidden" name="harga"
                                                                        value="{{ $item->harga }}">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <a data-toggle="modal" data-target="#input_diskon{{ $item->kode_barang }}"
                                                class="text-decoration-none text-dark"
                                                style="cursor: pointer">{{ $item->diskon }}%</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="input_diskon{{ $item->kode_barang }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Input Diskon
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/barang/' . $item->id_sementara) }}"
                                                                method="POST" autocomplete="off">
                                                                @csrf
                                                                @method("put")
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                        class="form-control @error('diskon') is-invalid @enderror"
                                                                        name="diskon" placeholder="input diskon "
                                                                        value="{{ old('diskon') ? old('diskon') : $item->diskon }}">
                                                                    @error('diskon')
                                                                        <span
                                                                            class="invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                    <input type="hidden" name="harga_barang"
                                                                        value="{{ old('harga_barang') ? old('harga_barang') : $item->harga_diskon }}">
                                                                    <input type="hidden" name="harga"
                                                                        value="{{ $item->harga }}">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->ongkir == null)
                                            <a data-toggle="modal" data-target="#ongkir{{ $item->kode_barang }}"
                                                class="text-decoration-none text-dark" style="cursor: pointer">Input
                                                Ongkir</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="ongkir{{ $item->kode_barang }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Input Ongkir
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/ongkir/' . $item->id_sementara) }}"
                                                                method="POST" autocomplete="off">
                                                                @csrf
                                                                @method("put")
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                        class="form-control @error('ongkir') is-invalid @enderror"
                                                                        name="ongkir" id="input_ongkir"
                                                                        placeholder="input ongkir "
                                                                        value="{{ old('ongkir') ? old('ongkir') : '' }}">
                                                                    @error('ongkir')
                                                                        <span
                                                                            class="invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                    <input type="hidden" name="harga_barang"
                                                                        value="{{ old('harga_barang') ? old('harga_barang') : $item->harga }}">
                                                                    <input type="hidden" name="harga_diskon"
                                                                        value="{{ $item->harga_diskon }}">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <a data-toggle="modal" data-target="#ongkir{{ $item->kode_barang }}"
                                                class="text-decoration-none text-dark" style="cursor: pointer">Rp
                                                {{ number_format($item->ongkir) }}</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="ongkir{{ $item->kode_barang }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Input Ongkir
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('/ongkir/' . $item->id_sementara) }}"
                                                                method="POST" autocomplete="off">
                                                                @csrf
                                                                @method("put")
                                                                <div class="form-group">
                                                                    <input type="text"
                                                                        class="form-control @error('ongkir') is-invalid @enderror"
                                                                        name="ongkir" id="input_ongkir"
                                                                        placeholder="input ongkir "
                                                                        value="{{ old('ongkir') ? old('ongkir') : $item->ongkir }}">
                                                                    @error('ongkir')
                                                                        <span
                                                                            class="invalid-feedback">{{ $message }}</span>
                                                                    @enderror
                                                                    <input type="hidden" name="harga_barang"
                                                                        value="{{ old('harga_barang') ? old('harga_barang') : $item->harga }}">
                                                                    <input type="hidden" name="harga_diskon"
                                                                        value="{{ $item->harga_diskon }}">
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Kirim</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->harga_diskon == null)
                                            -
                                        @elseif ($item->harga_diskon == '0')
                                            -
                                        @else
                                            Rp {{ number_format($item->harga_diskon) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->harga_diskon == null)
                                            -
                                        @elseif ($item->harga_diskon == '0')
                                            -
                                        @else
                                            Rp {{ number_format($item->harga_diskon) }}
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ url('/delete_data/' . $item->id_sementara) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger" id="hapus">X</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="keterangan d-flex float-right">
                    <h5>Sub total Rp {{ number_format($data_harga_total) }}</h5>
                </div>

                @if ($data_harga_total == null)
                @else
                    <form action="{{ url('/barang') }}" method="post" autocomplete="off" class="mt-5 mb-3">
                        @csrf
                        @foreach ($data_sementara as $item)
                            <input type="hidden" name="id_sementara" value="{{ $item->id_sementara }}">
                            <input type="hidden" name="id_barang" value="{{ $item->id_barang }}">
                        @endforeach
                        <button type="submit" class="btn btn-success form-control" id="chekout">Kirim</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
