@extends('layouts.app')
@section('title')
List Data
@endsection
<style>
    .container-xxxl {
        width: 90%;
        margin: auto;
    }

    #get-population th {
        font-size: 14px;
        text-align: center;
    }

    #get-population td {
        font-size: 14px;
    }
</style>
@section('content')
<div class="container-xxxl flex-grow-1 container-p-y">
    <div class="row gy-3">
        <div class="col-xl-2 mb-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div style="width: 100%; margin: auto;">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap gap-3 me-5">
                        <div class="d-flex align-items-center gap-3 me-4 me-sm-0">
                            <span class="bg-label-info p-2 rounded">
                                <i class='ti ti-man ti-xl'></i>
                            </span>
                            <div class="content-right">
                                <p class="mb-0">Laki-Laki</p>
                                <h4 class="text-primary mb-0">{{$chart_data[0]['man']}}</h4>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="bg-label-danger p-2 rounded">
                                <i class='ti ti-woman ti-xl'></i>
                            </span>
                            <div class="content-right">
                                <p class="mb-0">Perempuan</p>
                                <h4 class="text-info mb-0">{{$chart_data[0]['woman']}}</h4>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <span class="bg-label-danger p-2 rounded">
                                <i class='ti ti-file ti-xl'></i>
                            </span>
                            <div class="content-right">
                                <p class="mb-0">Total Inputan</p>
                                <h4 class="text-info mb-0">{{$chart_data[0]['man'] + $chart_data[0]['woman']}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header p-3 d-flex mb-4">
            <h5 class="align-self-center m-0">List Data Penduduk</h5>

            <button class="create-new btn btn-primary btn-m ms-auto btn-toggle-sidebar" data-bs-toggle="offcanvas" data-bs-target="#add-resident-name"" aria-controls=" add-resident-name">
                <i class="ti ti-plus me-1"></i>
                <span class="align-middle">&NonBreakingSpace;Tambah Penduduk</span>
            </button>
            <a href="{{route('exportToExcel')}}" class="btn btn-success btn-m ms-2" download><i class="ti ti-download" style="font-size: 16px;"></i>&NonBreakingSpace;Export</a>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table" id="get-population">
                <thead>
                    <tr>
                        <th width="50" align="center">NO</th>
                        <th>NIK</th>
                        <th>NAMA</th>
                        <th>JENIS KELAMIN</th>
                        <th>NO HP</th>
                        <th>DESA</th>
                        <th>KECAMATAN</th>
                        <th>ALAMAT</th>
                        <th>PENANGGUNG JAWAB</th>
                        <th>KETERANGAN</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('admin.add_population')
@include('admin.edit_population')
@include('admin.detail_population')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var maleCount = {{$chart_data[0]['man']}};
    var femaleCount = {{$chart_data[0]['woman']}};

    var ctx = document.getElementById('genderChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [maleCount, femaleCount],
                backgroundColor: ['#3498db', '#ff7979'], // Set colors for Male and Female segments
            }]
        }
    });
</script>
@include('admin.datatable')
@include('admin.select_dropdown')
@include('admin.store_population')
@include('admin.update_population')
@include('admin.delete_population')
@include('admin.detail_js')
@endsection