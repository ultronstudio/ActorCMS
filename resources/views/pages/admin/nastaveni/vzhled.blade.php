@extends('layouts.admin.panel')
@section('title', 'Nastavení vzhledu')

@section('content')
    <div class="container mb-5">
        <h3>Nastavení vzhledu webu</h3>
        <form action="{{ url('/admin/nastaveni/vzhled') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="icon" class="form-label">Ikona</label>
                <input type="text" name="icon" id="icon" value="{{ $nastaveniWebu->ikona }}" style="display: none;"
                    readonly>
                <div id="icon-preview">
                    @if ($nastaveniWebu->ikona)
                        <img src="{{ url($nastaveniWebu->ikona) }}" alt="Okona"
                            style="max-width: auto; max-height: 175px; width: auto; height: 175px !important;">
                    @endif
                </div>
                <button type="button" class="btn btn-primary mt-2 btn-select-image" data-type="icon">Vybrat
                    obrázek</button>
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="text" name="logo" id="logo" value="{{ $nastaveniWebu->logo }}"
                    style="display: none;" readonly>
                <div id="logo-preview">
                    @if ($nastaveniWebu->logo)
                        <img src="{{ url($nastaveniWebu->logo) }}" alt="Logo"
                            style="max-width: auto; max-height: 175px; width: auto; height: 175px !important;">
                    @endif
                </div>
                <button type="button" class="btn btn-primary mt-2 btn-select-image" data-type="logo">Vybrat obrázek</button>
            </div>
            <div class="mb-3">
                <label for="primary_color">Hlavní barva</label>
                <input type="color" name="primary_color" id="primary_color" class="form-control"
                    value="{{ $nastaveniWebu->primary_color }}">
            </div>
            <div class="mb-3">
                <label for="secondary_color">Vedlejší barva</label>
                <input type="color" name="secondary_color" id="secondary_color" class="form-control"
                    value="{{ $nastaveniWebu->secondary_color }}">
            </div>
            <div class="mb-3">
                <label for="font_family">Písmo</label>
                <select name="font_family" id="font_family" class="form-control">
                    <option value="Arial" {{ $nastaveniWebu->font_family == 'Arial' ? 'selected' : false }}>Arial</option>
                    <option value="Verdana" {{ $nastaveniWebu->font_family == 'Verdana' ? 'selected' : false }}>Verdana
                    </option>
                    <option value="Helvetica" {{ $nastaveniWebu->font_family == 'Helvetica' ? 'selected' : false }}>
                        Helvetica</option>
                </select>
                <div class="row mt-2">
                    <div class="col">
                        Náhled písma
                    </div>
                    <div class="col">
                        <div id="font_preview" class="select-preview"></div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Uložit</button>
        </form>
        <!-- Modální okno pro výběr a nahrávání obrázků -->
        <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="imageModalLabel">Výběr obrázku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Seznam nahraných obrázků -->
                        <div id="imageList"></div>

                        <!-- Formulář pro nahrání nového obrázku -->
                        <form id="uploadForm">
                            <input type="file" name="image" id="imageInput" accept="image/png" class="form-control">
                            <button type="submit" id="uploadButton" class="btn btn-success mt-3">Nahrát obrázek
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                    style="display: none" id="loadingSpinner"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var fontSelect = document.getElementById('font_family');
            var previewElement = document.getElementById('font_preview');

            fontSelect.addEventListener('change', function() {
                var selectedFont = fontSelect.value;
                previewElement.style.fontFamily = selectedFont;
                previewElement.innerText = selectedFont;
            });

            $(document).ready(function() {
                var imageList = $('#imageList');
                var uploadForm = $('#uploadForm');
                var uploadButton = $('#uploadButton');
                var loadingMessage = $('#loadingMessage');
                var spinner = $('#loadingSpinner');
                var btnSelectImage = $('#btn-select-image');

                // Funkce pro aktualizaci náhledového obrázku
                function updateLogo(imageUrl) {
                    $('#logo-preview').html('<img src="' + imageUrl +
                        '" alt="Logo"  style="max-width: auto; max-height: 175px; width: auto; height: 175px !important;">'
                    );
                    $('#logo').val(imageUrl);
                }

                function updateIcon(imageUrl) {
                    $('#icon-preview').html('<img src="' + imageUrl +
                        '" alt="Ikona"  style="max-width: auto; max-height: 175px; width: auto; height: 175px !important;">'
                    );
                    $('#icon').val(imageUrl);
                }

                // Získání seznamu obrázků a jejich zobrazení
                $.ajax({
                    url: '/api/images',
                    method: 'GET',
                    success: function(response) {
                        var images = response.data;

                        if (images) {
                            if (images.length === 0) {
                                imageList.append('<p>Žádné obrázky nejsou k dispozici.</p>');
                            } else {
                                $.each(images, function(index, image) {
                                    imageList.append(
                                        '<button type="button" class="btn btn-outline-primary btn-image mx-2 mb-3" data-url="' +
                                        image.path + '"><img src="' + image.path + '" alt="' +
                                        image.filename +
                                        '" style="max-width: auto; max-height: 75px; width: auto; height: 75px !important;""></button>'
                                    );
                                });
                            }
                        } else {
                            imageList.append('<p>Obrázky se nepodařilo načíst.</p>');
                        }
                    }
                });

                // Otevření modalu po kliknutí na tlačítko pro výběr obrázku
                $('.btn-select-image').on('click', function() {
                    var logoUrl = '';
                    var imageType = $(this).data('type');
                    $('#imageModal').modal('show');

                    $('.btn-image').removeClass('active');

                    if (imageType == 'logo') {
                        logoUrl = $('#logo').val();
                        $('.btn-image[data-url="' + logoUrl + '"]').addClass('active');
                    } else if (imageType == 'icon') {
                        logoUrl = $('#icon').val();
                        $('.btn-image[data-url="' + logoUrl + '"]').addClass('active');
                    }

                    $('#imageModal').data('image-type', imageType);
                });

                // Změna náhledového obrázku po kliknutí na tlačítko obrázku v modalu
                $(document).on('click', '.btn-image', function() {
                    var imageUrl = $(this).data('url');
                    var imageType = $('#imageModal').data('image-type');
                    // Odebrání třídy "active" ze všech tlačítek obrázků
                    $('.btn-image').removeClass('active');
                    // Přidání třídy "active" k vybranému tlačítku obrázku
                    $(this).addClass('active');

                    if (imageType == 'logo') {
                        updateLogo(imageUrl);
                    } else if (imageType == 'icon') {
                        updateIcon(imageUrl);
                    }

                    // Zavření modálního okna
                    $('#imageModal').modal('hide');
                });

                // Zpracování odeslání formuláře pro nahrání obrázku
                uploadForm.on('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);
                    uploadButton.prop('disabled', true);
                    spinner.show();

                    $.ajax({
                        url: '/api/images',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            /*
                            var imageUrl = response.data.path;
                            // Aktualizace náhledového obrázku
                            updateThumbnail(imageUrl);
                            */
                            console.log(response.data);
                            // Zavření modalu
                            $('#imageModal').modal('hide');
                        },
                        error: function() {
                            console.error('Nahrávání obrázku se nezdařilo');
                        },
                        complete: function() {
                            uploadButton.prop('disabled', false);
                            spinner.hide();
                        },
                    });
                });
            });
        </script>
    </div>
@endsection
