@extends('template.master_auth')

@section('content')
    <div class="container page-auth">
        <div class="row justify-content-center pb-200 pt-5">
            <div class="col-11 col-md-6 text-center">
                <img src={{ asset('img/undraw_post_re_mtr4.svg') }} class="ilustrasi" />
            </div>
            <div class="col-11 col-md-6" id="form_login">
                <h4 class="fw-bold mb-3">Masuk</h4>
                @if (Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <form action="{{ url('/login') }}" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" value="{{ old('email') }}" name="email"
                        class="form-control border-0 py-2 {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email"
                        placeholder="Masukkan email kamu" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">{{ $errors->first('email') }}</span>
                    @endif
                    <label for="password" class="form-label mt-3">Kata Sandi</label>
                    <input type="password" value="{{ old('password') }}" name="password"
                        class="form-control border-0 py-2 {{ $errors->has('password') ? ' is-invalid' : '' }}"
                        id="password" placeholder="Masukkan kata sandi kamu" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">{{ $errors->first('password') }}</span>
                    @endif
                    <div class="d-flex align-items-center justify-content-between mb-5 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="showPass">
                            <label class="form-check-label" for="showPass">
                                Tampilkan kata sandi
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary py-2 rounded-pill text-white w-100" type="submit">Masuk</button>
                    <p class="mt-3 mb-0 text-center">Belum memiliki akun? <a href="{{ url('/daftar') }}"
                            class="text-primary fw-bold text-decoration-none">daftar</a></p>
                </form>
            </div>
        </div>
    </div>
@endsection
