<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Traits\Loggable;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier = Supplier::create($data);

        Loggable::recordActivity(
            'supplier_created',
            $supplier,
            'Supplier "' . $supplier->name . '" was created'
        );

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Fournisseur créé avec succès');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier->update($data);

        Loggable::recordActivity(
            'supplier_updated',
            $supplier,
            'Supplier "' . $supplier->name . '" was updated'
        );

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Fournisseur modifié avec succès');
    }

    public function destroy(Supplier $supplier)
    {
        Loggable::recordActivity(
            'supplier_deleted',
            $supplier,
            'Supplier "' . $supplier->name . '" was deleted'
        );

        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Fournisseur supprimé avec succès');
    }
}