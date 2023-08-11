@extends('layouts.app')
@section('title')
List Data
@endsection
@section('content')
<div class="card">
    <div class="card-header p-3 d-flex mb-4">
        <h5 class="align-self-center m-0">List Data Penduduk</h5>
        
        <button class="create-new btn btn-primary btn-m ms-auto btn-toggle-sidebar" data-bs-toggle="offcanvas" data-bs-target="#add-resident-name"" aria-controls="add-resident-name">
            <i class="ti ti-plus me-1"></i>
            <span class="align-middle">&NonBreakingSpace;Tambah Penduduk</span>
        </button>
        <a href="{{route('exportToExcel')}}" class="btn btn-success btn-m ms-2" download><i class="ti ti-download" style="font-size: 16px;"></i>&NonBreakingSpace;Export</a>
    </div>
    <div class="card-datatable table-responsive pt-0">
        <table class="datatables-basic table" id="get-population">
            <thead>
                <tr>
                    <th width="50">NO</th>
                    <th>NIK</th>
                    <th>NAMA</th>
                    <th>NO HP</th>
                    <th>DESA</th>
                    <th>KECAMATAN</th>
                    <th width="250">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@include('admin.add_population')
@include('admin.edit_population')
@include('admin.detail_population')
@endsection
@section('scripts')
@include('admin.datatable')
@include('admin.select_dropdown')
@include('admin.store_population')
@include('admin.update_population')
@include('admin.delete_population')
@include('admin.detail_js')
@endsection