@extends('layouts.app')

@section('title')Jobs | JPC @endsection

@section('css')
@endsection

@section('content')
<div class="az-content-label mg-b-5">Notifikasi Lowongan Kerja</div>
    <p class="mg-b-20">notifikasi loker yang anda apply dan sudah ditanggapi oleh perusahaan.</p>

    <div class="table-responsive">
        @if(count($apps) != 0)
        <table id="tableApply" class="table table-hover mg-b-0">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama / Posisi</th>
                <th>Perusahaan</th>
                <th>Jenis</th>
                <th>Deadline</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
                @include('tanggal_indo')
                @foreach($apps as $app)
                <?php
                    $j = \App\Job::find($app->id_job);
                    $c = \App\InfoCompany::firstWhere('id_user', $app->id_company);
                ?>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>
                        <?php
                            $id = Illuminate\Support\Facades\Crypt::encryptString($app->id);
                        ?>
                        <a href="{{ route('U-DetailLoker', ['id' => $id]) }}">{{ $j->posisi }}</a>
                    </td>
                    <td>{{ $c->nama }}</td>
                    <td class="text-capitalize">{{ $j->jenis }}</td>
                    <td>{{ tanggal_indonesia($j->deadline) }}</td>
                    <td>{{ $app->status }}</td>
                    <td>
                        <?php
                            $today = strtotime(date("Y-m-d"));
                            $deadline = strtotime($j->deadline);
                        ?>

                        @if($today > $deadline)
                            <div class="badge badge-danger">Tutup</div>
                        @else
                            <div class="badge badge-success">Open</div>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        
        @else
            <img src="{{ asset('img/kosong.png') }}" class="d-block mx-auto"
                style="
                    max-width: 50%;
                "
            >
        @endif
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#tableApply').DataTable( {
            
        } );
    } );
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