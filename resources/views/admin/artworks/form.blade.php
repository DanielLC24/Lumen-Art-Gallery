@extends('admin.layout')

@section('title', $artwork->exists ? 'Editar obra' : 'Nueva obra')

@section('content')
    <div class="topbar">
        <div>
            <p class="muted">Obras</p>
            <h1>{{ $artwork->exists ? 'Editar obra' : 'Nueva obra' }}</h1>
        </div>
        <a class="button-secondary" href="{{ route('admin.artworks.index') }}">Volver</a>
    </div>

    <form class="grid-form" action="{{ $action }}" method="POST">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <label>Titulo
            <input name="title" value="{{ old('title', $artwork->title) }}" required>
        </label>
        <label>Artista
            <select name="artist_id" required>
                <option value="">Selecciona un artista</option>
                @foreach ($artists as $artist)
                    <option value="{{ $artist->id }}" @selected(old('artist_id', $artwork->artist_id) == $artist->id)>{{ $artist->name }}</option>
                @endforeach
            </select>
        </label>
        <label>Slug
            <input name="slug" value="{{ old('slug', $artwork->slug) }}" placeholder="se genera automaticamente">
        </label>
        <label>Categoria
            <select name="category">
                @foreach (['abstracto', 'moderno', 'digital', 'escultura', 'fotografia'] as $category)
                    <option value="{{ $category }}" @selected(old('category', $artwork->category) === $category)>{{ ucfirst($category) }}</option>
                @endforeach
            </select>
        </label>
        <label>Tecnica
            <input name="technique" value="{{ old('technique', $artwork->technique) }}">
        </label>
        <label>Dimensiones
            <input name="dimensions" value="{{ old('dimensions', $artwork->dimensions) }}">
        </label>
        <label>Año
            <input name="year" value="{{ old('year', $artwork->year) }}">
        </label>
        <label>Precio
            <input name="price" value="{{ old('price', $artwork->price) }}" required>
        </label>
        <label>Disponibilidad
            <input name="availability" value="{{ old('availability', $artwork->availability) }}" required>
        </label>
        <label>URL de imagen
            <input name="image_url" value="{{ old('image_url', $artwork->image_url) }}" placeholder="https://...">
        </label>
        <label class="full">URL de referencia
            <input name="source_url" value="{{ old('source_url', $artwork->source_url) }}" placeholder="https://...">
        </label>
        <label class="full">Descripcion
            <textarea name="description">{{ old('description', $artwork->description) }}</textarea>
        </label>
        <label class="checkbox full">
            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $artwork->is_featured))>
            Mostrar como obra destacada
        </label>
        <div class="full actions">
            <button class="button" type="submit">Guardar obra</button>
            <a class="button-secondary" href="{{ route('admin.artworks.index') }}">Cancelar</a>
        </div>
    </form>
@endsection
