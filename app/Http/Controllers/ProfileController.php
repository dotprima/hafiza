<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $user = auth()->user();


        return view('profile.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {

        // Validasi data yang diterima dari formulir
        $request->validate([
            'firstName' => 'required|string|max:255',
            'totalWatt' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
        ]);

        // Mendapatkan data pengguna saat ini
        $user = auth()->user();

        $tarifList = [
            900 => 1352.00,
            1300 => 1444.70,
            3500 => 1699.53,
            6600 => 1699.53,
        ];
        
        // Mendapatkan nilai total_watt dari request
        $totalWatt = $request->input('totalWatt');
        
        // Mencari tarif berdasarkan total_watt
        $tarif = $tarifList[$totalWatt] ?? 'Tarif Tidak Ditemukan';
        
        // Array data untuk update
        $userUpdateData = [
            'name' => $request->input('firstName'),
            'total_watt' => $totalWatt,
            'email' => $request->input('email'),
            'tarif' => $tarif,
        ];
        

        // Check and update address fields only if they are not empty or null
        if ($request->filled('provinsi')) {
            $userUpdateData['provinsi'] = $request->input('provinsi');
        }

        if ($request->filled('kota')) {
            $userUpdateData['kota'] = $request->input('kota');
        }

        if ($request->filled('kecamatan')) {
            $userUpdateData['kecamatan'] = $request->input('kecamatan');
        }

        if ($request->filled('desa')) {
            $userUpdateData['desa'] = $request->input('desa');
        }

        $user->update($userUpdateData);

        // // Redirect ke halaman edit profil dengan pesan sukses
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }
}
