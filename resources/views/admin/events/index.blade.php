@extends('admin.layout')

@section('title', 'Eventos')

@section('content')
    <div class="topbar">
        <div>
            <p class="muted">Agenda</p>
            <h1>Eventos</h1>
        </div>
        <a class="button" href="{{ route('admin.events.create') }}">Nuevo evento</a>
    </div>

    <div class="panel">
        <table>
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Fecha</th>
                    <th>Ubicacion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td><strong>{{ $event->title }}</strong><br><span class="muted">{{ $event->slug }}</span></td>
                        <td>{{ $event->event_date?->format('d/m/Y') }}</td>
                        <td>{{ $event->location }}</td>
                        <td>{{ $event->is_published ? 'Publicado' : 'Oculto' }}</td>
                        <td>
                            <div class="actions">
                                <a class="button-secondary" href="{{ route('admin.events.edit', $event) }}">Editar</a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('¿Eliminar este evento?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button-danger" type="submit">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Aun no hay eventos.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $events->links() }}</div>
    </div>
@endsection
