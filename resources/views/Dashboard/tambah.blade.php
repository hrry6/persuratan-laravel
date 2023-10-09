@extends('layout.layout')
@section('title','Tambah Barang ')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1">
                    Tambah Data Surat
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="simpan" enctype="multipart/form-data">
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
                                <select name="id_jenis_surat" class="form-control">
                                    @foreach ($jenisSurat as $jenis)
                                        <option value="{{ $jenis->id_jenis_surat }}">{{ $jenis->jenis_surat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <input type="date" class="form-control" name="tanggal_surat" />
                            </div>
                            <div class="form-group">
                                <label>Ringkasan</label>
                                <input type="text" class="form-control" name="ringkasan" >
                            </div>
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" class="form-control" name="file" />
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