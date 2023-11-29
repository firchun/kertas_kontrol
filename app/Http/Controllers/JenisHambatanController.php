<?php

namespace App\Http\Controllers;

use App\Models\JenisHambatan;
use Illuminate\Http\Request;

class JenisHambatanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Jenis Hambatan',
            'jenis_hambatan' => JenisHambatan::latest()->get(),
        ];
        return view('pages.jenis_hambatan.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'jenis_hambatan' => 'required|string|max:255',
        ]);
        $jenis_hambatan = new JenisHambatan();
        $jenis_hambatan->jenis_hambatan = $request->input('jenis_hambatan');

        if ($jenis_hambatan->save()) {
            return redirect()->back()->with('success', 'Jenis Hambatan berhasil dibuat.');
        } else {
            return redirect()->back()->with('danger', 'Jenis Hambatan gagal dibuat.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_hambatan' => 'required|string|max:255',
        ]);
        $jenis_hambatan = JenisHambatan::findOrFail($id);
        $jenis_hambatan->jenis_hambatan = $request->input('jenis_hambatan');

        if ($jenis_hambatan->save()) {
            return redirect()->back()->with('success', 'Jenis Hambatan berhasil dibuat.');
        } else {
            return redirect()->back()->with('danger', 'Jenis Hambatan gagal dibuat.');
        }
    }
    public function destroy($id)
    {
        $jenis_hambatan = JenisHambatan::findOrFail($id);
        $jenis_hambatan->delete();
        return redirect()->back()->with('success', 'Jenis Hambatan berhasil dihapus.');
    }
}
