<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerControllerTest extends TestCase
{
    // Rafraichir la base de données à chaque test
    use RefreshDatabase;

    /**
     * @test
     */
    public function itListsCustomers()
    {
        $this->seed();
        $response = $this->get('/api/customers');

        $response->assertOk();
        $this->assertCount(15, $response->json('data'));
        $this->assertNotNull($response->json('data')[0]['tel']);
    }

    /**
     * @test
     */
    public function itCreatesCustomer()
    {
        // On attaque en post l'url en passant des données
        $response = $this->post('/api/customers', [
            'name' => 'Mon premier client',
            'tel' => '06XXXXXX',
            'is_favourite' => true
        ]);
        // On récupère tous les customers
        $customers = Customer::all();
        // On récupère le dernier customer
        $customer = Customer::first();
        // On vérifie si le status code de retour de la requete est 201
        $response->assertStatus(201);
        $this->assertEquals(1, $customers->count());
        $this->assertEquals('Mon premier client', $customer->name);
    }

    /**
     * @test
     */
    public function itValidatesFields()
    {
        $response = $this->post('/api/customers', [
            'name' => '',
            'tel' => '',
            'is_favourite' => ''
        ]);

        $response->assertSessionHasErrors(['name', 'tel']);
    }

    /**
     * @test
     */
    public function itUpdatesCustomer()
    {
        $this->seed();
        $customer = Customer::first();

        $response = $this->put('/api/customers/' . $customer->id, [
            'name' => 'Nom Édité',
            'tel' => '06xxx',
            'is_favourite' => true
        ]);

        $updatedCustomer = Customer::find($customer->id);

        $response->assertOk();
        $this->assertEquals('Nom Édité', $updatedCustomer->name);
    }

    /**
     * @test
     */
    public function itDeletesACustomer()
    {
        $this->seed();
        $customer = Customer::first();

        $response = $this->delete('/api/customers/' . $customer->id);
        $response->assertNoContent();

        $this->assertEquals(14, Customer::count());
    }
}
