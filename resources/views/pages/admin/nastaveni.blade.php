@extends('layouts.admin.panel')
@section('title', 'Nastavení')

@section('content')
    <div class="container">
        <h1>Nastavení</h1>
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
        <div class="list-group">
            <a href="{{ url('/admin/nastaveni/web') }}" class="list-group-item list-group-item-action">Obecné informace</a>
            <a href="{{ url('/admin/nastaveni/vzhled') }}" class="list-group-item list-group-item-action">Nastavení vzhledu</a>
            <a href="{{ url('/admin/nastaveni/navigace') }}" class="list-group-item list-group-item-action">Nastavení navigace</a>
            <a href="{{ url('/admin/nastaveni/seo') }}" class="list-group-item list-group-item-action">Nastavení SEO</a>
            <a href="{{ url('/admin/nastaveni/sitove-udaje') }}" class="list-group-item list-group-item-action">Nastavení sociálních sítí</a>
            <a href="{{ url('/admin/nastaveni/jazyk') }}" class="list-group-item list-group-item-action">Nastavení jazyka</a>
        </div>
    </div>
@endsection
