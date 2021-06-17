@extends('layouts.app')

@section('title')
    Setting Notifikasi | JPC
@endsection

@section('css')
@endsection

@section('content')
@include('tanggal_indo')

<form action="{{ route('notifications.update', ['notification' => 1]) }}" method="POST">
    @csrf
    @method('put')

    <div class="row row-sm mg-b-20">
        <div class="col-lg-6 ht-lg-100p">
            <div class="card card-dashboard-two">
                <div class="card-header">
                    <h2 class="az-dashboard-title">Atur Email</h2>
                    <hr>
                </div>
                <div class="card-body pl-3 pr-3 pt-3 pb-3">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{ $notif->email }}" placeholder="email.." disabled required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" class="form-control" id="password" value="{{ $notif->password }}" placeholder="password email.." disabled required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 ht-lg-100p">
            <div class="card card-dashboard-two">
                <div class="card-header">
                    <h2 class="az-dashboard-title">Pesan Apply</h2>
                    <hr>
                </div>
                <div class="card-body pl-3 pr-3">
                    <textarea name="pesan_apply" id="" class="pesan" >{{ $notif->pesan_apply }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-sm mg-b-20">
        <div class="col-lg-6 ht-lg-100p">
            <div class="card card-dashboard-two">
                <div class="card-header">
                    <h2 class="az-dashboard-title">Pesan Diterima</h2>
                    <hr>
                </div>
                <div class="card-body pl-3 pr-3">
                    <textarea name="pesan_diterima" id="" class="pesan" >{{ $notif->pesan_diterima }}</textarea>
                </div>
            </div>
        </div>
        <div class="col-lg-6 ht-lg-100p">
            <div class="card card-dashboard-two">
                <div class="card-header">
                    <h2 class="az-dashboard-title">Pesan Ditolak</h2>
                    <hr>
                </div>
                <div class="card-body pl-3 pr-3">
                    <textarea name="pesan_ditolak" id="" class="pesan" >{{ $notif->pesan_ditolak }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary">Simpan</button>

</form>

@endsection
@section('js')
<script>
      tinymce.init({
        selector: 'textarea.pesan',
        height: 200,
        menubar: false,
        plugins: [
          'advlist autolink lists link image charmap print preview anchor',
          'searchreplace visualblocks code fullscreen',
          'insertdatetime media table paste code help wordcount',
          'fullscreen'
        ],
        toolbar: 'undo redo | formatselect | fullscreen |' +
          'bold italic backcolor | alignleft aligncenter ' +
          'alignright alignjustify | bullist numlist outdent indent | ' +
          'removeformat | help',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
      });

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