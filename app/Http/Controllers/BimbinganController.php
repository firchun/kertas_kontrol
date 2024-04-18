<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\BimbinganAnsware;
use App\Models\BimbinganHambatan;
use App\Models\BimbinganHasil;
use App\Models\Layanan;
use App\Models\Notifikasi;
use App\Models\PenasehatAkademik;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;

class BimbinganController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Layanan Bimbingan',
            'layanan' => Layanan::all(),
        ];
        return view('pages.bimbingan.index', $data);
    }
    public function riwayat()
    {
        $data = [
            'title' => 'Riwayat Bimbingan',
            'semester' => Semester::latest()->get(),
        ];
        return view('pages.bimbingan.riwayat.index', $data);
    }
    public function show($id)
    {
        $bimbingan = Bimbingan::find($id);
        // $bimbingan_answare = BimbinganAnsware::where('id_bimbingan', $bimbingan->id)->get();
        $hambatan = BimbinganHambatan::where('id_bimbingan', $bimbingan->id)->get();
        $layanan = Layanan::find($bimbingan->id_layanan);
        $dosen_pa = PenasehatAkademik::where('id_mahasiswa', $bimbingan->id_user)->first();
        $data = [
            'title' => 'Layanan Bimbingan : ' . $layanan->layanan,
            'bimbingan' => $bimbingan,
            'layanan' => $layanan,
            'hambatan' => $hambatan,
            'dosen_pa' => $dosen_pa,
        ];
        return view('pages.bimbingan.show', $data);
    }
    public function mahasiswa($id)
    {
        $layanan = Layanan::find($id);
        if (Auth::user()->role != 'dosen') {
            $mahasiswa = User::where('role', 'mahasiswa')->get();
        } else {
            $mahasiswa = PenasehatAkademik::where('id_dosen', Auth::user()->id)->get();
        }
        $data = [
            'title' => 'Layanan Bimbingan : ' . $layanan->layanan,
            'layanan' => $layanan,
            'mahasiswa' => $mahasiswa,
        ];
        return view('pages.bimbingan.dosen.mahasiswa', $data);
    }
    public function riwayat_mahasiswa($code)
    {
        $semester = Semester::where('code', $code)->first();
        if (Auth::user()->role != 'dosen') {
            $mahasiswa = User::where('role', 'mahasiswa')->get();
        } else {
            $mahasiswa = PenasehatAkademik::where('id_dosen', Auth::user()->id)->get();
        }
        $data = [
            'title' => 'Riwayat Mahasiswa Semester : ' . $code,
            'semester' => $semester,
            'mahasiswa' => $mahasiswa,
        ];
        return view('pages.bimbingan.riwayat.mahasiswa', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_hambatan' => 'required|array',
            'isi' => 'required|string',
            'id_mahasiswa' => 'required',
        ]);

        $bimbingan = new Bimbingan();
        $bimbingan->isi = $request->isi;
        $bimbingan->id_layanan = $request->id_layanan;
        $bimbingan->id_semester = $request->id_semester;
        $bimbingan->id_user = $request->id_mahasiswa;
        if ($bimbingan->save()) {
            foreach ($request->id_hambatan as $jenisHambatanId) {
                $bimbinganHambatan = new BimbinganHambatan();
                $bimbinganHambatan->id_bimbingan = $bimbingan->id;
                $bimbinganHambatan->id_hambatan = $jenisHambatanId;
                $bimbinganHambatan->id_semester = $request->id_semester;
                $bimbinganHambatan->save();
            }

            if (Auth::user()->role == 'mahasiswa') {

                //create ntifikasi
                $mahasiswa = User::find($request->id_mahasiswa);
                $dosen_pa = PenasehatAkademik::where('id_mahasiswa', $request->id_mahasiswa)->first();

                // dd($dosen_pa);
                $layanan = Layanan::find($request->id_layanan);

                $notifikasi = new Notifikasi();
                $notifikasi->id_user = $dosen_pa->id_dosen;
                $notifikasi->type = 'primary';
                $notifikasi->message = 'Pengajuan bimbingan ' . $layanan->jenis_layanan . ', Mahasiswa AN. ' . $mahasiswa->name . ' telah mengajukan bimbingan';
                $notifikasi->url = '/bimbingan';
                $notifikasi->save();
            } else {
                //create ntifikasi
                $mahasiswa = User::find($request->id_mahasiswa);
                $dosen_pa = PenasehatAkademik::where('id_mahasiswa', $request->id_mahasiswa)->first();

                // dd($dosen_pa);
                $layanan = Layanan::find($request->id_layanan);

                $notifikasi = new Notifikasi();
                $notifikasi->id_user = $request->id_mahasiswa;
                $notifikasi->type = 'success';
                $notifikasi->message = 'Pembuatan bimbingan ' . $layanan->jenis_layanan . ', bimbingan anda telah dibuatkan oleh dosen PA';
                $notifikasi->url = '/bimbingan';
                $notifikasi->save();
            }

            return redirect()->back()->with('success', 'Berhasil membuat bimbingan');
        } else {
            return redirect()->back()->with('danger', 'Gagal membuat bimbingan');
        }
    }
    public function store_hasil(Request $request)
    {
        // dd($request->all());
        // Validasi input
        $request->validate([
            'id_bimbingan' => 'required|exists:bimbingans,id',
            'judul' => 'required|array',
            'isi' => 'required|array',
            'no' => 'required|array',
        ]);


        try {
            // Simpan data hasil bimbingan
            foreach ($request->input('no') as $index => $no) {
                $hasilBimbingan = new BimbinganHasil();
                $hasilBimbingan->id_bimbingan = $request->input('id_bimbingan');
                $hasilBimbingan->judul = $request->input('judul')[$index];
                $hasilBimbingan->isi = $request->input('isi')[$index];
                $hasilBimbingan->save();
            }

            //create ntifikasi
            $bimbingan = Bimbingan::find($request->id_bimbingan);

            $notifikasi = new Notifikasi();
            $notifikasi->id_user = $bimbingan->id_user;
            $notifikasi->type = 'success';
            $notifikasi->message = 'Hasil bimbingan, Dosen PA anda telah memberikan hasil bimbingan';
            $notifikasi->url = '/bimbingan';
            $notifikasi->save();


            // Redirect atau berikan respons sesuai kebutuhan
            return redirect()->back()->with('success', 'Data hasil bimbingan berhasil disimpan.');
        } catch (\Exception $e) {

            // Redirect atau berikan respons sesuai kebutuhan
            return redirect()->back()->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function print(Request $request)
    {
        $id_semester = $request->id_semester;
        $id_mahasiswa = $request->id_mahasiswa;

        // dd($id_mahasiswa, $id_semester);
        $layanan = Layanan::all();

        $bimbingan = Bimbingan::where('id_user', $id_mahasiswa)
            ->where('id_semester', $id_semester)
            ->get();

        //cek hasil
        $jumlah_bimbingan = 0;

        foreach ($bimbingan as $bimbinganItem) {
            $id_bimbingan = $bimbinganItem->id;

            $hasilBimbinganGrouped = BimbinganHasil::where('id_bimbingan', $id_bimbingan)->get()->groupBy('id_bimbingan');

            $jumlah_bimbingan += $hasilBimbinganGrouped->count();
        }

        // Output jumlah hasil_bimbingan
        // dd($jumlah_bimbingan);

        if ($bimbingan->isEmpty()) {
            return redirect()->back()->with('danger', 'Belum ada data bimbingan');
        }
        // elseif ($jumlah_bimbingan < $layanan->count()) {
        //     return redirect()->back()->with('danger', 'Data Hasil bimbingan belum lengkap');
        // }

        $dosen_pa = PenasehatAkademik::where('id_mahasiswa', $id_mahasiswa)->first();
        $mahasiswa = User::find($id_mahasiswa);
        $semester = Semester::find($id_semester);
        // dd($id_mahasiswa);

        try {
            $angkatan = intval(substr($mahasiswa->npm ?? 0, 0, 4));
            $tahun = intval(date('Y'));
            $semester_mahasiswa = ($tahun - $angkatan) * 2  + ($semester->semester == 'ganjil' ? 1 : 0);
        } catch (Exception $e) {
            $semester_mahasiswa = 0;
        }
        $pdf =  \PDF::loadView('pages.bimbingan.riwayat.print', [
            'data' => $bimbingan,
            'semester' => $semester,
            'layanan' => $layanan,
            'mahasiswa' => $mahasiswa,
            'dosen_pa' => $dosen_pa,
            'semester_mahasiswa' => $semester_mahasiswa,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Riwayat Bimbingan Semester ' . $semester->code . '.pdf');
    }
    public function preview(Request $request)
    {
        $id_semester = $request->id_semester;
        $id_mahasiswa = $request->id_mahasiswa;

        // dd($id_mahasiswa, $id_semester);
        $layanan = Layanan::all();

        $bimbingan = Bimbingan::where('id_user', $id_mahasiswa)
            ->where('id_semester', $id_semester)
            ->get();

        //cek hasil
        $jumlah_bimbingan = 0;

        foreach ($bimbingan as $bimbinganItem) {
            $id_bimbingan = $bimbinganItem->id;

            $hasilBimbinganGrouped = BimbinganHasil::where('id_bimbingan', $id_bimbingan)->get()->groupBy('id_bimbingan');

            $jumlah_bimbingan += $hasilBimbinganGrouped->count();
        }

        // Output jumlah hasil_bimbingan
        // dd($jumlah_bimbingan);

        if ($bimbingan->isEmpty()) {
            return redirect()->back()->with('danger', 'Belum ada data bimbingan');
        }
        // elseif ($jumlah_bimbingan < $layanan->count()) {
        //     return redirect()->back()->with('danger', 'Data Hasil bimbingan belum lengkap');
        // }

        $dosen_pa = PenasehatAkademik::where('id_mahasiswa', $id_mahasiswa)->first();
        $mahasiswa = User::find($id_mahasiswa);
        $semester = Semester::find($id_semester);
        // dd($id_mahasiswa);

        try {
            $angkatan = intval(substr($mahasiswa->npm ?? 0, 0, 4));
            $tahun = intval(date('Y'));
            $semester_mahasiswa = ($tahun - $angkatan) * 2  + ($semester->semester == 'ganjil' ? 1 : 0);
        } catch (Exception $e) {
            $semester_mahasiswa = 0;
        }
        $data =  [
            'title' => 'data bimbingan ' . $semester->code . ': ' . $mahasiswa->name,
            'data' => $bimbingan,
            'semester' => $semester,
            'layanan' => $layanan,
            'mahasiswa' => $mahasiswa,
            'dosen_pa' => $dosen_pa,
            'semester_mahasiswa' => $semester_mahasiswa,
        ];

        return view('pages.bimbingan.riwayat.preview', $data);
    }

    public function chart_hambatan()
    {
    }
}
