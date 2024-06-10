<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cupons = Cupon::all();
        return view('pages.dashboard.admin.basic_rules.cupon.index', compact('cupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.dashboard.admin.basic_rules.cupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'cupon_code' => 'required|unique:cupons',
            'discount_price' => 'required|string',
        ]);

        Cupon::create($request->all());

        return redirect()->route('cupons.index')->with('success', 'Cupon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cupon $cupon)
    {
        return view('pages.dashboard.admin.basic_rules.cupon.edit', compact('cupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'cupon_code' => 'required|string',
            'discount_price' => 'required|string',
        ]);

        $cupon = Cupon::findOrFail($id);

        $cupon->update($request->all());

        return redirect()->route('cupons.index')->with('success', 'Cupon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cupon = Cupon::findOrFail($id);
        $cupon->delete();

        return redirect()->route('cupons.index')->with('success', 'Cupon deleted successfully.');
    }
}
