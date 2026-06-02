@extends('admin.layout')

@section('title', 'Mensajes')

@section('content')
    <div class="topbar">
        <div>
            <p class="muted">Contacto web</p>
            <h1>Mensajes</h1>
        </div>
        <span class="button-secondary">{{ $newCount }} nuevos</span>
    </div>

    <div class="panel">
        <table>
            <thead>
                <tr>
                    <th>Contacto</th>
                    <th>Asunto</th>
                    <th>Interes</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>
                            <strong>{{ $message->full_name }}</strong><br>
                            <span class="muted">{{ $message->email }}</span><br>
                            <span class="muted">{{ $message->phone }}</span>
                        </td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->interest ?: 'General' }}</td>
                        <td>{{ ucfirst($message->status) }}</td>
                        <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="actions">
                                <a class="button-secondary" href="{{ route('admin.messages.show', $message) }}">Ver</a>
                                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('¿Eliminar este mensaje?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button-danger" type="submit">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6">Aun no hay mensajes de contacto.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $messages->links() }}
        </div>
    </div>
@endsection
