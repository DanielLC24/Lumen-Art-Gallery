<?php

namespace Tests\Feature;

use App\Models\Artwork;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_artwork_detail_page_returns_curatorial_data(): void
    {
        $response = $this->get('/obras/fuego');

        $response
            ->assertStatus(200)
            ->assertSee('Fuego')
            ->assertSee('David Alfaro Siqueiros')
            ->assertSee('Piroxilina sobre plastico y tela')
            ->assertSee('49 x 61.5 cm');
    }

    public function test_admin_pages_return_successful_responses(): void
    {
        $this->withSession(['admin_authenticated' => true]);

        $this->get('/admin')->assertStatus(200)->assertSee('Lumen Admin');
        $this->get('/admin/artworks')->assertStatus(200)->assertSee('Obras');
        $this->get('/admin/artists')->assertStatus(200)->assertSee('Artistas');
        $this->get('/admin/events')->assertStatus(200)->assertSee('Eventos');
        $this->get('/admin/messages')->assertStatus(200)->assertSee('Mensajes');
    }

    public function test_admin_requires_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/login')->assertStatus(200)->assertSee('Acceso privado');
    }

    public function test_admin_accepts_configured_credentials(): void
    {
        $this->post('/admin/login', [
            'username' => 'admin',
            'password' => '12345',
        ])->assertRedirect('/admin');

        $this->assertTrue(session('admin_authenticated'));
    }

    public function test_admin_rejects_invalid_credentials(): void
    {
        $this->post('/admin/login', [
            'username' => 'admin',
            'password' => 'incorrecta',
        ])->assertSessionHasErrors('username');

        $this->assertFalse((bool) session('admin_authenticated'));
    }

    public function test_cart_page_and_add_artwork_flow(): void
    {
        $artwork = Artwork::where('slug', 'renacimiento')->firstOrFail();

        $this->get('/carrito')
            ->assertStatus(200)
            ->assertSee('Carrito de arte');

        $this->post(route('cart.add', $artwork))
            ->assertRedirect(route('cart.index'))
            ->assertSessionHas('cart.' . $artwork->id, 1);

        $this->withSession(['cart' => [$artwork->id => 1]])
            ->get('/carrito')
            ->assertStatus(200)
            ->assertSee('Renacimiento')
            ->assertSee('USD 2,762.00');
    }

    public function test_contact_form_stores_messages(): void
    {
        $this->post(route('contact.store'), [
            'full_name' => 'Daniel Hernandez',
            'email' => 'daniel@example.com',
            'phone' => '5512345678',
            'preferred_contact' => 'WhatsApp',
            'interest' => 'Agendar visita privada',
            'subject' => 'Visita a la galeria',
            'message' => 'Me gustaria agendar una visita privada para conocer obras disponibles.',
            'privacy' => '1',
        ])
            ->assertRedirect('/#contacto')
            ->assertSessionHas('contact_status');

        $this->assertDatabaseHas('contact_messages', [
            'full_name' => 'Daniel Hernandez',
            'email' => 'daniel@example.com',
            'status' => 'nuevo',
        ]);
    }

    public function test_admin_can_read_contact_message(): void
    {
        $message = ContactMessage::create([
            'full_name' => 'Mariana Torres',
            'email' => 'mariana@example.com',
            'phone' => '5587654321',
            'preferred_contact' => 'Correo',
            'interest' => 'Comprar una obra',
            'subject' => 'Consulta de compra',
            'message' => 'Estoy interesada en recibir informacion sobre una pieza de la coleccion.',
        ]);

        $this->withSession(['admin_authenticated' => true])
            ->get(route('admin.messages.show', $message))
            ->assertStatus(200)
            ->assertSee('Mariana Torres')
            ->assertSee('Consulta de compra');
    }
}
