<?php

namespace App\Http\Controllers;

use App\Models\PenasehatAkademik;
use App\Models\User;
use Illuminate\Http\Request;

class PenasehatAkademikController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data penasehat Akademik',
            'dosen' => User::where('role', 'dosen')->latest()->get(),
        ];
        return view('pages.penasehat_akademik.index', $data);
    }
    public function mahasiswa($id)
    {
        $user = User::find($id);
        $data = [
            'title' => 'Data Mahasiswa yang di dampingi oleh ' . $user->name . ' ' . $user->last_name,
            'mahasiswa' => PenasehatAkademik::where('id_dosen', $id)->get(),
            'dosen' => $user,
        ];
        return view('pages.penasehat_akademik.mahasiswa', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_dosen' => 'required',
            'id_mahasiswa' => 'required',
        ]);
        $penasehat_akademik = new PenasehatAkademik();
        $penasehat_akademik->id_dosen = $request->input('id_dosen');
        $penasehat_akademik->id_mahasiswa = $request->input('id_mahasiswa');

        if ($penasehat_akademik->save()) {
            return redirect()->back()->with('success', 'mahasiswa berhasil dibuat.');
        } else {
            return redirect()->back()->with('danger', 'mahasiswa gagal dibuat.');
        }
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'layanan' => 'required|string|max:255',
        // ]);
        // $layanan = Layanan::findOrFail($id);
        // $layanan->layanan = $request->input('layanan');

        // if ($layanan->save()) {
        //     return redirect()->back()->with('success', 'Layanan berhasil dibuat.');
        // } else {
        //     return redirect()->back()->with('danger', 'Layanan gagal dibuat.');
        // }
    }
    public function destroy($id)
    {
        $PenasehatAkademik = PenasehatAkademik::findOrFail($id);
        $PenasehatAkademik->delete();
        return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
