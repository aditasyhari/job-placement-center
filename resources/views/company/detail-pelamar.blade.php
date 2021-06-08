@extends('layouts.app')

@section('title')
    Detail Pelamar | JPC
@endsection

@section('css')
@endsection

@section('content')
@include('tanggal_indo')
<section id="print">
<div class="az-dashboard-one-title">
    <div>
        <h2 class="az-dashboard-title">{{ $infoUser->nama }}</h2>
        <div>Posisi dilamar : <span class="font-weight-bold">{{ $job->posisi }}</span></div>
        @switch($app->status)
            @case('pending')
                <p class="">Status : <span class="badge badge-secondary text-uppercase">{{ $app->status }}</span></p>
                <div class="row">
                    <div class="col">
                        <form action="{{ route('C-Status', ['id_app' => $app->id]) }}" method="POST" class="d-flex flex-row">
                        @csrf
                            <select name="status" id="" class="form-control">
                                <option selected disabled>Pilih Status</option>
                                <option value="diterima">Diterima</option>
                                <option value="ditolak">Ditolak</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                @break
            @case('diterima')
                <div class="">Status : <span class="badge badge-success text-uppercase">{{ $app->status }}</span></div>
                <p class="text-secondary">Silahkan hubungi pelamar untuk lebih lanjut.</p>
                @break
            @case('ditolak')
                <p class="">Status : <span class="badge badge-danger text-uppercase">{{ $app->status }}</span></p>
                @break
            @default
                @break
        @endswitch

        <p>
            <button class="btn btn-secondary" onclick="printContent('print')"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info mt-2 mb-2" type="button" data-toggle="collapse" data-target="#jobDesc" aria-expanded="false" aria-controls="jobDesc">
                Detail Lowongan
            </button>
        </p>
        <div class="collapse" id="jobDesc">
            <div class="card card-body">
                {{ $job->desc }}
            </div>
        </div>
    </div>
</div>

<div class="row row-sm mg-b-20">
    <div class="col-lg-6 ht-lg-100p">
        <div class="card card-dashboard-two">
            <div class="card-header">
                <h2 class="az-dashboard-title">Personal Info</h2>
                <hr>
            </div>
            <div class="card-body pl-3 pr-3">

                <form id="" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <img 
                            src="{{ asset('img/profile/'.$infoUser->profile) }}" 
                            class="img-thumbnail rounded-circle" 
                            alt="profile"
                            style="
                                width: 200px;
                                height: 200px;
                                display: block;
                                margin-left: auto;
                                margin-right: auto;
                                
                            "
                        >

                    </div>
                </form>
                <form method="POST" action="{{ url('/user/profile/infoUser/update/'.$infoUser->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" class="form-control" id="nim" value="{{ $infoUser->nim }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" id="nik" value="{{ $infoUser->nik }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $infoUser->nama }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="nama">Email</label>
                        <input type="text" class="form-control"  value="{{ $infoUser->user->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="telp">Nomor HP</label>
                        <input type="text" class="form-control" id="telp" name="telp" value="{{ $infoUser->telp }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="ttl">Tempat, Tanggal Lahir</label>
                        <div class="row row-sm">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Ex: Banyuwangi" value="{{ $infoUser->tempat_lahir }}" disabled>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Tanggal:
                                        </div>
                                    </div>
                                    <input name="tgl_lahir" type="text" class="form-control" value="{{ tanggal_indonesia($infoUser->tgl_lahir) }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        @if($infoUser->gender == 'L')
                            <input type="text" class="form-control" value="Laki -laki" disabled>
                        @else
                            <input type="text" class="form-control" value="Perempuan" disabled>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="5" placeholder="Alamat Lengkap..." disabled>{{ $infoUser->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Berat</span>
                                    </div>
                                    <input type="number" class="form-control" name="berat" value="{{ $infoUser->berat }}" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">kg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Tinggi</span>
                                    </div>
                                    <input type="number" class="form-control" name="tinggi" value="{{ $infoUser->tinggi }}" disabled>
                                    <div class="input-group-append">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc">Tentang Saya</label>
                        <textarea type="text" class="form-control" id="desc" name="desc" rows="5" placeholder="Ceritakan tentang diri anda..." disabled>{{ $infoUser->desc }}</textarea>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Pendidikan -->
    <div class="col-lg-6 mg-t-20 mg-lg-t-0">
        <div class="row row-sm">
            <div class="col-sm-12">
                <div class="card card-dashboard-two">
                    <div class="card-header">
                        <h2 class="az-dashboard-title">Riwayat Pendidikan</h2>
                        <hr>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($pendidikans as $pendidikan)
                            <li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mt-2">{{ $pendidikan->nama }}</h6>
                                    
                                </div>
                                <small class="">{{ $pendidikan->thn_masuk }} - {{ $pendidikan->thn_keluar }}</small>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Skill -->
            <div class="col-sm-12 mg-t-20">
                <div class="card card-dashboard-two">
                    <div class="card-header">
                        <h2 class="az-dashboard-title">Skills</h2>
                        <hr>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($skills as $skill)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h6>{{ $skill->nama }}</h6>
                                
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Licensi -->
            <div class="col-sm-12 mg-t-20">
                <div class="card card-dashboard-two">
                    <div class="card-header">
                        <h2 class="az-dashboard-title">Sertifikat atau Licensi</h2>
                        <hr>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($licensis as $licensi)
                            <li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mt-2">{{ $licensi->nama }}</h6>

                                </div>
                                <p>{{ $licensi->penerbit }}</p>
                                @if($licensi->is_expired == true)
                                    <small class="">{{ $licensi->thn_terbit }} - {{ $licensi->thn_expired }}. <a href="{{ asset('img/sertifikat/'.$licensi->file) }}" target="_blank">Lihat file</a></small>
                                @else
                                    <small class="">Terbit {{ $licensi->thn_terbit }}. <a href="{{ asset('img/sertifikat/'.$licensi->file) }}" target="_blank">Lihat file</a></small>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection
@section('js')

<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
@if(session('status'))
    <script>
        $(function() {
            $('#staticBackdrop').modal('show');
        });
    </script>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Berhasil !!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                {{ session('status') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
@endif
@endsection