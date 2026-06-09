<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

class InventoryController extends Controller
{
    public function create_inventory()
    {
        return view('create_inventory');
    }
    public function store_inventory(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'merk' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'keadaan' => 'required',
            'keterangan' => 'required'
        ]);
        Inventory::create([
            'nama' => $request->nama,
            'merk' => $request->merk,
            'tahun' => $request->tahun,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'keadaan' => $request->keadaan,
            'keterangan' => $request->keterangan

        ]);

        return Redirect::route('show_inventory');
    }

    public function show_inventory(Request $request, Inventory $inventory)
    {
        $query = Inventory::query();

        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        $inventories = $query->get();

        return view('show_inventory', compact('inventories'));
    }

    public function edit_inventory(Inventory $inventory)
    {
        return view('edit_inventory', compact('inventory'));
    }

    public function update_inventory(Inventory $inventory, Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'merk' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'keadaan' => 'required',
            'keterangan' => 'required'
        ]);

        $inventory->update([
            'nama' => $request->nama,
            'merk' => $request->merk,
            'tahun' => $request->tahun,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'keadaan' => $request->keadaan,
            'keterangan' => $request->keterangan
        ]);

        return Redirect::route('show_inventory', $inventory);
    }

    public function delete_inventory(Inventory $inventory)
    {
        $inventory->delete();
        return Redirect::route('show_inventory');
    }

  public function cetak_inventory(Request $request)
{
    $pdf = PDF::loadHTML('<h1>Test PDF</h1>');
return $pdf->stream();
}
}
