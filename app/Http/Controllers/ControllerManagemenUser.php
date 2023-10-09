<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class ControllerManagemenUser extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'user' => User::all()
        ];
        return view("ManagemenUser.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("ManagemenUser.tambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user,Request $request)
    {
        $validate = $request->validate(
        [
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        if($validate)
        {
            User::create($validate);
            return redirect()->to('/managemen-user/user')->with('success', 'Data User Berhasil Ditambahkan');
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
    public function edit(Request $request, User $user)
    {
        $data = [
            'data' => User::where('id_user', $request->id)->first()
        ];
        return view('ManagemenUser.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validate = $request->validate(
            [
                'username' => 'required',
                'role' => 'required'
            ]);
            if($validate)
            {
                if($request->get('password') !== null)
                {
                    $validate['password'] = Hash::make($request->get('password'));
                }
                User::where('id_user', $request->get('id_user'))->update($validate);
                return redirect()->to('/managemen-user/user')->with('success', 'Data User Berhasil Diupdate');
            }else
            {
                return back()->with("error","Data User Gagal Ditambahkan");
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        $id_user = $request->input('id_user');
        $aksi = $user->where("id_user", $id_user)->delete();

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
