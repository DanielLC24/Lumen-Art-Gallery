<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        return view('admin.messages.index', [
            'messages' => ContactMessage::latest()->paginate(12),
            'newCount' => ContactMessage::where('status', 'nuevo')->count(),
        ]);
    }

    public function show(ContactMessage $message): View
    {
        if (! $message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return view('admin.messages.show', [
            'message' => $message->fresh(),
            'statuses' => ['nuevo', 'en seguimiento', 'respondido', 'cerrado'],
        ]);
    }

    public function update(Request $request, ContactMessage $message): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:nuevo,en seguimiento,respondido,cerrado'],
        ]);

        $message->update($validated);

        return redirect()->route('admin.messages.show', $message)->with('status', 'Estado del mensaje actualizado.');
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('status', 'Mensaje eliminado correctamente.');
    }
}
