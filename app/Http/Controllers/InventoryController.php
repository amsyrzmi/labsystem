<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryMaterial;
use App\Models\InventoryApparatus;
use App\Models\InventoryTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InventoryController extends Controller
{
    public function index()
    {
        $lowStockMaterials = InventoryMaterial::whereColumn('quantity', '<=', 'minimum_quantity')->count();
        $lowStockApparatus = InventoryApparatus::whereColumn('available_quantity', '<=', 'minimum_quantity')->count();
        
        $totalMaterials = InventoryMaterial::count();
        $totalApparatus = InventoryApparatus::count();
        
        $recentTransactions = InventoryTransaction::with('labRequest')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        
        return view('Labassistant.inventory.index', compact(
            'lowStockMaterials',
            'lowStockApparatus',
            'totalMaterials',
            'totalApparatus',
            'recentTransactions'
        ));
    }

    public function materials(Request $request)
    {
        $query = InventoryMaterial::query();
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('low_stock') && $request->low_stock) {
            $query->whereColumn('quantity', '<=', 'minimum_quantity');
        }
        
        $materials = $query->orderBy('name')->paginate(15);
        
        return view('Labassistant.inventory.materials', compact('materials'));
    }

    public function storeMaterial(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'concentration' => 'nullable|numeric|min:0',
            'minimum_quantity' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        
        InventoryMaterial::create($validated);
        
        return redirect()->back()->with('success', 'Material added successfully');
    }

    public function updateMaterial(Request $request, $id)
    {
        $material = InventoryMaterial::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'concentration' => 'nullable|numeric|min:0',
            'minimum_quantity' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        
        $material->update($validated);
        
        return redirect()->back()->with('success', 'Material updated successfully');
    }

    public function apparatus(Request $request)
    {
        $query = InventoryApparatus::query();
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('low_stock') && $request->low_stock) {
            $query->whereColumn('available_quantity', '<=', 'minimum_quantity');
        }
        
        $apparatus = $query->orderBy('name')->paginate(15);
        
        return view('Labassistant.inventory.apparatus', compact('apparatus'));
    }

    public function storeApparatus(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'total_quantity' => 'required|integer|min:0',
            'minimum_quantity' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);
        
        $validated['available_quantity'] = $validated['total_quantity'];
        
        InventoryApparatus::create($validated);
        
        return redirect()->back()->with('success', 'Apparatus added successfully');
    }

    public function updateApparatus(Request $request, $id)
    {
        $apparatus = InventoryApparatus::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'total_quantity' => 'required|integer|min:0',
            'minimum_quantity' => 'required|integer|min:0',
            'notes' => 'nullable|string',
        ]);
        
        // Adjust available quantity if total changes
        $difference = $validated['total_quantity'] - $apparatus->total_quantity;
        $validated['available_quantity'] = $apparatus->available_quantity + $difference;
        
        $apparatus->update($validated);
        
        return redirect()->back()->with('success', 'Apparatus updated successfully');
    }

    public function transactions()
    {
        $transactions = InventoryTransaction::with('labRequest')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('Labassistant.inventory.transactions', compact('transactions'));
    }
}