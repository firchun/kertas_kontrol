<?php

namespace App\Http\Controllers;

use App\Models\BimbinganHambatan;
use App\Models\JenisHambatan;
use App\Models\Layanan;
use App\Models\Notifikasi;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            'layanan' => Layanan::all(),
            'hambatan' => JenisHambatan::all(),
        ];


        return view('pages.home', compact('widget'));
    }
    public function notifikasi()
    {
        $data = [
            'title' => 'Semua Notifikasi',
            'notifikasi' => Notifikasi::where('id_user', Auth::user()->id)->get(),
        ];
        return view('pages.notifikasi.notifikasi', $data);
    }
    // public function chart_hambatan($code)
    // {
    //     $semester = Semester::where('code', $code)->first() ?? null;
    //     $data = BimbinganHambatan::with(['hambatan', 'semester']);

    //     if ($semester) {
    //         $data = $data->where('id_semester', $semester->id)
    //             ->get();
    //         return json_decode($data);
    //     } else {
    //         return response()->json([
    //             'error' => 'No result'
    //         ]);
    //     }
    // }
    public function chart_hambatan($code)
    {
        $data = BimbinganHambatan::whereHas('semester', function ($query) use ($code) {
            $query->where('code', $code);
        })->get();

        // Proses data untuk grafik
        $hambatanCount = [];
        foreach ($data as $item) {
            $idHambatan = $item->hambatan->jenis_hambatan;
            if (isset($hambatanCount[$idHambatan])) {
                $hambatanCount[$idHambatan]++;
            } else {
                $hambatanCount[$idHambatan] = 1;
            }
        }

        // Persiapkan data untuk dikirim ke view
        $idHambatan = array_keys($hambatanCount);
        $countByHambatan = array_values($hambatanCount);

        return response()->json(['jenis_hambatan' => $idHambatan, 'jumlah' => $countByHambatan]);
    }
}
