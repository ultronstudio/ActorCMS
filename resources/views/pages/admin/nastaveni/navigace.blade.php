<!-- navigation-settings.blade.php -->
@extends('layouts.admin.panel')
@section('title', 'Nastavení navigace')

@section('content')
    <div class="container">
        <h3>Nastavení navigace</h3>
        <form action="{{ url('/admin/nastaveni/navigace') }}" method="POST">
            @csrf
            <div id="navigation-form">
                <!-- Dynamické řádky formuláře -->
                @foreach ($navigationItems as $item)
                    <div class="row mb-3">
                        <div class="col">
                            <input type="text" name="text[]" placeholder="Text" class="form-control"
                                value="{{ $item->text }}">
                        </div>
                        <div class="col">
                            <input type="text" name="url[]" placeholder="URL" class="form-control url-input"
                                value="{{ $item->url }}" data-id="{{ $item->id }}" autocomplete="off">
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-danger remove-row">-</button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                <button type="button" class="btn btn-primary add-row">+</button>
                <button type="submit" class="btn btn-success">Uložit</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Přidání řádku formuláře
            $('.add-row').click(function() {
                var row = $('<div class="row">' +
                    '<div class="col mb-3">' +
                    '<input type="text" name="text[]" placeholder="Text" class="form-control">' +
                    '</div>' +
                    '<div class="col">' +
                    '<input type="text" name="url[]" placeholder="URL" class="form-control url-input" autocomplete="off">' +
                    '</div>' +
                    '<div class="col">' +
                    '<button type="button" class="btn btn-danger remove-row">-</button>' +
                    '</div>' +
                    '</div>');

                $('#navigation-form').append(row);
            });

            // Odstranění řádku formuláře
            $(document).on('click', '.remove-row', function() {
                $(this).closest('.row').remove();
            });
    </script>
@endsection
