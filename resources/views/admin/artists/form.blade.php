@extends('admin.layout')

@section('title', $artist->exists ? 'Editar artista' : 'Nuevo artista')

@section('content')
    <div class="topbar">
        <div>
            <p class="muted">Artistas</p>
            <h1>{{ $artist->exists ? 'Editar artista' : 'Nuevo artista' }}</h1>
        </div>
        <a class="button-secondary" href="{{ route('admin.artists.index') }}">Volver</a>
    </div>

    <form class="grid-form" action="{{ $action }}" method="POST">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <label>Nombre
            <input name="name" value="{{ old('name', $artist->name) }}" required>
        </label>
        <label>Slug
            <input name="slug" value="{{ old('slug', $artist->slug) }}" placeholder="se genera automaticamente">
        </label>
        <label>Especialidad
            <input name="specialty" value="{{ old('specialty', $artist->specialty) }}" placeholder="Pintura, muralismo, fotografia...">
        </label>
        <label>URL de foto
            <input name="photo_url" value="{{ old('photo_url', $artist->photo_url) }}" placeholder="https://...">
        </label>
        <label class="full">Obras representativas
            <input name="featured_works" value="{{ old('featured_works', $artist->featured_works) }}">
        </label>
        <label class="full">Biografia
            <textarea name="bio">{{ old('bio', $artist->bio) }}</textarea>
        </label>
        <div class="full actions">
            <button class="button" type="submit">Guardar artista</button>
            <a class="button-secondary" href="{{ route('admin.artists.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
