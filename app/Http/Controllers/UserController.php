<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function admin()
    {
        $data = [
            'title' => 'Akun Admin',
            'users' => User::where('role', 'admin')->get()
        ];
        return view('pages.users.admin', $data);
    }
    public function dosen()
    {
        $data = [
            'title' => 'Akun Dosen',
            'users' => User::where('role', 'dosen')->get()
        ];
        return view('pages.users.dosen', $data);
    }
    public function mahasiswa()
    {
        $data = [
            'title' => 'Akun Mahasiswa',
            'users' => User::where('role', 'mahasiswa')->get()
        ];
        return view('pages.users.mahasiswa', $data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',

        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->nip = $request->input('nip');
        $user->npm = $request->input('npm');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');

        if ($user->save()) {
            return redirect()->back()->with('success', 'Akun ' . $request->input('role') . ' berhasil dibuat.');
        } else {
            return redirect()->back()->with('danger', 'Akun ' . $request->input('role') . ' gagal dibuat.');
        }
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }
}
