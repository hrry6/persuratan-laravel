@extends('layout.layout')
@section('title','Managemen User')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1">
                    Tambah data Managemen User
                </span>
            </div>
            <div class="card-body">
                <form method="post" action="simpan" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">SIMPAN</button>
                        </div>
                        <p>
                            <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" />
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-select" name="role" aria-label="Default select example">
                                    <option selected value="">Pilih Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="operator">Operator</option>
                                  </select>
                            </div>
                            @csrf
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection