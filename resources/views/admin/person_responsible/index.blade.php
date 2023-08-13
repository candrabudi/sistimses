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
    <div class="card">
        <div class="card-header p-3 d-flex mb-4">
            <h5 class="align-self-center m-0">List Data Penanggung Jawab</h5>

            <button class="create-new btn btn-primary btn-m ms-auto btn-toggle-sidebar" data-bs-toggle="offcanvas" data-bs-target="#add-person-responsible" aria-controls="add-person-responsible">
                <i class="ti ti-plus me-1"></i>
                <span class="align-middle">&NonBreakingSpace;Tambah Penanggung Jawab</span>
            </button>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table" id="get-person-responsible">
                <thead>
                    <tr>
                        <th width="50" align="center">NO</th>
                        <th>NAMA</th>
                        <th>NO HP</th>
                        <th>KECAMATAN</th>
                        <th>DESA</th>
                        <th>ALAMAT</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('admin.person_responsible.create')
@include('admin.person_responsible.edit')
@endsection
@section('scripts')
@include('admin.person_responsible.datatable')
@include('admin.person_responsible.select_dropdown')
@include('admin.person_responsible.store')
@include('admin.person_responsible.update')
@include('admin.person_responsible.delete')
@endsection