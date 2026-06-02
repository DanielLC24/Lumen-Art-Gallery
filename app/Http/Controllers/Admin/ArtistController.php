<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    public function index()
    {
        return view('admin.artists.index', [
            'artists' => Artist::withCount('artworks')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.artists.form', [
            'artist' => new Artist(),
            'action' => route('admin.artists.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request)
    {
        Artist::create($this->validatedData($request));

        return redirect()->route('admin.artists.index')->with('status', 'Artista creado correctamente.');
    }

    public function edit(Artist $artist)
    {
        return view('admin.artists.form', [
            'artist' => $artist,
            'action' => route('admin.artists.update', $artist),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Artist $artist)
    {
        $artist->update($this->validatedData($request, $artist));

        return redirect()->route('admin.artists.index')->with('status', 'Artista actualizado correctamente.');
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('admin.artists.index')->with('status', 'Artista eliminado correctamente.');
    }

    private function validatedData(Request $request, ?Artist $artist = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'specialty' => ['nullable', 'string', 'max:255'],
            'photo_url' => ['nullable', 'url', 'max:500'],
            'bio' => ['nullable', 'string'],
            'featured_works' => ['nullable', 'string', 'max:255'],
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);

        if (Artist::where('slug', $data['slug'])->when($artist, fn ($query) => $query->where('id', '!=', $artist->id))->exists()) {
            $data['slug'] .= '-' . Str::random(5);
        }

        return $data;
    }
}
