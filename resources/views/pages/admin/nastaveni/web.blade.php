<!-- create.blade.php -->
@extends('layouts.admin.panel')
@section('title', 'Nastavení webu')

@section('content')
    <div class="container">
        <h3>Nastavení webu</h3>
        <form action="{{ url('/admin/nastaveni/web') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nazev_webu" class="form-label">Název webu</label>
                <input type="text" class="form-control" id="nazev_webu" name="nazev_webu" value="{{ $nastaveniWebu->nazev_webu ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="popis_webu" class="form-label">Popis webu</label>
                <textarea class="form-control" id="popis_webu" name="popis_webu" rows="3">{{ $nastaveniWebu->popis_webu ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <label for="kontaktni_email" class="form-label">Kontaktní e-mail</label>
                <input type="email" class="form-control" id="kontaktni_email" name="kontaktni_email" value="{{ $nastaveniWebu->kontaktni_email ?? '' }}">
            </div>
            <div class="mb-3">
                <label for="telefon" class="form-label">Telefon</label>
                <input type="text" class="form-control" id="telefon" name="telefon" value="{{ $nastaveniWebu->telefon ?? '' }}">
            </div>
            <button type="submit" class="btn btn-primary">Vytvořit</button>
        </form>
    </div>
@endsection
