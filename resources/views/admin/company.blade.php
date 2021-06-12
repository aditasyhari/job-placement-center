@extends('layouts.app')

@section('title')Perusahaan | JPC @endsection

@section('css')
@endsection

@section('content')
<div class="az-content-label mg-b-5">List Perusahaan</div>
    <p class="mg-b-20">daftar semua perusahaan yang mendaftar di aplikasi JPC.</p>
    <!-- <button type="button" class="btn btn-sm btn-primary mb-4" data-toggle="modal" data-target="#addJobs"><i class="fas fa-plus"></i></button> -->
    
    <div class="table-responsive">
        @if(count($companies) != 0)
        <table id="tableUser" class="table table-hover mg-b-0">
            <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Username</th>
                <th>Email</th>
                <th>Profile</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @include('tanggal_indo')
                @foreach($companies as $company)
                <?php

                ?>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <th>
                        <img src="{{ asset('img/profile/'.$company->infoCompany->profile) }}" alt=""
                            style="max-width: 50px;"
                        >
                    </th>
                    <th>{{ $company->name }}</th>
                    <td>{{ $company->email }}</td>
                    <td>
                        @if($company->infoCompany->npwp == null || $company->infoCompany->nama == null)
                            <span class="badge badge-warning">Belum Lengkap</span>
                        @else
                            <span class="badge badge-success">Lengkap</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('companies.show', ['company' => $company->id]) }}" class="btn btn-info">Detail</a>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteUser{{ $company->id }}"><i class="fas fa-trash"></i></button>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteUser{{ $company->id }}" tabindex="-1" aria-labelledby="deleteUser{{ $company->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUser{{ $company->id }}Label">Hapus User ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('companies.destroy', ['company' => $company->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <p>Yakin hapus perusahaan <strong>{{ $company->infoCompany->nama }} ({{ $company->name }}) - {{ $company->email }}</strong> ?</p>
                                            <span class="mt-3 bg-warning p-1">Semua yang berelasi dengan perusahaan ini akan ikut terhapus.</span>
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