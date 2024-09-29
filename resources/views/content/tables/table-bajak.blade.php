@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')

<!-- Striped Rows -->
<div class="card">
  <h5 class="card-header">Tabel Data Pengamatan</h5>

  <div class="">
    <div class="btn-group">
      <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Filter</button>
      <ul class="dropdown-menu">
        <li>
          <a class="dropdown-item" href={{route('tables-bajak')}}>Semua</a>
        </li>
        @foreach ($plantGroups as $item)
          <li>
            <a class="dropdown-item" href={{route('tables-bajak') . '?plantGroup=' . $item->PlantGroup}}>{{$item->PlantGroup}}</a>
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
          <th>Exs Tanaman</th>
          <th>Kedalaman</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">

        @foreach($bajaks as $item)
          <tr>
            <td>{{$item->PlantGroup}}</td>
            <td>{{$item->TGL_Pengamatan}}</td>
            <td>{{$item->Lokasi}}</td>
            <td>{{$item->Luas}}</td>
            <td>{{$item->Sat}}</td>
            <td>{{$item->Exs_Tanaman}}</td>
            <td>{{$item['Kedalaman%MasukSTD']}}</td>
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
