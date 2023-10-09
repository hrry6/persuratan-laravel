<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ControllerManagemenJenisSurat extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'jenisSurat' => JenisSurat::all()
        ];
        return view("ManagemenJenisSurat.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("ManagemenJenisSurat.tambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JenisSurat $jenisSurat,Request $request)
    {
        $validate = $request->validate(
        [
            "jenis_surat"=> "required",
        ]);
        if($validate)
        {
            JenisSurat::create($validate);
            return redirect()->to('/jenis-surat/surat')->with('success', 'Data Jenis Surat Berhasil Ditambahkan');
        }else
        {
            return back()->with("error","Data Jenis Surat Gagal Ditambahkan");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, JenisSurat $jenisSurat)
    {
        $data = [
            'data' => JenisSurat::where('id_jenis_surat', $request->id)->first()
        ];
        return view('ManagemenJenisSurat.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validate = $request->validate(
            [
                "jenis_surat"=> "required",
            ]);
            if($validate)
            {
                JenisSurat::where('id_jenis_surat', $request->get('id_jenis_surat'))->update($validate);
                return redirect()->to('/jenis-surat/surat')->with('success', 'Data Jenis Surat Berhasil Diupdate');
            }else
            {
                return back()->with("error","Data Jenis Surat Gagal Ditambahkan");
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, JenisSurat $jenisSurat)
    {
        $id_jenis_surat = $request->input('id_jenis_surat');
        $aksi = $jenisSurat->where('id_jenis_surat', $id_jenis_surat)->delete();

        if($aksi)
        {
            $pesan = [
                'success' => true,
                'pesan' => 'Data berhasil di hapus'
            ];
        }else
        {
            $pesan = [
                'success' => false,
                'pesan' => 'Data gagal di hapus'
            ];
        }

        return response()->json($pesan);

    }
}