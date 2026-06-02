<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtworkController extends Controller
{
    public function index()
    {
        return view('admin.artworks.index', [
            'artworks' => Artwork::with('artist')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.artworks.form', [
            'artwork' => new Artwork(['is_featured' => true]),
            'artists' => Artist::orderBy('name')->get(),
            'action' => route('admin.artworks.store'),
            'method' => 'POST',
        ]);
    }

    public function store(Request $request)
    {
        Artwork::create($this->validatedData($request));

        return redirect()->route('admin.artworks.index')->with('status', 'Obra creada correctamente.');
    }

    public function edit(Artwork $artwork)
    {
        return view('admin.artworks.form', [
            'artwork' => $artwork,
            'artists' => Artist::orderBy('name')->get(),
            'action' => route('admin.artworks.update', $artwork),
            'method' => 'PUT',
        ]);
    }

    public function update(Request $request, Artwork $artwork)
    {
        $artwork->update($this->validatedData($request, $artwork));

        return redirect()->route('admin.artworks.index')->with('status', 'Obra actualizada correctamente.');
    }

    public function destroy(Artwork $artwork)
    {
        $artwork->delete();

        return redirect()->route('admin.artworks.index')->with('status', 'Obra eliminada correctamente.');
    }

    private function validatedData(Request $request, ?Artwork $artwork = null): array
    {
        $data = $request->validate([
            'artist_id' => ['required', 'exists:artists,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:60'],
            'technique' => ['nullable', 'string', 'max:255'],
            'dimensions' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'string', 'max:40'],
            'availability' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'source_url' => ['nullable', 'url', 'max:500'],
            'description' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['is_featured'] = $request->boolean('is_featured');

        if (Artwork::where('slug', $data['slug'])->when($artwork, fn ($query) => $query->where('id', '!=', $artwork->id))->exists()) {
            $data['slug'] .= '-' . Str::random(5);
        }

        return $data;
    }
}
