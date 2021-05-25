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
        <p class="az-dashboard-text">Yuk lengkapi info perusahaan anda dibawah ini.</p>
    </div>
    <div class="az-content-header-right">
        <h2>Profile</h2>
    </div>
</div>

<div class="row row-sm mg-b-20">
    <div class="col-lg-6 ht-lg-100p">
        <div class="card card-dashboard-two">
            <div class="card-header">
                <h2 class="az-dashboard-title">Logo Perusahaan</h2>
                <hr>
            </div>
            <div class="card-body pl-3 pr-3">
                <form id="formProfile" method="POST" action="{{ url('/company/profile/infoCompany/pic/update/'.$infoCompany->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <img 
                            src="{{ asset('img/profile/'.$infoCompany->profile) }}" 
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
            </div>
        </div>
    </div>
    
    <div class="col-lg-6 ht-lg-100p">
        <div class="card card-dashboard-two">
            <div class="card-header">
                <h2 class="az-dashboard-title">Perusahaan Info</h2>
                <hr>
            </div>
            <div class="card-body pl-3 pr-3">
                <form method="POST" action="{{ url('/company/profile/infoCompany/update/'.$infoCompany->id) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $infoCompany->nama }}" placeholder="nama instansi / perusahaan" required>
                    </div>
                    <div class="form-group">
                        <label for="">NPWP</label>
                        <input type="text" name="npwp" class="form-control" id="npwp" value="{{ $infoCompany->npwp }}" placeholder="nomor npwp perusahaan" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat Lengkap..." required>{{ $infoCompany->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Fax <span class="text-muted">(optional / bisa dikosongi)</span></label>
                        <input type="text" name="fax" class="form-control" id="fax" value="{{ $infoCompany->fax }}" placeholder="fax perusahaan">
                    </div>
                    <div class="form-group">
                        <label for="">No. Telp</label>
                        <input type="text" name="no_telp" class="form-control" id="no_telp" value="{{ $infoCompany->no_telp }}" placeholder="no. telp yang dapat dihubungi" required>
                    </div>
                    <div class="form-group">
                        <label for="">Website <span class="text-muted">(optional / bisa dikosongi)</span></label>
                        <input type="text" name="website" class="form-control" id="website" value="{{ $infoCompany->website }}" placeholder="ex: www.namawebsite.com">
                    </div>
                    <div class="form-group">
                        <label for="desc">Tentang Perusahaan</label>
                        <textarea type="text" class="form-control" id="desc" name="desc" rows="7" placeholder="Ceritakan tentang perusahaan..." required>{{ $infoCompany->desc }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mb-3">Simpan</button>
                </form>
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