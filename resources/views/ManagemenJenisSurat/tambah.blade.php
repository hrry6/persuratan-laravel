@extends('layout.layout')
@section('title','Managemen Jenis Surat')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1">
                    Tambah data Managemen Jenis Surat
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="/jenis-surat/surat/simpan" enctype="multipart/form-data">
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
                                <label>Jenis Surat</label>
                                <input type="text" class="form-control" name="jenis_surat" />
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