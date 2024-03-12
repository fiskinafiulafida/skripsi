@extends('layouts.loginregister')

@section('title', 'Register SiiEndog')

@section('main')
<!-- Sign up form -->
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign Up</h2>
                <form action="register" method="POST" class="register-form" id="register-form">
                    @csrf
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" class="form @error('name') is-invalid @enderror" placeholder="Name" />
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" class="form @error('email') is-invalid @enderror" placeholder="Email" />
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" class="form @error('password') is-invalid @enderror" placeholder="Password" />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <i class="zmdi zmdi-accounts"></i> Role User
                        <select name="role" id="role" class="form-select form-select-sm @error('role') is-invalid @enderror" aria-label=".form-select-sm example">
                            <option selected></option>
                            <option value="admin">Admin</option>
                            <option value="owner">Owner</option>
                            <option value="pegawai">Pegawai</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <!-- </div> -->
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="{{ asset('LoginRegister/images/Register.png')}}" alt="sing up image"></figure>
                <a href="/" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>
</section>
@endsection