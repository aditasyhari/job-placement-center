@extends('layouts.app')

@section('title')Users | JPC @endsection

@section('css')
@endsection

@section('content')
<div class="az-content-label mg-b-5">List User</div>
    <p class="mg-b-20">daftar semua user yang mendaftar di aplikasi JPC.</p>
    <!-- <button type="button" class="btn btn-sm btn-primary mb-4" data-toggle="modal" data-target="#addJobs"><i class="fas fa-plus"></i></button> -->
    
    <div class="table-responsive">
        @if(count($users) != 0)
        <table id="tableUser" class="table table-hover mg-b-0">
            <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nim</th>
                <th>Gender</th>
                <th>No. Hp</th>
                <th>Tgl. Lahir</th>
                <th>Profile</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @include('tanggal_indo')
                @foreach($users as $user)
                <?php

                ?>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <th>
                        <img src="{{ asset('img/profile/'.$user->infoUser->profile) }}" alt=""
                            style="max-width: 50px;"
                        >
                    </th>
                    <th>{{ $user->infoUser->nama }}</th>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->infoUser->nim }}</td>
                    <td class="text-capitalize">{{ $user->infoUser->gender }}</td>
                    <td>{{ $user->infoUser->telp }}</td>
                    <td>
                        @if($user->infoUser->tgl_lahir != null)
                            {{ $user->infoUser->tempat_lahir }}, {{ tanggal_indonesia($user->infoUser->tgl_lahir) }}
                        @endif
                    </td>
                    <td>
                        @if($user->infoUser->nim == null || $user->infoUser->nik == null)
                            <span class="badge badge-warning">Belum Lengkap</span>
                        @else
                            <span class="badge badge-success">Lengkap</span>
                        @endif
                    </td>
                    <td></td>
                    <td>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteUser{{ $user->id }}"><i class="fas fa-trash"></i></button>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUser{{ $user->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUser{{ $user->id }}Label">Hapus Lowongan ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <p>Yakin hapus user <strong>{{ $user->name }} - {{ $user->email }}</strong> ?</p>
                                            <span class="mt-3 bg-warning p-1">Semua yang berelasi dengan user ini akan ikut terhapus.</span>
                                    </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

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
        $('#tableUser').DataTable( {
            
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