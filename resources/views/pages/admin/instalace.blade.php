@extends('layouts.admin.instalace')
@section('title', 'Instalace ActorCMS')

@section('content')
    <div class="card mt-4 mb-4">
        <div class="card-body">
            <h1 class="card-title text-center">Instalace ActorCMS</h1>
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
            <form action="{{ url('/admin/instalace') }}" method="POST">
                @csrf
                <fieldset>
                    <legend>Nastavení databáze</legend>
                    <div class="mb-3">
                        <label for="db_host" class="form-label">Hostitel databáze<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="db_host" name="db_host" required>
                    </div>
                    <div class="mb-3">
                        <label for="db_name" class="form-label">Název databáze<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="db_name" name="db_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="db_user" class="form-label">Uživatel databáze<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="db_user" name="db_user" required>
                    </div>
                    <div class="mb-3">
                        <label for="db_password" class="form-label">Heslo databáze</label>
                        <input type="password" class="form-control" id="db_password" name="db_password">
                    </div>
                </fieldset>
                <hr>
                <fieldset>
                    <legend>Vytvoření účtu správce</legend>
                    <div class="mb-3">
                        <label for="admin_name" class="form-label">Jméno správce<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="admin_name" name="admin_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_email" class="form-label">Email správce<sup class="text-danger">*</sup></label>
                        <input type="email" class="form-control" id="admin_email" name="admin_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="admin_password" class="form-label">Heslo správce<sup class="text-danger">*</sup></label>
                        <input type="password" class="form-control" id="admin_password" name="admin_password" required>
                    </div>
                </fieldset>
                <hr>
                <fieldset>
                    <legend>Nastavení webu</legend>
                    <div class="mb-3">
                        <label for="website_name" class="form-label">Titulek webu<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="website_name" name="website_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="website_description" class="form-label">Popis webu</label>
                        <textarea class="form-control" id="website_description" name="website_description"></textarea>
                    </div>
                </fieldset>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Instalovat</button>
                </div>
            </form>
        </div>
    </div>
@endsection
