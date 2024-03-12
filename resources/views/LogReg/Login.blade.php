@extends('layouts.loginregister')

@section('title', 'Login SiiEndog')

@section('main')
<!-- Sing in  Form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('LoginRegister/images/Log.png')}}" alt="sing up image"></figure>
                <!-- <a href="/register" class="signup-image-link">Create an account</a> -->
            </div>

            <div class="signin-form">
                <h2 class="form-title">Sign In</h2>
                <div>
                    <!-- Pesan Login dan Register Sukses dan Gagal -->
                    @if (session('Pesan') == 'Register Berhasil')
                    <div class="alert alert-success">
                        Berhasil Melakukan Register Akun
                    </div>
                    @elseif (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                </div>
                <form method="POST" action="/">
                    @csrf
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="email" id="email" class="form @error('email') is-invalid @enderror" placeholder="Email" />
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" class="form @error('password') is-invalid @enderror" id="password" placeholder="Password" />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection