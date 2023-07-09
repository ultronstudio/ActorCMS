@extends('layouts.admin.panel')
@section('title', 'Administrace')
@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h1>Upravit příspěvek</h1>
            </div>
            <div>
                <a href="{{ url('/admin/prispevek/novy') }}" class="btn btn-info">Nový příspěvek</a>
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
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td><a href="{{ url('/' . $post->type . '/' . $post->slug) }}"
                                target="_blank">/{{ $post->type }}/{{ $post->slug }}</a>
                        </td>
                        <td>{{ Carbon\Carbon::parse($post->created_at)->locale('cs')->isoFormat('Do. MMMM YYYY v HH:mm:ss') }}
                        </td>
                        <td>{{ Carbon\Carbon::parse($post->updated_at)->locale('cs')->isoFormat('Do. MMMM YYYY v HH:mm:ss') }}
                        </td>
                        <td>
                            <a href="{{ url('/admin/prispevek/upravit/' . $post->id) }}" class="btn btn-success">Upravit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
