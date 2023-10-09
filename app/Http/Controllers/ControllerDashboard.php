<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ControllerDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Surat $surat)
    {
        $data = [
            'surat' => $surat->get()
        ];
        return view("Dashboard.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'jenisSurat' => JenisSurat::all()
        ];
        return view("Dashboard.tambah", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'id_jenis_surat' => 'required',
                'tanggal_surat' => 'required',
                'ringkasan' => 'required',
                'file' => 'required|file',
            ]
        );

        $user = Auth::user();
        $data['id_user'] = $user->id_user;

        if($request->hasFile('file'))
        {
            $foto_file = $request->file('file');
            $foto_nama = $foto_file->getClientOriginalName() . time() . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['file'] = $foto_nama;
        }
        
        if(Surat::create($data))
        {
            return redirect()->to('/dashboard/surat')->with("success", "Data Surat Berhasil Ditambahkan");
        }else
        {
            return back()->with("error","Data Surat Gagal Ditambahkan");
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
    public function edit(string $id, JenisSurat $jenisSurat)
    {
        $suratData = Surat::where('id_surat', $id)->first();
        $jenisSuratData = JenisSurat::all();

        $data = [
            'surat' => $suratData,
            'jenisSurat' => $jenisSuratData
        ];

        return view('Dashboard.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Surat $surat, Request $request)
    {
        $data = $request->validate(
            [
                'id_surat' => 'required',
                'file' => 'sometimes|file'
            ]
        );

        if($data)
        {
            if($request->hasFile('file'))
            {
                $foto_file = $request->file('file');
                $foto_nama = $foto_file->getClientOriginalName() . time() . '.' . $foto_file->getClientOriginalExtension();
                $foto_file->move(public_path('foto'), $foto_nama);
                $update_data = $surat->where('id_surat', $request->input('id_surat'))->first();
                File::delete(public_path('foto').'/'. $update_data->file);
                $data['file'] = $foto_nama;
            }
            Surat::where('id_surat', $request->input('id_surat'))->update($data);
            return redirect()->to('/dashboard/surat')->with('success','Data Surat Berhasil di Update');
        }else
        {
            return back()->with('error','Data Surat Gagal di Update');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Surat $surat)
    {
        $id_surat = $request->input('id_surat');
        $data = Surat::find($id_surat);
        if (!$data) {
            return back()->with('error','Data Surat Gagal di Hapus');
        }
        $filePath = public_path('foto').'/'.$data->file;
        if(file_exists($filePath) && unlink($filePath))
        {            
            $aksi = Surat::where('id_surat', $id_surat)->delete();
    
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
}
