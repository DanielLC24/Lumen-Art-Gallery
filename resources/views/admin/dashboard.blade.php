@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="topbar">
        <div>
            <p class="muted">Panel de gestion</p>
            <h1>Lumen Admin</h1>
        </div>
        <a class="button" href="{{ route('admin.artworks.create') }}">Nueva obra</a>
    </div>

    <div class="grid">
        <div class="card"><span class="muted">Artistas</span><strong>{{ $artistCount }}</strong></div>
        <div class="card"><span class="muted">Obras</span><strong>{{ $artworkCount }}</strong></div>
        <div class="card"><span class="muted">Eventos</span><strong>{{ $eventCount }}</strong></div>
        <div class="card"><span class="muted">Mensajes nuevos</span><strong>{{ $newMessageCount }}</strong></div>
    </div>

    <div class="topbar" style="margin-top: 34px;">
        <h2>Obras recientes</h2>
        <a class="button-secondary" href="{{ route('admin.artworks.index') }}">Gestionar obras</a>
    </div>

    <div class="panel">
        <table>
            <thead>
                <tr>
                    <th>Obra</th>
                    <th>Artista</th>
                    <th>Precio</th>
                    <th>Disponibilidad</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($latestArtworks as $artwork)
                    <tr>
                        <td>{{ $artwork->title }}</td>
                        <td>{{ $artwork->artist?->name }}</td>
                        <td>{{ $artwork->price }}</td>
                        <td>{{ $artwork->availability }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">Aun no hay obras registradas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
