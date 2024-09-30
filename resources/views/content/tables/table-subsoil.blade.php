@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')

<!-- Striped Rows -->
<div class="card">
  <h5 class="card-header">Tabel Data Pengamatan Subsoil</h5>

  <div class="">
    <div class="btn-group">
      <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
      <ul class="dropdown-menu">
        <li>
          <a class="dropdown-item" href={{route('tables-subsoil')}}>Semua</a>
        </li>
        @foreach ($plantGroups as $item)
          <li>
            <a class="dropdown-item" href={{route('tables-subsoil') . '?plantGroup=' . $item->PlantGroup}}>{{$item->PlantGroup}}</a>
          </li>
        @endforeach

      </ul>
  </div>

  <div class="table-responsive text-nowrap">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Plant Group</th>
          <th>Tanggal Pengamatan</th>
          <th>Lokasi</th>
          <th>Luas</th>
          <th>Sat</th>
          <th>Kedalaman % Masuk Std</th>
          <th>Min Kedalaman (Cm)</th>
          <th>Max Kedalaman (Cm)</th>
          <th>Rata-rata Kedalaman (Cm)</th>
          <th>Kerataan Aplikasi % Masuk Std</th>
          <th>Min Kerataan Aplikasi (Cm) (Jarak Antar Leg)</th>
          <th>Max Kerataan Aplikasi (Cm) (Jarak Antar Leg)</th>
          <th>Rata-rata Kerataan Aplikasi (Cm) (Jarak Antar Leg)</th>
          <th>Total (%)</th>
          <th>Komoditi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach($subsoils as $item)
          <tr>
            <td>{{$item->PlantGroup}}</td>
            <td>{{$item->TanggalPengamatan}}</td>
            <td>{{$item->Lokasi}}</td>
            <td>{{$item->LuasAktif}}</td>
            <td>{{$item->Sat}}</td>
            <td>{{$item['Kedalaman % Masuk Std']}}</td>
            <td>{{$item['Min Kedalaman (Cm)']}}</td>
            <td>{{$item['Max Kedalaman (Cm)']}}</td>
            <td>{{$item['Rata-rata Kedalaman (Cm)']}}</td>
            <td>{{$item['Kerataan Aplikasi % Masuk Std']}}</td>
            <td>{{$item['Min Kerataan Aplikasi (Cm) (Jarak Antar Leg)']}}</td>
            <td>{{$item['Max Kerataan Aplikasi (Cm) (Jarak Antar Leg)']}}</td>
            <td>{{$item['Rata-rata Kerataan Aplikasi (Cm) (Jarak Antar Leg)']}}</td>
            <td>{{$item['Total (%)']}}</td>
            <td>{{$item->Commodity}}</td>
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
