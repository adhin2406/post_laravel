@extends('template.master_auth')

@section('content')
    <div class="container page-auth">
        <div class="row justify-content-center pb-200 pt-5">
            <div class="col-11 col-md-6 text-center">
                <img src={{ asset('img/undraw_add_post_re_174w.svg') }} class="ilustrasi" />
            </div>
            <div class="col-11 col-md-6" id="form_login">
                <h4 class="fw-bold mb-4">Daftar</h4>
                <form action="{{ url('/daftar') }}" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" value="{{ old('email') }}" name="email"
                        class="form-control border-0 py-2 {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                        placeholder="Masukkan email kamu">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                    @endif
                    <label for="nama" class="form-label mt-3">Nama Lengkap</label>
                    <input type="text" value="{{ old('nama') }}" name="nama"
                        class="form-control border-0 py-2 {{ $errors->has('nama') ? ' is-invalid' : '' }}" id="nama"
                        placeholder="Masukkan nama lengkap kamu">
                    @if ($errors->has('nama'))
                        <span class="invalid-feedback">{{ $errors->first('nama') }}</span>
                    @endif
                    <label for="password" class="form-label mt-3">Kata Sandi</label>
                    <input type="password" value="{{ old('password') }}" name="password"
                        class="form-control border-0 py-2 {{ $errors->has('password') ? ' is-invalid' : '' }}"
                        id="password" placeholder="Masukkan kata sandi kamu">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                    @endif
                    <div class="form-check mb-5 mt-3">
                        <input class="form-check-input" type="checkbox" id="showPass">
                        <label class="form-check-label" for="showPass">
                            Tampilkan kata sandi
                        </label>
                    </div>
                    <button class="btn btn-primary py-2 rounded-pill text-white w-100" type="submit">Daftar</button>
                    <p class="mt-3 mb-0 text-center">Sudah memiliki akun? <a href="{{ url('/login') }}"
                            class="text-primary fw-bold text-decoration-none">masuk</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection
