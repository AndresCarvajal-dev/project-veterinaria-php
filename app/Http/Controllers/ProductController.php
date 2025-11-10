<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productos = Product::all();

          $query = Product::query();
      
        if ($request->filled('q')) {
            $query->where('nombre', 'like', '%' . $request->q . '%');
        }

        switch ($request->sort) {
            case 'precio_asc':
                $query->orderBy('precio', 'desc');
                break;
            case 'precio_desc':
                $query->orderBy('precio', 'asc');
                break;
            case 'stock_desc':
                $query->orderBy('stock', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        $productos = $query->paginate(5)->appends($request->query());

        return view('productos.home', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock'  => 'required|integer|min:0',
        ]);

        Product::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $producto = Product::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Product::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }


    public function show($id)
    {
      $producto = Product::findOrFail($id);
      return view('productos.show', compact('producto'));
    }

    public function showPdf(Product $producto)
    {
        if (class_exists(\Barryvdh\DomPDF\Facade::class) || class_exists('PDF')) {
            try {
                if (class_exists(\Barryvdh\DomPDF\Facade::class)) {
                    $pdf = \Barryvdh\DomPDF\Facade::loadView('productos.pdf', compact('producto'));
                } else {
                    $pdf = \PDF::loadView('productos.pdf', compact('producto'));
                }
                return $pdf->download('producto-' . $producto->id . '.pdf');
            } catch (\Exception $e) {
                return view('productos.pdf', compact('producto'));
            }
        }

        return view('productos.pdf', compact('producto'));
    }
}
