@extends('layouts.app')

@section('title')Apply Loker | JPC @endsection

@section('css')
@endsection

@section('content')
<div class="az-content-label mg-b-5">List Apply Lowongan</div>
    <p class="mg-b-20">daftar semua apply lowongan kerja pada aplikasi JPC.</p>

    <div class="table-responsive">
        @if(count($apply) != 0)
        <table id="tableJob" class="table table-hover mg-b-0">
            <thead>
            <tr>
                <th>No</th>
                <th>Profile</th>
                <th>Pelamar</th>
                <th>Perusahaan</th>
                <th>Loker</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @include('tanggal_indo')
                @foreach($apply as $a)
                <?php
                    $u = \App\InfoUser::firstWhere('id_user', $a->id_pelamar);
                    $c = \App\InfoCompany::firstWhere('id_user', $a->id_company);
                    $j = \App\Job::find($a->id_job);
                ?>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <th>
                        <img src="{{ asset('img/profile/'.$u->profile) }}" alt=""
                            style="max-width: 50px;"
                        >
                    </th>
                    <th>{{ $u->nama }}</th>
                    <td>{{ $c->nama }}</td>
                    <td>{{ $j->posisi }}</td>
                    <td>
                        <?php
                            $today = strtotime(date("Y-m-d"));
                            $deadline = strtotime($j->deadline);
                        ?>

                        @if($today > $deadline)
                            {{ tanggal_indonesia($j->deadline) }} <div class="badge badge-danger">Tutup</div>
                        @else
                            {{ tanggal_indonesia($j->deadline) }} <div class="badge badge-success">Aktif</div>
                        @endif
                    </td>
                    <td class="text-capitalize">{{ $a->status }}</td>
                    <td>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteJob{{ $a->id }}"><i class="fas fa-trash"></i></button>

                        <!-- Modal Delete -->
                        <div class="modal fade" id="deleteJob{{ $a->id }}" tabindex="-1" aria-labelledby="deleteJob{{ $a->id }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteJob{{ $a->id }}Label">Hapus Lowongan ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('applications.destroy', ['application' => $a->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <p>Yakin hapus apply <strong>{{ $u->nama }}</strong> pada <strong>{{ $c->nama }} - {{ $j->posisi }}</strong> ?</p>
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