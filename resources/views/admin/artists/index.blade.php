@extends('admin.layout')

@section('title', 'Artistas')

@section('content')
    <div class="topbar">
        <div>
            <p class="muted">Catalogo</p>
            <h1>Artistas</h1>
        </div>
        <a class="button" href="{{ route('admin.artists.create') }}">Nuevo artista</a>
    </div>

    <div class="panel">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Especialidad</th>
                    <th>Obras</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($artists as $artist)
                    <tr>
                        <td><strong>{{ $artist->name }}</strong><br><span class="muted">{{ $artist->slug }}</span></td>
                        <td>{{ $artist->specialty }}</td>
                        <td>{{ $artist->artworks_count }}</td>
                        <td>
                            <div class="actions">
                                <a class="button-secondary" href="{{ route('admin.artists.edit', $artist) }}">Editar</a>
                                <form action="{{ route('admin.artists.destroy', $artist) }}" method="POST" onsubmit="return confirm('Eliminar este artista tambien eliminara sus obras. ¿Continuar?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button-danger" type="submit">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">Aun no hay artistas.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $artists->links() }}</div>
    </div>
@endsection
