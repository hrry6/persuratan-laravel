@extends('layout.layout')
@section('title','Managemen Jenis Surat')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1">
                    Edit data Managemen Jenis Surat
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="/jenis-surat/surat/update" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                        <p>
                            <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id_jenis_surat" value="{{ $data->id_jenis_surat }}" />
                                <label>Jenis Surat</label>
                                <input type="text" class="form-control" name="jenis_surat" value="{{ $data->jenis_surat }}" />
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