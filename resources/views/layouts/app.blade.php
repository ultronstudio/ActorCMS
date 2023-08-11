<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $nastaveniWebu->popis_webu ?? '' }}">
    <title>
        @if (View::hasSection('title'))
            @yield('title') | {{ $nastaveniWebu->nazev_webu }}
        @else
            {{ $nastaveniWebu->nazev_webu }}
        @endif
    </title>
    @if ($nastaveniWebu->ikona)
        <link rel="shortcut icon" href="{{ $nastaveniWebu->ikona }}" type="image/x-icon">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://vjs.zencdn.net/8.3.0/video-js.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-youtube@3.0.1/dist/Youtube.min.js"></script>
    <script>
        $(document).ready(function() {
            // Načtení hodnoty primární barvy z databáze
            var primaryColor = "{{ $nastaveniWebu->primary_color }}";
            // Načtení hodnoty sekundární barvy z databáze
            var secondaryColor = "{{ $nastaveniWebu->secondary_color }}";

            // Vytvoření a přidání stylu do hlavičky
            var styleTag = document.createElement('style');
            styleTag.innerHTML = ":root { --bs-primary: " + primaryColor + "; --bs-secondary-color: " +
                secondaryColor + "; }";
            document.head.appendChild(styleTag);
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            @if ($nastaveniWebu->logo)
                <a class="navbar-brand" href="/">
                    <img src="{{ $nastaveniWebu->logo }}" alt="Logo" style="width: 120px; height: auto;">
                </a>
            @else
                <a class="navbar-brand" href="/">{{ $nastaveniWebu->nazev }}</a>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @foreach ($navigationItems as $item)
                        @php
                            $isActive = $item->url == '/' . Request::path();
                        @endphp
                        <li class="nav-item">
                            <a class="nav-link {{ $isActive ? 'active' : '' }}"
                                href="{{ $item->url }}">{{ $item->text }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
