<?php

namespace App\Http\Controllers;

use App\Models\tbl_user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TblUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(tbl_user $akun)
    {
        $data = [
            'akun' => $akun->all()
        ];
        return view('akun.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('akun.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, tbl_user $akun)
    {
        $data = $request->validate(
            [
                'username' => ['required'],
                'password' => ['required'],
                'role'    => ['required'],
            ]
        );
        

        //Proses Insert
        if ($data) {
            $data['password'] = hash::make($data['password']);
            // Simpan jika data terisi semua
            $akun->create($data);
            return redirect('dashboard/akun')->with('success', 'Data user baru berhasil ditambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data user gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(tbl_user $tbl_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tbl_user $tbl_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tbl_user $tbl_user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tbl_user $akun, Request $request)
    {
        //
        $id_user = $request->input('id_user');

        // Hapus 
        $aksi = $akun->where('id_user', $id_user)->delete();

        if ($aksi) {
            // Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan'   => 'Data user berhasil dihapus'
            ];
        } else {
            // Pesan Gagal
            $pesan = [
                'success' => false,
                'pesan'   => 'Data gagal dihapus'
            ];
        }

        return response()->json($pesan);
    }
}
