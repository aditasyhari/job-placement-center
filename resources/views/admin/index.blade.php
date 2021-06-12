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

    .text-blue {
        color: #007bff !important;
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
              <p class="az-dashboard-text">Dashboard untuk admin.</p>
            </div>
            <div class="az-content-header-right">
              <div class="media">
                <div class="media-body">
                  <label>Hari ini</label>
                  <h6>{{ tanggal_indonesia(date('Y-m-d')) }}</h6>
                </div><!-- media-body -->
              </div><!-- media -->

            </div>
          </div><!-- az-dashboard-one-title -->

          <hr>

          @if($all > 0 && $jobs->count() > 0)

          <div class="row row-sm mg-b-20">
            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
              <div class="card card-dashboard-four">
                <div class="card-header">
                  <h6 class="card-title">Lowongan Kerja ({{ $jobs->count() }})</h6>
                </div><!-- card-header -->
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="chart"><canvas id="chartDonut"></canvas></div>
                  </div>
                  <div class="az-traffic-detail-item mt-3">
                      <div>
                        <span class="text-blue">Full Time</span>
                        <span>{{ $jobs->where('jenis', 'full time')->count() }} <span>({{ round($jobs->where('jenis', 'full time')->count() / $jobs->count() * 100) }}%)</span></span>
                      </div>

                    </div>
                    <div class="az-traffic-detail-item">
                      <div>
                        <span class="text-info">Part Time</span>
                        <span>{{ $jobs->where('jenis', 'part time')->count() }} <span>({{ round($jobs->where('jenis', 'part time')->count() / $jobs->count() * 100) }}%)</span></span>
                      </div>

                    </div>
                    <div class="az-traffic-detail-item">
                      <div>
                        <span class="text-primary">Magang</span>
                        <span>{{ $jobs->where('jenis', 'magang')->count() }} <span>({{ round($jobs->where('jenis', 'magang')->count() / $jobs->count() * 100) }}%)</span></span>
                      </div>

                    </div>
                </div><!-- card-body -->
              </div><!-- card-dashboard-four -->
            </div><!-- col -->

            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
              <div class="card card-dashboard-four">
                <div class="card-header">
                  <h6 class="card-title">Pelamar ({{ $all }})</h6>
                </div><!-- card-header -->
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="chart"><canvas id="chartDonut2"></canvas></div>
                  </div>
                  <div class="az-traffic-detail-item mt-3">
                      <div>
                        <span class="text-success">Pelamar Diterima</span>
                        <span>{{ $diterima }} <span>({{ round($diterima / $all * 100) }}%)</span></span>
                      </div>

                    </div>
                    <div class="az-traffic-detail-item">
                      <div>
                        <span class="text-danger">Pelamar Ditolak</span>
                        <span>{{ $ditolak }} <span>({{ round($ditolak / $all * 100) }}%)</span></span>
                      </div>

                    </div>
                    <div class="az-traffic-detail-item">
                      <div>
                        <span>Pelamar Pending</span>
                        <span>{{ $pending }} <span>({{ round($pending / $all * 100) }}%)</span></span>
                      </div>

                    </div>
                </div><!-- card-body -->
              </div><!-- card-dashboard-four -->
            </div><!-- col -->

            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
              <div class="row row-sm">
                <div class="col-sm-6">
                  <div class="card card-dashboard-two">
                    <div class="card-header">
                      <h6>{{ $users->where('role', 2)->count() }}</h6>
                      <p>Total User (Alumni)</p>
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="chart-wrapper">
                        <div id="flotChart1" class="flot-chart"></div>
                      </div><!-- chart-wrapper -->
                    </div><!-- card-body -->
                  </div><!-- card -->
                </div><!-- col -->
                <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                  <div class="card card-dashboard-two">
                    <div class="card-header">
                      <h6>{{ $users->where('role', 3)->count() }}</h6>
                      <p>Total Perusahaan</p>
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="chart-wrapper">
                        <div id="flotChart2" class="flot-chart"></div>
                      </div><!-- chart-wrapper -->
                    </div><!-- card-body -->
                  </div><!-- card -->
                </div><!-- col -->
                <div class="col-sm-12 mg-t-20">
                  <div class="card card-dashboard-three">
                    <div class="card-header">
                      <p>Semua Pengguna</p>
                      <h6>{{ $users->count() }}</h6>
                      <small>Total semua pengguna (pelamar dan perusahaan) website Job Placement Center.</small>
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="chart"><canvas id="chartBar5"></canvas></div>
                    </div>
                  </div>
                </div>
              </div><!-- row -->
            </div><!--col -->
          </div><!-- row -->

          @else
            <img src="{{ asset('img/kosong.png') }}" class="d-block mx-auto"
                style="
                    max-width: 50%;
                "
            >
          @endif
        </div><!-- az-content-body -->
      </div>
    </div><!-- az-content -->
@endsection

@section('js')

<script>
      $(function(){
        'use strict'

        $.plot('#flotChart1', [{
          data: dashData2,
          color: '#00cccc'
        }], {
            series: {
                shadowSize: 0,
                lines: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: { colors: [ { opacity: 0.2 }, { opacity: 0.2 } ] }
                }
    		},
            grid: {
                borderWidth: 0,
                labelMargin: 0
            },
            yaxis: {
                show: false,
                min: 0,
                max: 32
            },
    		xaxis: {
                show: false,
                max: 20
            }
    	});

        $.plot('#flotChart2', [{
          data: dashData2,
          color: '#007bff'
        }], {
    		series: {
                shadowSize: 0,
                bars: {
                    show: true,
                    lineWidth: 0,
                    fill: 1,
                    barWidth: .5
                }
    		},
            grid: {
                borderWidth: 0,
                labelMargin: 0
            },
    		yaxis: {
                show: false,
                min: 0,
                max: 35
            },
    		xaxis: {
                show: false,
                max: 20
            }
    	});


        var ctx5 = document.getElementById('chartBar5').getContext('2d');
        new Chart(ctx5, {
          type: 'bar',
          data: {
            labels: [0,1,2,3,4,5,6,7],
            datasets: [{
              data: [2, 4, 10, 20, 45, 40, 35, 18],
              backgroundColor: '#560bd0'
            }, {
              data: [3, 6, 15, 35, 50, 45, 35, 25],
              backgroundColor: '#cad0e8'
            }]
          },
          options: {
            maintainAspectRatio: false,
            tooltips: {
              enabled: false
            },
            legend: {
              display: false,
                labels: {
                  display: false
                }
            },
            scales: {
              yAxes: [{
                display: false,
                ticks: {
                  beginAtZero:true,
                  fontSize: 11,
                  max: 80
                }
              }],
              xAxes: [{
                barPercentage: 0.6,
                gridLines: {
                  color: 'rgba(0,0,0,0.08)'
                },
                ticks: {
                  beginAtZero:true,
                  fontSize: 11,
                  display: false
                }
              }]
            }
          }
        });


        // Donut Chart
        var datapie2 = {
          labels: ['Diterima', 'Ditolak', 'Pending'],
          datasets: [{
            data: [{{ $diterima }}, {{ $ditolak }}, {{ $pending }}],
            backgroundColor: ['#0ea702', '#B5162d', '#adb2bd']
          }]
        };

        var datapie = {
          labels: ['Full Time', 'Part Time', 'Magang'],
          datasets: [{
            data: [{{ $jobs->where('jenis', 'full time')->count() }}, {{ $jobs->where('jenis', 'part time')->count() }}, {{ $jobs->where('jenis', 'magang')->count() }}],
            backgroundColor: ['#007bff', '#17a2b8', '#6f42c1']
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

        var ctxpie= document.getElementById('chartDonut2');
        var myPieChart6 = new Chart(ctxpie, {
          type: 'doughnut',
          data: datapie2,
          options: optionpie
        });

      });
    </script>

    <script>
        function printContent(el){
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>

@endsection
