@extends('auth.app')
@section('loginContent')
<div class="card">
    <div class="card-body">
        <!-- Logo -->
        <div class="app-brand justify-content-center">
            <a href="{{ url('/') }}" class="app-brand-link">
                <span class="app-brand-text demo menu-text fw-bolder ms-2">
                    <img width="50px" src="{{ asset('uploads/setting') }}/{{ $setting->logo }}" alt="">
                </span>
            </a>
        </div>
        <!-- /Logo -->
        <h4 class="mb-2">Welcome! 👋</h4>
        <p class="mb-4">Please sign-in to your account</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('login.post') }}" method="POST">
             @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email </label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3 form-password-toggle">
                <div class="input-group input-group-merge">
                    <input type="password" id="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
        </form>

    </div>
</div>
@endsection

