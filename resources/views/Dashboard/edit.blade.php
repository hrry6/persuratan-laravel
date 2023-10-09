@extends('layout.layout')
@section('title','Edit data ')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1">
                    Edit Data Surat 
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="/dashboard/surat/update" enctype="multipart/form-data">
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
                                <input type="hidden" name="id_surat" value="{{ $surat->id_surat }}">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <input type="date" class="form-control" value="{{ $surat->tanggal_surat }}" name="tanggal_surat" />
                            </div>
                            <div class="form-group">
                                <label>Ringkasan</label>
                                <input type="text" class="form-control" value="{{ $surat->ringkasan }}" name="ringkasan" >
                            </div>
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" class="form-control" value="{{ $surat->file }}" name="file" />
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