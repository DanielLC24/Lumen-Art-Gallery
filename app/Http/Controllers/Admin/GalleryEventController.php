<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryEventController extends Controller
{
    public function index()
    {
        return view('admin.events.index', [
            'events' => GalleryEvent::latest('event_date')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.events.form', [
            'event' => new GalleryEvent(['event_date' => now(), 'is_published' => true]),
            'action' => route('admin.events.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request)
    {
        GalleryEvent::create($this->validatedData($request));

        return redirect()->route('admin.events.index')->with('status', 'Evento creado correctamente.');
    }

    public function edit(GalleryEvent $event)
    {
        return view('admin.events.form', [
            'event' => $event,
            'action' => route('admin.events.update', $event),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, GalleryEvent $event)
    {
        $event->update($this->validatedData($request, $event));

        return redirect()->route('admin.events.index')->with('status', 'Evento actualizado correctamente.');
    }

    public function destroy(GalleryEvent $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')->with('status', 'Evento eliminado correctamente.');
    }

    private function validatedData(Request $request, ?GalleryEvent $event = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'event_date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:255'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'description' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['is_published'] = $request->boolean('is_published');

        if (GalleryEvent::where('slug', $data['slug'])->when($event, fn ($query) => $query->where('id', '!=', $event->id))->exists()) {
            $data['slug'] .= '-' . Str::random(5);
        }

        return $data;
    }
}
