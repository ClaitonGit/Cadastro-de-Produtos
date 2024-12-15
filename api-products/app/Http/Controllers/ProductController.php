<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Listar todos os produtos
    public function index()
    {
        $products = Product::all(); // Obtém todos os produtos
        return response()->json($products); 
    }

    // Exibir um único produto
    public function show($id)
    {
        $product = Product::find($id); // Encontra o produto pelo ID

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404); 
        }

        return response()->json($product);
    }

    // Criar um novo produto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'active' => 'required|boolean',
        ]);

        $product = Product::create($validated); // Cria o novo produto com os dados validados
        return response()->json($product, 201); // Retorna o produto criado
    }

    // Atualizar um produto existente
    public function update(Request $request, $id)
    {
        $product = Product::find($id); // Encontra o produto pelo ID

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404); 
        }

        $validated = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string|max:1000',
            'price' => 'numeric|min:0',
            'quantity' => 'integer|min:1',
            'active' => 'boolean',
        ]);

        $product->update($validated); // Atualiza o produto com os dados validados
        return response()->json($product); // Retorna o produto atualizado
    }

    // Excluir um produto
    public function destroy($id)
    {
        $product = Product::find($id); 

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404); 
        }

        $product->delete(); // Exclui o produto
        return response()->json(['message' => 'Produto excluído com sucesso']);
    }
}
