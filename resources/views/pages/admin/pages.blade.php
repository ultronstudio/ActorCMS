@extends('layouts.admin.panel')
@section('title', 'Administrace')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h1>Stránky webu</h1>
            </div>
            <div>
                <a href="{{ url('/admin/stranka/nova') }}" class="btn btn-info">Nová stránka</a>
            </div>
        </div>
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
        <table class="table">
            <thead>
                <tr>
                    <th>Název</th>
                    <th>Odkaz</th>
                    <th>Datum publikování</th>
                    <th>Datum poslední aktualizace</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td><a href="{{ url('/' . $page->slug) }}"
                                target="_blank">/{{ $page->slug }}</a>
                        </td>
                        <td>{{ Carbon\Carbon::parse($page->created_at)->locale('cs')->isoFormat('Do. MMMM YYYY v HH:mm:ss') }}
                        </td>
                        <td>{{ Carbon\Carbon::parse($page->updated_at)->locale('cs')->isoFormat('Do. MMMM YYYY v HH:mm:ss') }}
                        </td>
                        <td>
                            <a href="{{ url('/admin/stranka/upravit/' . $page->id) }}" class="btn btn-success">Upravit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
