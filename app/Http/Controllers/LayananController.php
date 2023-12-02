<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Layanan',
            'layanan' => Layanan::all(),
        ];
        return view('pages.layanan.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'layanan' => 'required|string|max:255',
        ]);
        $layanan = new Layanan();
        $layanan->layanan = $request->input('layanan');

        if ($layanan->save()) {
            return redirect()->back()->with('success', 'Layanan berhasil dibuat.');
        } else {
            return redirect()->back()->with('danger', 'Layanan gagal dibuat.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'layanan' => 'required|string|max:255',
        ]);
        $layanan = Layanan::findOrFail($id);
        $layanan->layanan = $request->input('layanan');

        if ($layanan->save()) {
            return redirect()->back()->with('success', 'Layanan berhasil dibuat.');
        } else {
            return redirect()->back()->with('danger', 'Layanan gagal dibuat.');
        }
    }
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();
        return redirect()->back()->with('success', 'Layanan berhasil dihapus.');
    }
}
