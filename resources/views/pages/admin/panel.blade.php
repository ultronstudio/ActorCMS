@extends('layouts.admin.panel')
@section('title', 'Administrace')
@section('content')
    <h1>Vítejte v administračním panelu</h1>

    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Příspěvky
                </div>
                <div class="card-body">
                    <p>Zde můžete spravovat příspěvky.</p>
                    <a href="/admin/prispevky" class="btn btn-primary">Přejít na příspěvky</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    Nastavení
                </div>
                <div class="card-body">
                    <p>Zde můžete spravovat nastavení webu.</p>
                    <a href="/admin/nastaveni" class="btn btn-primary">Přejít do nastavení</a>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <h3>Poslední příspěvek</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Název</th>
                        <th>Odkaz</th>
                        <th>Datum publikování</th>
                        <th>Datum poslední aktualizace</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $last_post->title }}</td>
                        <td><a
                                href="{{ url('/' . $last_post->type . '/' . $last_post->slug) }}" target="_blank">/{{ $last_post->type }}/{{ $last_post->slug }}</a>
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($last_post->created_at)->locale('cs')->isoFormat('DD. MMMM YYYY HH:mm:ss', 'Do MMMM YYYY HH:mm:ss') }}
                        </td>
                        <td>
                            {{ Carbon\Carbon::parse($last_post->updated_at)->locale('cs')->isoFormat('DD. MMMM YYYY HH:mm:ss', 'Do MMMM YYYY HH:mm:ss') }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
