@extends('layouts.app')

@section('title')Dashboard | JPC @endsection

@section('css')
<style>
    .bg-green {
        background-color: #0ea702;
    }

    .bg-red {
        background-color: #B5162d;
    }
</style>
@endsection

@section('content')

@include('tanggal_indo')
<div class="az-content az-content-dashboard">
      <div class="container">
        <div class="az-content-body">
          <div class="az-dashboard-one-title">
            <div>
              <h2 class="az-dashboard-title">Hi, selamat datang {{Auth()->user()->name}} !</h2>
              <p class="az-dashboard-text">Dashboard untuk user (alumni).</p>
            </div>
            <div class="az-content-header-right">
              <div class="media">
                <div class="media-body">
                  <label>Hari ini</label>
                  <h6>{{ tanggal_indonesia(date('Y-m-d')) }}</h6>
                </div><!-- media-body -->
              </div><!-- media -->

              <a href="{{route('U-profile')}}" class="btn btn-purple">Profile</a>
            </div>
          </div><!-- az-dashboard-one-title -->

          <!-- <div class="az-dashboard-nav"> 
            <nav class="nav">
              <a class="nav-link active" data-toggle="tab" href="#">Overview</a>
              <a class="nav-link" data-toggle="tab" href="#">Audiences</a>
              <a class="nav-link" data-toggle="tab" href="#">Demographics</a>
              <a class="nav-link" data-toggle="tab" href="#">More</a>
            </nav>

            <nav class="nav">
              <a class="nav-link" href="#"><i class="far fa-save"></i> Save Report</a>
              <a class="nav-link" href="#"><i class="far fa-file-pdf"></i> Export to PDF</a>
              <a class="nav-link" href="#"><i class="far fa-envelope"></i>Send to Email</a>
              <a class="nav-link" href="#"><i class="fas fa-ellipsis-h"></i></a>
            </nav>
          </div> -->
          <hr>

          @if($all > 0)
          <div class="row row-sm mg-b-20">

            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
              <div class="card card-dashboard-four">
                <div class="card-header">
                  <h6 class="card-title">Apply Lowongan</h6>
                </div><!-- card-header -->
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="chart"><canvas id="chartDonut"></canvas></div>
                  </div>
                  <div class="az-traffic-detail-item mt-3">
                      <div>
                        <span class="text-success">Diterima</span>
                        <span>{{ $diterima }} <span>({{ round($diterima / $all * 100) }}%)</span></span>
                      </div>

                    </div>
                    <div class="az-traffic-detail-item">
                      <div>
                        <span class="text-danger">Ditolak</span>
                        <span>{{ $ditolak }} <span>({{ round($ditolak / $all * 100) }}%)</span></span>
                      </div>

                    </div>
                    <div class="az-traffic-detail-item">
                      <div>
                        <span>Pending</span>
                        <span>{{ $pending }} <span>({{ round($pending / $all * 100) }}%)</span></span>
                      </div>

                    </div>
                </div><!-- card-body -->
              </div><!-- card-dashboard-four -->
            </div><!-- col -->

            <div class="col-lg-7 col-xl-8 mg-t-20 mg-lg-t-0">
              <div class="card card-table-one">
                <h6 class="card-title">Riwayat apply lowongan terakhir</h6>
                <p class="az-content-text mg-b-20">berikut ini riwayat anda apply lowongan pada JPC.</p>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="wd-5p">&nbsp;</th>
                        <th class="wd-45p">Perusahaan</th>
                        <th>Posisi</th>
                        <th>Deadline</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($apps as $app)
                        <?php 
                          $j = \App\Job::find($app->id_job);
                          $c = \App\InfoCompany::firstWhere('id_user', $app->id_company);
                        ?>
                        <tr>
                          <td>
                            <img src="{{ asset('img/profile/'.$c->profile) }}" alt=""
                              style="
                                      max-width: 25px;
                                      max-height: 25px;
                                    "
                            >
                          </td>
                          <td><strong>{{ $c->nama }}</strong></td>
                          <td><strong>{{ $j->posisi }}</strong></td>
                          <td>{{ tanggal_indonesia($j->deadline) }}</td>
                          <td class="text-capitalize">{{ $app->status }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card -->
            </div><!-- col-lg -->
          </div><!-- row -->
          @else
            <img src="{{ asset('img/kosong.png') }}" class="d-block mx-auto"
                style="
                    max-width: 50%;
                "
            >
          @endif

          <div class="row row-sm mg-b-20 mg-lg-b-0">


          </div><!-- row -->
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
@endsection

@section('js')

<script>
      $(function(){
        'use strict'

        // Donut Chart
        var datapie = {
          labels: ['Diterima', 'Ditolak', 'Pending'],
          datasets: [{
            data: [{{ $diterima }}, {{ $ditolak }}, {{ $pending }}],
            backgroundColor: ['#0ea702', '#B5162d', '#adb2bd']
          }]
        };

        var optionpie = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
            display: false,
          },
          animation: {
            animateScale: true,
            animateRotate: true
          }
        };

        // For a doughnut chart
        var ctxpie= document.getElementById('chartDonut');
        var myPieChart6 = new Chart(ctxpie, {
          type: 'doughnut',
          data: datapie,
          options: optionpie
        });

      });
    </script>

@endsection
