@extends('layout.layout')
@section('title','Managemen Jenis Surat')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1">
                    Transaksi Surat
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <p>
                        <hr>
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>Transaksi Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaksiSurat as $r)
                                <tr>
                                    <td>{{ $r->log }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')

@endsection