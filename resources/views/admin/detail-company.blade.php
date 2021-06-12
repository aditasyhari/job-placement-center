@extends('layouts.app')

@section('title')
    Detail Perusahaan | JPC
@endsection

@section('css')
@endsection

@section('content')
<button class="btn btn-primary mb-2" onclick="printContent('print')">Print</button>
<section id="print">

<div class="az-dashboard-one-title">
    <div>
        <h2 class="az-dashboard-title">{{ $c->name }} - <small class="badge badge-info font-sm">perusahaan</small></h2>
        <div>Email : <span class="font-weight-bold">{{ $c->email }}</span></div>        
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
                <form id="formProfile" method="POST" action="" enctype="multipart/form-data">
                    
                    <div class="form-group">
                        <img 
                            src="{{ asset('img/profile/'.$c->infoCompany->profile) }}" 
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
                <form method="POST" action="">
                   
                    <div class="form-group">
                        <label for="nama">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $c->infoCompany->nama }}" placeholder="nama instansi / perusahaan" disabled required>
                    </div>
                    <div class="form-group">
                        <label for="">NPWP</label>
                        <input type="text" name="npwp" class="form-control" id="npwp" value="{{ $c->infoCompany->npwp }}" placeholder="nomor npwp perusahaan" disabled required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat Lengkap..." disabled required>{{ $c->infoCompany->alamat }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Fax <span class="text-muted">(optional / bisa dikosongi)</span></label>
                        <input type="text" name="fax" class="form-control" id="fax" value="{{ $c->infoCompany->fax }}" placeholder="fax perusahaan" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">No. Telp</label>
                        <input type="text" name="no_telp" class="form-control" id="no_telp" value="{{ $c->infoCompany->no_telp }}" placeholder="no. telp yang dapat dihubungi" disabled required>
                    </div>
                    <div class="form-group">
                        <label for="">Website <span class="text-muted">(optional / bisa dikosongi)</span></label>
                        <input type="text" name="website" class="form-control" id="website" value="{{ $c->infoCompany->website }}" placeholder="ex: www.namawebsite.com" disabled>
                    </div>
                    <div class="form-group">
                        <label for="desc">Tentang Perusahaan</label>
                        <textarea type="text" class="form-control" id="desc" name="desc" rows="7" placeholder="Ceritakan tentang perusahaan..." disabled required>{{ $c->infoCompany->desc }}</textarea>
                    </div>
                    
                    <!-- <button type="submit" class="btn btn-primary mb-3">Simpan</button> -->
                </form>
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