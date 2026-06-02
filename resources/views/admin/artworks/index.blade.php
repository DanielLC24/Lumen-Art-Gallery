@extends('admin.layout')

@section('title', 'Obras')

@section('content')
    <div class="topbar">
        <div>
            <p class="muted">Catalogo</p>
            <h1>Obras</h1>
        </div>
        <a class="button" href="{{ route('admin.artworks.create') }}">Nueva obra</a>
    </div>

    <div class="panel">
        <table>
            <thead>
                <tr>
                    <th>Obra</th>
                    <th>Artista</th>
                    <th>Precio</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($artworks as $artwork)
                    <tr>
                        <td><strong>{{ $artwork->title }}</strong><br><span class="muted">{{ $artwork->year }} · {{ $artwork->category }}</span></td>
                        <td>{{ $artwork->artist?->name }}</td>
                        <td>{{ $artwork->price }}</td>
                        <td>{{ $artwork->availability }}</td>
                        <td>
                            <div class="actions">
                                <a class="button-secondary" href="{{ route('artworks.show', $artwork->slug) }}">Ver</a>
                                <a class="button-secondary" href="{{ route('admin.artworks.edit', $artwork) }}">Editar</a>
                                <form action="{{ route('admin.artworks.destroy', $artwork) }}" method="POST" onsubmit="return confirm('¿Eliminar esta obra?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button-danger" type="submit">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Aun no hay obras.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $artworks->links() }}</div>
    </div>
@endsection
