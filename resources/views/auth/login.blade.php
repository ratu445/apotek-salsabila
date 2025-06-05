@extends('layouts.app', ['title' => 'Login'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header bg-primary text-white">
                <h3 class="text-center font-weight-light my-4">
                    <i class="fas fa-clinic-medical me-2"></i> Pharmacy System
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control @error('username') is-invalid @enderror" id="username" 
                               type="text" name="username" value="{{ old('username') }}" required autofocus />
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control @error('password') is-invalid @enderror" id="password" 
                               type="password" name="password" required />
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" id="remember" type="checkbox" name="remember" />
                        <label class="form-check-label" for="remember">Remember Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <div class="small">Apotek Sehat © {{ date('Y') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection