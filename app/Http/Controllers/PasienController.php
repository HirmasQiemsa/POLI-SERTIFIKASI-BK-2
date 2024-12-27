<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Periksa;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('pasien.login');
    }
    public function logout(){
        return redirect()->route('login-pasien')->with('succes','Anda telah keluar, Stay Healthy..');
    }
    public function register()
    {
        return view('pasien.register');
    }
    public function dashboard()
    {
        $pasienId = session('pasien_id');
        $pasien = Pasien::findOrFail($pasienId);
        return view('pasien.dashboard',compact('pasien'));
    }
    public function daftar_poli()
    {
        $jadwal = JadwalPeriksa::with('dokter.ruangPoli')->get();
        $pasienId = session('pasien_id');
        $pasien = Pasien::findOrFail($pasienId);
        return view('pasien.daftar-poli',compact('pasien','jadwal'));
    }
    public function hasil_periksa()
{
    $pasienId = session('pasien_id');
    $pasien = Pasien::findOrFail($pasienId);
    $data = DaftarPoli::with(['jadwalPeriksa.dokter.ruangPoli', 'periksa.detailPeriksa.obat'])
                      ->where('id_pasien', $pasienId)
                      ->get();
    return view('pasien.hasil-periksa', compact('pasien', 'data'));
}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login_proses(Request $request)
    {
        $request ->validate([
            'nama'=>'required',
            'no_ktp'=>'required',
        ]);

        $nama = $request->input('nama');
        $no_ktp = $request->input('no_ktp');

        $np = Pasien::where('nama', $nama)->first();
        $pp = Pasien::where('no_ktp', $no_ktp)->first();
        // Periksa apakah pasien ditemukan dan no_ktp cocok
        if ($np && $pp) {
        // Login berhasil, simpan data pasien di session
            session(['pasien_id' => $np->id]);
            return redirect()->route('dashboard-pasien')->with('success', 'Berhasil Login, Selamat Datang');
        } else {
        // Login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login-pasien')->with('failed', 'Periksa Username dan Password');
        }
    }
    public function register_proses(Request $request)
    {
        $request ->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'no_ktp'=>'required|numeric|min:16|unique:pasien',
            'no_hp'=>'required|numeric|unique:pasien',
        ]);

        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['no_ktp'] = $request->no_ktp;
        $data['no_hp'] = $request->no_hp;

        Pasien::create($data);

        $nama = $request->input('nama');
        $no_ktp = $request->input('no_ktp');

        $np = Pasien::where('nama', $nama)->first();
        $pp = Pasien::where('no_ktp', $no_ktp)->first();
        // Periksa apakah pasien ditemukan dan no_ktp cocok
        if ($np && $pp) {
        // Login berhasil, simpan data pasien di session
            session(['pasien_id' => $np->id]);
            return redirect()->route('dashboard-pasien')->with('success', 'Pasien baru berhasil terdaftar masuk');
        } else {
        // Login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login-pasien')->with('failed', 'Registrasi Gagal, Pasien sudah terdaftar');
        }
    }
    public function add_daftar_poli(Request $request){
        $pasienId = session('pasien_id');
        $request->merge(['id_pasien' => $pasienId]);
        $validator = Validator::make($request -> all(),[
            'id_pasien'=>'required',
            'id_jadwal'=>'required|exists:jadwal_periksa,id',
            'keluhan'=>'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['id_pasien']  = $pasienId;
        $data['id_jadwal']  = $request->id_jadwal;
        $data['keluhan'] = $request->keluhan;

        DaftarPoli::create($data);

        return redirect()->route('daftar-poli')->with('success', 'Pendaftaran berhasil.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasien $pasien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasien $pasien)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasien $pasien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasien $pasien)
    {
        //
    }

    // additional
    public function getPeriksaData($id)
{
    $periksa = Periksa::with('detailPeriksa.obat')->findOrFail($id);
    return response()->json($periksa);
}

}
