<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Artwork;
use App\Models\ContactMessage;
use App\Models\GalleryEvent;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'artistCount' => Artist::count(),
            'artworkCount' => Artwork::count(),
            'eventCount' => GalleryEvent::count(),
            'newMessageCount' => ContactMessage::where('status', 'nuevo')->count(),
            'latestArtworks' => Artwork::with('artist')->latest()->take(5)->get(),
        ]);
    }
}
