@extends('layout.layout')
@section('title','Dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1">
                    Dashboard
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="surat/tambah">
                            <btn class="btn btn-success">Tambah </btn>
                        </a>

                    </div>
                    <p>
                        <hr>
                        <table class="table table-hover table-bordered DataTable">
                            <thead>
                                <tr>
                                    <th>Jenis Surat</th>
                                    <th>Pembuat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Ringkasan</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($surat as $r)
                                <tr>
                                    <td>{{$r->jenis_surat}}</td>
                                    <td>{{$r->username}}</td>
                                    <td>{{$r->tanggal_surat}}</td>
                                    <td>{{$r->ringkasan}}</td>
                                    <td>
                                        @if ($r->file)
                                            <img src="{{ url('foto') . '/' . $r->file }} "style="max-width: 250px; height: auto;" />
                                        @endif
                                    </td>
                                    <td>
                                        <a href="surat/edit/{{$r->id_surat}}"><btn class="btn btn-primary">EDIT</btn></a>
                                        <btn class="btn btn-danger btnHapus" idHapus="{{$r->id_surat}}">HAPUS</btn>
                                    </td>
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
<script type="module">
    $('.DataTable tbody').on('click','.btnHapus',function(a){
        a.preventDefault();
        let idHapus = $(this).closest('.btnHapus').attr('idHapus');
        swal.fire({
            title : "Apakah anda ingin menghapus data ini?",
            showCancelButton: true,
            confirmButtonText: 'Setuju',
            cancelButtonText: `Batal`,
            confirmButtonColor: 'red'

        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    type: 'DELETE',
                    url: 'surat/hapus',
                    data: {
                        id_surat : idHapus,
                        _token : "{{csrf_token()}}"
                    },
                    success : function(data){
                        if(data.success){
                            swal.fire('Berhasil di hapus!', '', 'success').then(function(){
                                //Refresh Halaman
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    });
</script>
@endsection