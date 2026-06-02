@extends('admin.layout')

@section('title', $event->exists ? 'Editar evento' : 'Nuevo evento')

@section('content')
    <div class="topbar">
        <div>
            <p class="muted">Eventos</p>
            <h1>{{ $event->exists ? 'Editar evento' : 'Nuevo evento' }}</h1>
        </div>
        <a class="button-secondary" href="{{ route('admin.events.index') }}">Volver</a>
    </div>

    <form class="grid-form" action="{{ $action }}" method="POST">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <label>Titulo
            <input name="title" value="{{ old('title', $event->title) }}" required>
        </label>
        <label>Slug
            <input name="slug" value="{{ old('slug', $event->slug) }}" placeholder="se genera automaticamente">
        </label>
        <label>Fecha
            <input type="date" name="event_date" value="{{ old('event_date', optional($event->event_date)->format('Y-m-d')) }}" required>
        </label>
        <label>Ubicacion
            <input name="location" value="{{ old('location', $event->location) }}">
        </label>
        <label class="full">URL de imagen
            <input name="image_url" value="{{ old('image_url', $event->image_url) }}" placeholder="https://...">
        </label>
        <label class="full">Descripcion
            <textarea name="description">{{ old('description', $event->description) }}</textarea>
        </label>
        <label class="checkbox full">
            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $event->is_published))>
            Publicar evento
        </label>
        <div class="full actions">
            <button class="button" type="submit">Guardar evento</button>
            <a class="button-secondary" href="{{ route('admin.events.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
