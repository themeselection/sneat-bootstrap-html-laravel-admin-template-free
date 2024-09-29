@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')

{{-- <td>
  <div class="dropdown">
    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
      <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
    </div>
  </div>
</td> --}}

<!-- Striped Rows -->
<div class="card">
  <h5 class="card-header">Tabel Data Pengamatan</h5>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Plant Group</th>
          <th>Tanggal Pengamatan</th>
          <th>Lokasi</th>
          <th>Luas Aktif</th>
          <th>Sat</th>
          <th>Exs Tanaman</th>
          <th>Tanaman Hancur</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach ($choppers as $chopper)
          <tr>
            <td>{{$chopper->PlantGroup}}</td>
            <td>{{$chopper->TanggalPengamatan}}</td>
            <td>{{$chopper->Lokasi}}</td>
            <td>{{$chopper->LuasAktif}}</td>
            <td>{{$chopper->Sat}}</td>
            <td>{{$chopper->ExsTanaman}}</td>
            <td>{{$chopper['% Tanaman Hancur']}}</td>

            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                </div>
              </div>
            </td>
          </tr>
        @endforeach



      </tbody>
    </table>
  </div>
</div>
<!--/ Striped Rows -->

<hr class="my-12">

@endsection
