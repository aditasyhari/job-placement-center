@extends('layouts.app')

@section('title')Jobs | JPC @endsection

@section('css')
@endsection

@section('content')
<div class="az-content-label mg-b-5">List Lowongan</div>
    <p class="mg-b-20">daftar lowongan yang diposting oleh perusahaan anda.</p>
    @if($info->npwp == null || $info->nama == null)
        <button type="button" class="btn btn-sm btn-primary mb-2" disabled><i class="fas fa-plus"></i></button>
        <p class="text-muted">Lengkapi terlebih dahulu profile anda !!</p>
    @else
        <button type="button" class="btn btn-sm btn-primary mb-4" data-toggle="modal" data-target="#addJobs"><i class="fas fa-plus"></i></button>
    @endif
    <!-- Modal Add -->
    <div class="modal fade" id="addJobs" tabindex="-1" aria-labelledby="addJobsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJobsLabel">Tambah Lowongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('JobStore') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama / Posisi</label>
                            <input type="text" name="posisi" class="form-control" id="nama" placeholder="Nama / posisi lowongan" required>
                            <input type="hidden" name="id_user" value="{{ Auth()->user()->id }}">
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Jenis</label>
                            <select class="form-control" name="jenis" id="jenis" required>
                                <option selected disabled>Pilih</option>
                                <option value="full time">Full Time</option>
                                <option value="part time">Part Time</option>
                                <option value="magang">Magang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Deadline</label>
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea class="form-control descJob" name="desc" id="descJob" cols="30" rows="10" placeholder="deskripsi tentang lowongan"></textarea>
                        </div>
                        
                </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        @if(count($jobs) != 0)
        <table id="tableJob" class="table table-hover mg-b-0">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama / Posisi</th>
                <th>Jenis</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @include('tanggal_indo')
                @foreach($jobs as $job)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $job->posisi }}</td>
                    <td class="text-capitalize">{{ $job->jenis }}</td>
                    <td>{{ tanggal_indonesia($job->deadline) }}</td>
                    <td>
                        <?php
                            $today = strtotime(date("Y-m-d"));
                            $deadline = strtotime($job->deadline);
                        ?>

                        @if($today > $deadline)
                            <div class="badge badge-secondary">Non Aktif</div>
                        @else
                            <div class="badge badge-success">Aktif</div>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-info" id="detailJob{{ $job->id }}" data-toggle="modal" data-target='#detail_job{{ $job->id }}' data-id="{{ $job->id }}">Edit</button>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteJob{{ $job->id }}"><i class="fas fa-trash"></i></button>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detail_job{{ $job->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">Edit Lowongan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="POST" action="{{ route('JobUpdate', ['id' => $job->id]) }}">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama / Posisi</label>
                                            <input type="text" name="posisi" class="form-control" id="nama" placeholder="Nama / posisi lowongan" value="{{ $job->posisi }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Jenis</label>
                                            <select class="form-control" name="jenis" id="jenis" required>
                                                <option disabled>Pilih</option>
                                                <option value="full time" {{ ($job->jenis == 'full time') ? 'selected' : '' }}>Full Time</option>
                                                <option value="part time" {{ ($job->jenis == 'part time') ? 'selected' : '' }}>Part Time</option>
                                                <option value="magang" {{ ($job->jenis == 'magang') ? 'selected' : '' }}>Magang</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Deadline</label>
                                            <input type="date" name="deadline" class="form-control" value="{{ $job->deadline }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Deskripsi</label>
                                            <textarea class="form-control descJob" name="desc" id="descJob" cols="30" rows="10" placeholder="deskripsi tentang lowongan">{{ $job->desc }}</textarea>
                                        </div>
                                        
                                </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                                        <!-- <div class="form-group">
                                            <label for="nama" class="col-form-label text-muted">Nama / Posisi :</label>
                                            <p id="posisi">{{ $job->posisi }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-form-label text-muted">Jenis</label>
                                            <p id="jenis" class="text-capitalize">{{ $job->jenis }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-form-label text-muted">Deadline</label>
                                            <p id="deadline">{{ tanggal_indonesia($job->deadline) }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-form-label text-muted">Deskripsi</label>
                                            <p id="desc">{{ $job->desc }}</p>
                                        </div> -->
                                    </div>
                                    <div class="modal-footer">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteJob{{ $job->id }}" tabindex="-1" aria-labelledby="deleteJob{{ $job->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteJob{{ $job->id }}Label">Hapus Lowongan ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('JobDestroy', ['id' => $job->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <p>Yakin hapus lowongan <strong>{{ $job->posisi }}</strong> ?</p>
                                            <span class="mt-3 bg-warning p-1">Semua pelamar pada lowongan ini akan ikut terhapus.</span>
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
        $('#tableJob').DataTable( {
            
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