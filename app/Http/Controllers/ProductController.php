<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function createProducts($products)
    {
        foreach ($products as $product) {
            // Busca el producto por código
            $existingProduct = Product::where('code', $product['code'])
                ->where('company_id', $product['company_id'])
                ->first();

            if ($existingProduct) {
                // Actualiza el producto existente
                $existingProduct->update([
                    'name' => $product['name'],
                    'base_price_1' => $product['base_price_1'],
                    'base_price_2' => $product['base_price_2'],
                    'base_price_3' => $product['base_price_3'],
                    'tax_rate' => $product['tax_rate'],
                    'company_id' => $product['company_id'],
                    'updated_at' => now(),
                ]);
            } else {
                // Crea un nuevo producto
                Product::create([
                    'name' => $product['name'],
                    'code' => $product['code'],
                    'base_price_1' => $product['base_price_1'],
                    'base_price_2' => $product['base_price_2'],
                    'base_price_3' => $product['base_price_3'],
                    'tax_rate' => $product['tax_rate'],
                    'company_id' => $product['company_id'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function getProducts()
    {   
        $user = Auth::user();
        $products = Product::all()->where('company_id', $user->company_id);
        return response()->json($products);
    }

    public function store(Request $request)
    {
        try {
            // Valida la entrada
            $request->validate([
                'products' => 'required|array',
                'products.*.name' => 'required|string|max:255',
                'products.*.code' => 'required|string',
                'products.*.base_price_1' => 'required|numeric',
                'products.*.tax_rate' => 'required|numeric',
                'products.*.company_id' => 'required|integer|exists:companies,id',
            ]);

            $products = $request->input('products');
            $this->createProducts($products);

            return response()->json(['status' => true, 'message' => 'Productos creados o actualizados exitosamente.']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function searchProducts(Request $request)
    {
        $query = $request->input('query');
        $user = Auth::user();

        $products = Product::where('company_id', $user->company_id) // Filtrar por la empresa del usuario
            ->where(function ($q) use ($query) { // Agrupar condiciones de búsqueda
                $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('code', 'LIKE', "%{$query}%");
            })
            ->get();

        return response()->json($products);
    }
}
