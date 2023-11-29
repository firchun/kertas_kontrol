<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\LayananPeriode;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Semester',
            'semester' => Semester::latest()->get(),
        ];
        return view('pages.semester.index', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'semester' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
        ]);

        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Memeriksa apakah tanggal awal lebih kecil dari tanggal akhir
        foreach ($tanggalAwal as $key => $value) {
            if (strtotime($value) >= strtotime($tanggalAkhir[$key])) {
                return redirect()->back()->with('danger', 'Tanggal awal harus lebih kecil dari tanggal akhir.');
            }
        }

        $code = $request->input('tahun') . ($request->input('semester') == 'ganjil' ? 1 : 2);
        $Semester_check = Semester::where('code', $code)->count();

        if ($Semester_check == 0) {
            $Semester = new Semester();
            $Semester->semester = $request->input('semester');
            $Semester->tahun = $request->input('tahun');
            $Semester->code =  $request->input('tahun') . ($request->input('semester') == 'ganjil' ? 1 : 2);

            if ($Semester->save()) {
                $layananIds = $request->input('id_layanan');

                foreach ($layananIds as $key => $layananId) {
                    $layanan = new LayananPeriode();
                    $layanan->id_semester = $Semester->id;
                    $layanan->id_layanan = $layananId;
                    $layanan->tanggal_awal = $tanggalAwal[$key];
                    $layanan->tanggal_akhir = $tanggalAkhir[$key];
                    $layanan->save();
                }

                return redirect()->back()->with('success', 'Data berhasil disimpan.');
            } else {
                return redirect()->back()->with('danger', 'Semester gagal dibuat.');
            }
        } else {
            return redirect()->back()->with('danger', 'Semester sudah ada.');
        }
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'semester' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
        ]);

        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Memeriksa apakah tanggal awal lebih kecil dari tanggal akhir
        foreach ($tanggalAwal as $key => $value) {
            if (strtotime($value) >= strtotime($tanggalAkhir[$key])) {
                return redirect()->back()->with('danger', 'Tanggal awal harus lebih kecil dari tanggal akhir.');
            }
        }

        $code = $request->input('tahun') . ($request->input('semester') == 'ganjil' ? 1 : 2);
        $Semester_check = Semester::where('code', $code)->where('id', '!=', $id)->count();

        if ($Semester_check == 0) {
            $Semester = Semester::findOrFail($id);
            $Semester->semester = $request->input('semester');
            $Semester->tahun = $request->input('tahun');
            $Semester->code =  $request->input('tahun') . ($request->input('semester') == 'ganjil' ? 1 : 2);

            if ($Semester->save()) {
                $layananIds = $request->input('id_layanan');

                // Hapus layanan yang terkait dengan semester sebelumnya
                LayananPeriode::where('id_semester', $id)->delete();

                foreach ($layananIds as $key => $layananId) {
                    $layanan = new LayananPeriode();
                    $layanan->id_semester = $id; // Menggunakan ID semester yang sama
                    $layanan->id_layanan = $layananId;
                    $layanan->tanggal_awal = $tanggalAwal[$key];
                    $layanan->tanggal_akhir = $tanggalAkhir[$key];
                    $layanan->save();
                }

                return redirect()->back()->with('success', 'Data berhasil diperbarui.');
            } else {
                return redirect()->back()->with('danger', 'Semester gagal diperbarui.');
            }
        } else {
            return redirect()->back()->with('danger', 'Semester dengan kode tersebut sudah ada.');
        }
    }

    public function destroy($id)
    {
        try {
            $periode = LayananPeriode::where('id_semester', $id);
            if ($periode) {
                $periode->delete();
            }

            $Semester = Semester::findOrFail($id);
            $Semester->delete();
            return redirect()->back()->with('success', 'Semester berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
