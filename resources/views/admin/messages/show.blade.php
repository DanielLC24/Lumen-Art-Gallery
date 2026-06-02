@extends('admin.layout')

@section('title', 'Mensaje de contacto')

@section('content')
    <div class="topbar">
        <div>
            <p class="muted">Mensaje recibido {{ $message->created_at->format('d/m/Y H:i') }}</p>
            <h1>{{ $message->full_name }}</h1>
        </div>
        <a class="button-secondary" href="{{ route('admin.messages.index') }}">Volver</a>
    </div>

    <div class="grid" style="margin-bottom: 18px;">
        <div class="card">
            <span class="muted">Correo</span>
            <p><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
        </div>
        <div class="card">
            <span class="muted">Telefono</span>
            <p><a href="tel:{{ $message->phone }}">{{ $message->phone }}</a></p>
        </div>
        <div class="card">
            <span class="muted">Preferencia</span>
            <p>{{ $message->preferred_contact ?: 'No indicada' }}</p>
        </div>
    </div>

    <form class="grid-form" action="{{ route('admin.messages.update', $message) }}" method="POST" style="margin-bottom: 18px;">
        @csrf
        @method('PATCH')
        <label>
            Estado
            <select name="status">
                @foreach ($statuses as $status)
                    <option value="{{ $status }}" @selected(old('status', $message->status) === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </label>
        <label>
            Leido
            <input type="text" value="{{ $message->read_at?->format('d/m/Y H:i') ?: 'Pendiente' }}" disabled>
        </label>
        <div class="full actions">
            <button class="button" type="submit">Guardar estado</button>
        </div>
    </form>

    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('¿Eliminar este mensaje?')" style="margin-bottom: 18px;">
        @csrf
        @method('DELETE')
        <button class="button-danger" type="submit">Eliminar mensaje</button>
    </form>

    <div class="panel" style="padding: 24px;">
        <p class="muted">Asunto</p>
        <h2>{{ $message->subject }}</h2>
        <p class="muted">Interes: {{ $message->interest ?: 'General' }}</p>
        <p style="line-height: 1.8; white-space: pre-line;">{{ $message->message }}</p>
    </div>
@endsection
