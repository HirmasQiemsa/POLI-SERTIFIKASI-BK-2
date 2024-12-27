<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Obat;
use App\Models\JadwalPeriksa;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.-------------------------------------------------------------------------------
     */
    public function login()
    {
        return view('dokter.login');
    }
    public function logout(){
        return redirect()->route('login-dokter')->with('succes','Berhasil keluar, Stay Healthy Dok..');
    }
    public function dashboard()
    {
        $dokterId = session('dokter_id');
        $dokter = Dokter::findOrFail($dokterId);
        return view('dokter.dashboard', compact('dokter'));
    }
    public function jadwal_dokter()
    {
        $dokterId = session('dokter_id');
        $dokter = Dokter::findOrFail($dokterId);
        $data = JadwalPeriksa::withTrashed()->where('id_dokter', $dokterId)->get();
        return view('dokter.jadwal', compact('dokter','data'));
    }
    public function setting_dokter()
    {
        $poli = Poli::all();
        $dokterId = session('dokter_id');
        $dokter = Dokter::findOrFail($dokterId);
        return view('dokter.setting', compact('dokter','poli'));
    }
    public function periksa_pasien()
    {
        $dokterId = session('dokter_id');
        $dokter = Dokter::findOrFail($dokterId);
        $data = DaftarPoli::with(['pasien', 'periksa.detailPeriksa'])->get();

        return view('dokter.periksa-pasien', compact('dokter','data'));
    }

    /**
     * Show the form for creating a new resource.-------------------------------------------------------------------------------
     */
    public function create_jadwal()
    {
        $dokterId = session('dokter_id');
        $dokter = Dokter::findOrFail($dokterId);
        return view('dokter.create-jadwal', compact('dokter'));
    }

    /**
     * Store a newly created resource in storage.-------------------------------------------------------------------------------
     */
    public function login_proses(Request $request)
    {
        $request ->validate([
            'nama'=>'required',
            'password'=>'required',
        ]);

        $nama = $request->input('nama');
        $password = $request->input('password');

        $nd = Dokter::where('nama', $nama)->first();
        $pd = Dokter::where('password', $password)->first();
        // Periksa apakah dokter ditemukan dan password cocok
        if ($nd && $pd) {
        // Login berhasil, simpan data dokter di session
            session(['dokter_id' => $nd->id]);
            return redirect()->route('dashboard-dokter')->with('success', 'Selamat Datang Dok..');
        } else {
        // Login gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->route('login-dokter')->with('failed', 'Periksa Username dan Password');
        }
    }
    public function add_jadwal(Request $request){
        $dokterId = session('dokter_id');
        $validator = Validator::make($request -> all(),[
            'hari'=>'required|string',
            'jam_mulai'=>'required',
            'jam_selesai'=>'required|after:jam_mulai',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['id_dokter']  = $dokterId;
        $data['hari']       = $request->hari;
        $data['jam_mulai']  = $request->jam_mulai;
        $data['jam_selesai'] = $request->jam_selesai;

        JadwalPeriksa::create($data);

        return redirect()->route('jadwal-dokter')->with('success', 'Jadwal Berhasil Ditambahkan.');
    }
    public function add_periksa(Request $request)
{
    // Mendapatkan data pasien berdasarkan no antrian
    $pasien = DaftarPoli::where('no_antrian', $request->no_antrian)->first();

    // Cek jika pasien tidak ditemukan
    if (!$pasien) {
        return redirect()->back()->withInput()->withErrors(['no_antrian' => 'Pasien tidak ditemukan.']);
    }

    // Menggabungkan id_daftar_poli (id pasien) ke dalam request
    $request->merge(['id_daftar_poli' => $pasien->id]);

    // Melakukan validasi
    $validator = Validator::make($request->all(), [
        'id_daftar_poli' => 'required|integer',
        'tgl_periksa' => 'required|date',
        'catatan' => 'required',
        'biaya_periksa' => 'required|numeric',
        'obat_ids' => 'required|array', // Pastikan obat_ids ada dan berupa array
        'obat_ids.*' => 'exists:obat,id' // Pastikan setiap ID obat ada di tabel obat
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    // Buat instance periksa dan set obat_ids
    $periksa = new Periksa($request->all());
    $periksa->setObatIds($request->obat_ids);

    // Simpan data
    $periksa->save();

    return redirect()->route('periksa-pasien')->with('success', 'Pasien Telah Diperiksa.');
}




    /**
     * Display the specified resource.-------------------------------------------------------------------------------
     */
    public function edit_jadwal($id){
        $data = JadwalPeriksa::find($id);
        $dokterId = session('dokter_id');
        $dokter = Dokter::findOrFail($dokterId);

        if($data){

        }

        return view('dokter.edit-jadwal',compact('data','dokter'));
    }
    public function periksa($id) {
        $dokterId = session('dokter_id');
        $dokter = Dokter::findOrFail($dokterId);
        $periksa = DaftarPoli::with('pasien')->find($id);
        $obat = Obat::all();
        return view('dokter.create-periksa', compact('dokter','periksa', 'obat'));
    }
    /**
     * Show the form for editing the specified resource.-------------------------------------------------------------
     */
    public function edit_periksa(Request $request,$id){
        $data = Periksa::find($id);
        $obat = Obat::all();
        $periksa =  Periksa::with(['detailPeriksa.obat', 'daftarPoli.pasien'])->find($id);
        $dokterId = session('dokter_id');
        $dokter = Dokter::findOrFail($dokterId);

        return view('dokter.edit-periksa',compact('dokter','data', 'obat','periksa'));
    }


    /**
     * Update the specified resource in storage.----------------------------------------------------------------
     */
    public function update(Request $request)
    {
        $dokterId = session('dokter_id');
        $dokter = Dokter::findOrFail($dokterId);

        $validator = Validator::make($request -> all(),[
            'nama'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required|numeric',
            'password'=>'required',
            // 'id_poli'=>'required|exists:poli,id',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        // Perbarui data dokter
        $dokter->update($request->all());

        return redirect()->route('setting-dokter')->with('success', 'Data dokter berhasil diperbarui.');
    }
    public function update_jadwal(Request $request,$id)
    {
        $jadwal = JadwalPeriksa::withTrashed()->find($id);
        $dokterId = session('dokter_id');
        $dokter = Dokter::findOrFail($dokterId);

        $validator = Validator::make($request -> all(),[
            'nama'=>'required',
            'alamat'=>'required',
            'no_hp'=>'required|numeric',
            'password'=>'required',
            // 'id_poli'=>'required|exists:poli,id',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        // Perbarui data dokter
        $dokter->update($request->all());

        return redirect()->route('jadwal-dokter')->with('success', 'Data dokter berhasil diperbarui.');
    }
    public function update_periksa(Request $request, $id) {
        $periksa = Periksa::find($id);
        if (!$periksa) {
            return redirect()->back()->withInput()->withErrors(['periksa' => 'Pemeriksaan tidak ditemukan.']);
        }

        $pasien = DaftarPoli::where('no_antrian', $request->no_antrian)->first();
        if (!$pasien) {
            return redirect()->back()->withInput()->withErrors(['no_antrian' => 'Pasien tidak ditemukan.']);
        }

        $request->merge(['id_daftar_poli' => $pasien->id]);
        $validator = Validator::make($request->all(), [
            'id_daftar_poli' => 'required|integer',
            'tgl_periksa' => 'required|date',
            'catatan' => 'required',
            'biaya_periksa' => 'required|numeric',
            'obat_ids' => 'required|array',
            'obat_ids.*' => 'exists:obat,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $periksa->update($request->all());

        // Hapus detail periksa lama
        $periksa->detailPeriksa()->delete();

        // Tambahkan detail periksa baru
        foreach ($request->obat_ids as $obat_id) {
            $obat = Obat::find($obat_id);
            $periksa->detailPeriksa()->create([
                'id_obat' => $obat_id,
                'harga' => $obat->harga,
            ]);
        }

        // Update total harga
        $totalHarga = $periksa->detailPeriksa->sum('harga');
        $periksa->update(['biaya_periksa' => $totalHarga]);

        return redirect()->route('periksa-pasien')->with('success', 'Data Pemeriksaan telah diperbarui.');
    }



    /**
     * Remove the specified resource from storage.---------------------------------------------------------------------------
     */
    public function destroy(Dokter $dokter)
    {
        //
    }

    /**
     * Softdelete the resource from storage.----------------------------------------------------------------------------------
     */
    public function toggle($id) {
        $jadwalPeriksa = JadwalPeriksa::withTrashed()->findOrFail($id);
        $dokterId = $jadwalPeriksa->id_dokter;
        if ($jadwalPeriksa->trashed()) {
            // Nonaktifkan semua jadwal periksa lainnya dalam minggu yang sama
            JadwalPeriksa::where('id_dokter', $dokterId) ->update(['deleted_at' => now()]);
            // Aktifkan jadwal yang dipilih
            $jadwalPeriksa->restore();
            return redirect()->back()->with('success', 'Jadwal berhasil diaktifkan');
        } else {
            // Nonaktifkan jadwal yang dipilih
            $jadwalPeriksa->delete();
            return redirect()->back()->with('success', 'Jadwal berhasil dinonaktifkan'); }
        }
}
