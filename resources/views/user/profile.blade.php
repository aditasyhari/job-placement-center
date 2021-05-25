@extends('layouts.app')

@section('title')
    Edit Profile | JPC
@endsection

@section('css')
@endsection

@section('content')
<div class="az-dashboard-one-title">
    <div>
        <h2 class="az-dashboard-title">Hi, {{ Auth()->user()->name }}</h2>
        <p class="az-dashboard-text">Yuk lengkapi data diri anda dibawah ini.</p>
    </div>
    <div class="az-content-header-right">
        <h2>Profile</h2>
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

                <form id="formProfile" method="POST" action="{{ url('/user/profile/infoUser/pic/update/'.$infoUser->id) }}" enctype="multipart/form-data">
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
                        
                        <div class="row">
                            <div class="mx-auto">
                                <div class="custom-file mt-2" 
                                    style="
                                        max-width: 200px;
                                    "
                                >
                                    <input type="file" class="custom-file-input" id="profile" name="profile" accept="image/*">
                                    <label class="custom-file-label" for="customFile">Change</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ url('/user/profile/infoUser/update/'.$infoUser->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" class="form-control" id="nim" value="{{ $infoUser->nim }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" id="nik" value="{{ $infoUser->nik }}" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $infoUser->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ttl">Tempat, Tanggal Lahir</label>
                        <div class="row row-sm">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Ex: Banyuwangi" value="{{ $infoUser->tempat_lahir }}" required>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Tanggal:
                                        </div>
                                    </div>
                                    <input id="dateMask" name="tgl_lahir" type="date" class="form-control" placeholder="MM/DD/YYYY" value="{{ $infoUser->tgl_lahir }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender">Jenis Kelamin</label>
                        <div class="row row-sm">
                            <div class="col-md-3">
                                <label class="rdiobox">
                                    <input name="gender" type="radio" value="L" {{ ($infoUser->gender == "L")? "checked" : "" }} >
                                    <span>Laki - Laki</span>
                                </label>
                                </div><!-- col-3 -->
                                <div class="col">
                                <label class="rdiobox">
                                    <input name="gender" type="radio" value="P" {{ ($infoUser->gender == "P")? "checked" : "" }}>
                                    <span>Perempuan</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="5" placeholder="Alamat Lengkap..." required>{{ $infoUser->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <div class="row row-sm">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Berat</span>
                                    </div>
                                    <input type="number" class="form-control" name="berat" value="{{ $infoUser->berat }}" required>
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
                                    <input type="number" class="form-control" name="tinggi" value="{{ $infoUser->tinggi }}" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi</label>
                        <textarea type="text" class="form-control" id="desc" name="desc" rows="5" placeholder="Ceritakan tentang diri anda..." required>{{ $infoUser->desc }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mb-3">Simpan</button>
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
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addPendidikan"><i class="fas fa-plus"></i></button>

                        <!-- Modal Add -->
                        <div class="modal fade" id="addPendidikan" tabindex="-1" aria-labelledby="addPendidikanLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addPendidikanLabel">Tambah Pendidikan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('PendidikanStore') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama" class="col-form-label">Di :</label>
                                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama universitas / politeknik - Jurusan" required>
                                                <input type="hidden" name="id_user" value="{{ Auth()->user()->id }}">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Thn. Masuk</label>
                                                        <select class="form-control" name="thn_masuk" id="thn_masuk" required>
                                                            <option value="" selected disabled>Pilih</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="">Thn. Keluar</label>
                                                        <select class="form-control" name="thn_keluar" id="thn_keluar" required>
                                                            <option value="" selected disabled>Pilih</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush">
                            @foreach($pendidikans as $pendidikan)
                            <li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mt-2">{{ $pendidikan->nama }}</h6>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deletePendidikan{{ $pendidikan->id }}"><i class="fas fa-trash"></i></button>
                                
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deletePendidikan{{ $pendidikan->id }}" tabindex="-1" aria-labelledby="deletePendidikan{{ $pendidikan->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deletePendidikan{{ $pendidikan->id }}Label">Hapus Pendidikan ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('PendidikanDestroy', ['id' => $pendidikan->id]) }}">
                                                        @csrf
                                                        @method('delete')
                                                        Yakin hapus pendidikan {{ $pendidikan->nama }} ?
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addSkill"><i class="fas fa-plus"></i></button>

                        <!-- Modal Add -->
                        <div class="modal fade" id="addSkill" tabindex="-1" aria-labelledby="addSkillLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addSkillLabel">Tambah Kemampuan / Skill</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('SkillStore') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama" class="col-form-label">Skill :</label>
                                                <input type="text" name="nama" class="form-control" id="nama" placeholder="skill yang anda miliki" required>
                                                <input type="hidden" name="id_user" value="{{ Auth()->user()->id }}">
                                            </div>
                                    </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($skills as $skill)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <h6>{{ $skill->nama }}</h6>
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteSkill{{ $skill->id }}"><i class="fas fa-trash"></i></button>
                                
                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteSkill{{ $skill->id }}" tabindex="-1" aria-labelledby="deleteSkill{{ $skill->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteSkill{{ $skill->id }}Label">Hapus Skill ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('SkillDestroy', ['id' => $skill->id]) }}">
                                                    @csrf
                                                    @method('delete')
                                                    Yakin hapus skill {{ $skill->nama }} ?
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addLicensi"><i class="fas fa-plus"></i></button>

                        <!-- Modal Add -->
                        <div class="modal fade" id="addLicensi" tabindex="-1" aria-labelledby="addLicensiLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addLicensiLabel">Tambah Licensi / Sertifikat</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('LicensiStore') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="nama" class="col-form-label">Licensi</label>
                                                <input type="text" name="nama" class="form-control" id="nama" placeholder="nama licensi atau sertifikat" required>
                                                <input type="hidden" name="id_user" value="{{ Auth()->user()->id }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Penerbit</label>
                                                <input type="text" name="penerbit" class="form-control" placeholder="penerbit licensi atau sertifikat" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">expired ?</label>
                                                <input type="checkbox" id="ex_check" onclick="exp()" checked>
                                                <input type="hidden" name="is_expired" value="1" id="expired">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="">Thn. Terbit</label>
                                                        <input type="text" class="datepicker form-control" name="thn_terbit" id="thn_terbit" required>
                                                    </div>
                                                    <div class="col">
                                                        <label for="">Thn. Expired</label>
                                                        <input type="text" class="datepicker form-control" name="thn_expired" id="thn_expired" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Upload File</label>
                                                <input type="file" name="file" class="form-control" accept=".jpg, .jpeg, .png, .pdf" required>
                                            </div>
                                    </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="list-group list-group-flush">
                            @foreach($licensis as $licensi)
                            <li class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mt-2">{{ $licensi->nama }}</h6>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteLicensi{{ $licensi->id }}"><i class="fas fa-trash"></i></button>

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteLicensi{{ $licensi->id }}" tabindex="-1" aria-labelledby="deleteLicensi{{ $licensi->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLicensi{{ $licensi->id }}Label">Hapus Licensi ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('LicensiDestroy', ['id' => $licensi->id]) }}">
                                                        @csrf
                                                        @method('delete')
                                                        Yakin hapus licensi {{ $licensi->nama }} ?
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

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
@endsection
@section('js')

<script>
    document.getElementById('profile').onchange = function() {
        document.getElementById('formProfile').submit();
    }

    let startYear = 1999;
    let endYear = new Date().getFullYear();
    for (i = endYear; i > startYear; i--)
    {
      $('#thn_masuk').append($('<option />').val(i).html(i));
      $('#thn_keluar').append($('<option />').val(i).html(i));
    }

    $('.datepicker').datepicker({
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years"
    });

    function exp() {
        check = document.getElementById('ex_check');
        expired = document.getElementById('expired');
        thn_expired = document.getElementById('thn_expired');

        if(check.checked) {
            expired.value = 1;
            thn_expired.removeAttribute("disabled");
        }else {
            expired.value = 0;
            thn_expired.setAttribute("disabled", "");
        }

        console.log(expired.value);
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