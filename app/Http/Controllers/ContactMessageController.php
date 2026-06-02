<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:160'],
            'interest' => ['nullable', 'string', 'max:80'],
            'preferred_contact' => ['nullable', 'string', 'max:40'],
            'message' => ['required', 'string', 'min:10', 'max:2500'],
            'privacy' => ['accepted'],
        ]);

        unset($validated['privacy']);

        ContactMessage::create($validated + [
            'status' => 'nuevo',
            'source' => 'web',
        ]);

        return redirect('/#contacto')->with('contact_status', 'Gracias. Recibimos tu mensaje y te contactaremos pronto.');
    }
}
