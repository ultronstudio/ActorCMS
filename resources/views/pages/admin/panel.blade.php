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
    </div>
@endsection
