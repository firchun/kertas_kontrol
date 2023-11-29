<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Notifikasi;
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
}
