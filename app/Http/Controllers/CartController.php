<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $items = $this->cartItems($request);
        $favorites = $this->favoriteItems($request);
        $totals = $this->totalsFor($items);

        return view('cart.index', [
            'items' => $items,
            'favorites' => $favorites,
            'totals' => $totals,
        ]);
    }

    public function add(Request $request, Artwork $artwork)
    {
        if (! $artwork->isPurchasable()) {
            return back()->with('status', 'Esta obra requiere consulta privada o no esta disponible para compra directa.');
        }

        $cart = $request->session()->get('cart', []);
        $cart[$artwork->id] = 1;
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('status', 'Obra agregada al carrito.');
    }

    public function update(Request $request, Artwork $artwork)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:1'],
        ]);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$artwork->id])) {
            $cart[$artwork->id] = 1;
            $request->session()->put('cart', $cart);
        }

        return back()->with('status', 'Carrito actualizado.');
    }

    public function remove(Request $request, Artwork $artwork)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$artwork->id]);
        $request->session()->put('cart', $cart);

        return back()->with('status', 'Obra retirada del carrito.');
    }

    public function favorite(Request $request, Artwork $artwork)
    {
        $favorites = $request->session()->get('favorites', []);

        if (in_array($artwork->id, $favorites)) {
            $favorites = array_values(array_diff($favorites, [$artwork->id]));
            $message = 'Obra retirada de favoritos.';
        } else {
            $favorites[] = $artwork->id;
            $favorites = array_values(array_unique($favorites));
            $message = 'Obra guardada en favoritos.';
        }

        $request->session()->put('favorites', $favorites);

        return back()->with('status', $message);
    }

    public function checkout(Request $request)
    {
        if ($this->cartItems($request)->isEmpty()) {
            return back()->with('status', 'Agrega una obra antes de finalizar la compra.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:120'],
            'state' => ['required', 'string', 'max:120'],
            'postal_code' => ['required', 'string', 'max:20'],
            'delivery_method' => ['required', 'string', 'max:80'],
            'payment_method' => ['required', 'string', 'max:80'],
            'card_name' => ['required', 'string', 'max:255'],
            'card_number' => ['required', 'string', 'min:12', 'max:24'],
            'card_expiry' => ['required', 'string', 'max:10'],
            'card_cvv' => ['required', 'string', 'min:3', 'max:4'],
            'notes' => ['nullable', 'string'],
        ]);

        $request->session()->forget('cart');

        return redirect()
            ->route('cart.index')
            ->with('status', 'Orden simulada recibida. Folio: LUM-' . strtoupper(Str::random(6)));
    }

    private function cartItems(Request $request): Collection
    {
        $cart = $request->session()->get('cart', []);

        return Artwork::with('artist')
            ->whereIn('id', array_keys($cart))
            ->get()
            ->map(fn (Artwork $artwork) => [
                'artwork' => $artwork,
                'quantity' => 1,
                'amount' => $artwork->priceAmount(),
                'currency' => $artwork->priceCurrency(),
                'line_total' => $artwork->priceAmount(),
            ])
            ->filter(fn (array $item) => $item['amount'] !== null)
            ->values();
    }

    private function favoriteItems(Request $request): Collection
    {
        return Artwork::with('artist')
            ->whereIn('id', $request->session()->get('favorites', []))
            ->get();
    }

    private function totalsFor(Collection $items): array
    {
        return $items
            ->groupBy('currency')
            ->map(function (Collection $currencyItems, string $currency) {
                $subtotal = $currencyItems->sum('line_total');
                $shipping = $subtotal > 0 ? ($currency === 'MXN' ? 450 : 120) : 0;
                $tax = round($subtotal * 0.16, 2);

                return [
                    'subtotal' => $subtotal,
                    'shipping' => $shipping,
                    'tax' => $tax,
                    'total' => $subtotal + $shipping + $tax,
                ];
            })
            ->all();
    }
}
