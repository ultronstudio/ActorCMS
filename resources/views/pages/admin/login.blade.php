@extends('layouts.admin.instalace')
@section('title', 'Instalace ActorCMS')

@section('content')
    <div class="card mt-4 mb-4">
        <div class="card-body">
            <h1 class="card-title text-center">Přihlášení do ActorCMS</h1>
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-4 mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4 mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <form method="POST" action="{{ url('/admin/login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Heslo</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Přihlásit se</button>
                </div>
            </form>
        </div>
    </div>
@endsection
