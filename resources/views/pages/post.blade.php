@extends('layouts.app')
@section('title', $post->title)

@section('content')
    <div class="container mb-5">
        <h1>{{ $post->title }}</h1>
        <p style="font-size: 12px">Poslední aktualizace: {{ Carbon\Carbon::parse($post->updated_at)->locale('cs')->isoFormat('Do. MMMM YYYY v HH:mm') }}</p>
        <p style="font-size: 15px">Premiéra: {{ Carbon\Carbon::parse($post->acting_at)->locale('cs')->isoFormat('Do. MMMM YYYY') }}</p>
        <p>{!! $post->content !!}</p>
        @if ($post->trailer_youtube_url)
            @php
                $parts = explode('=', $post->trailer_youtube_url);
                $videoId = end($parts);
            @endphp
            <h3>Trailer</h3>
            <video width="560" height="315" id="my-player" class="video-js vjs-big-play-centered vjs-default-skin" controls
                preload="auto"
                data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v={{ $videoId }}"}] }'></video>
        @endif
    </div>
    <script>
        var player = videojs('my-player');
    </script>
@endsection
