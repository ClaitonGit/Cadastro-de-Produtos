<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase; // Para garantir que o banco de dados seja limpo entre os testes

    /**
     * Teste para exibir um único produto.
     *
     * @return void
     */
    public function test_show_product()
    {
        // Crie um produto fictício no banco de dados
        $product = Product::create([
            'name' => 'Playstation 5',
            'description' => 'Reproduza jogos do PS5 e do PS4 em Blu-ray Disc. Você também pode baixar jogos do PS5 e do PS4 digitais a partir da PlayStation Store.',
            'price' => 3550,
            'quantity' => 100,
            'active' => true,
        ]);

        // Faça a requisição para a rota que exibe o produto
        $response = $this->getJson("/api/products/{$product->id}");

        // Verifique se a resposta tem o status 200 (OK)
        $response->assertStatus(Response::HTTP_OK);

        // Verifique se a resposta tem a estrutura correta e os dados esperados
        $response->assertJson([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'active' => $product->active,
        ]);
    }
}
