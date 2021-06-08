@extends('layouts.app')

@section('title')Pelamar | JPC @endsection

@section('css')
@endsection

@section('content')
<div class="az-content-label mg-b-5">List Pelamar</div>
<p class="mg-b-20">daftar pelamar pada lowongan yang diposting oleh perusahaan anda.</p>

<table id="tablePelamar" class="table table-hover mg-b-0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Umur</th>
            <th>Posisi Dilamar</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @include('umur')
        @foreach($apps as $a)
            <?php

            $u = \App\InfoUser::firstWhere('id_user', $a->id_pelamar);
            $j = \App\Job::firstWhere('id', $a->id_job);

            ?>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <?php
                       $id = Illuminate\Support\Facades\Crypt::encryptString($a->id);
                    ?>
                    <a href="{{ route('C-DetailPelamar', ['id' => $id]) }}">{{ $u->nama }}</a>
                </td>
                <td>{{ $u->user->email }}</td>
                <td>{{ umur($u->tgl_lahir) }} <span class="">tahun</span></td>
                <td>{{ $j->posisi }}</td>
                <td class="text-capitalize">
                    @if($a->status == 'pending')
                        <span class="badge badge-secondary">{{ $a->status }}</span>
                    @elseif($a->status == 'ditolak')
                        <span class="badge badge-danger">{{ $a->status }}</span>
                    @else
                        <span class="badge badge-success">{{ $a->status }}</span>
                    @endif
                </td>
                <td>
                    @if($a->baca_perusahaan == 0)
                        Belum dilihat
                    @else
                        Sudah dilihat
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#tablePelamar').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print all',
                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print selected'
                }
            ],
            select: true
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