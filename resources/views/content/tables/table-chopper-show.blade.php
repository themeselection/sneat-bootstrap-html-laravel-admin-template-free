@extends('layouts/contentNavbarLayout')
@section('title', 'Tables - Basic Tables')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Data Chopper</h5>
                </div>
                @if ($errors->any())
                    <div class="px-5">
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="card-body">
                    <form class="row" action="{{ route('tables-chopper.update', ['chopper' => $chopper]) }}"
                        method="POST">
                        @csrf
                        {{-- form dengan methos PUT --}}
                        @method('PUT')
                        <div class="col-6">
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-fullname">Plant Group</label>
                                <input type="text" class="form-control" name="PlantGroup"
                                    value="{{ old($chopper->PlantGroup, $chopper->PlantGroup) }}" />

                            </div>

                            <div class="mb-6">
                                <label class="form-label" for="basic-default-company">Tanggal Pengamatan</label>
                                <input type="text" class="form-control" name="TanggalPengamatan"
                                    value="{{ old($chopper->TanggalPengamatan, $chopper->TanggalPengamatan) }}" />
                            </div>

                            <div class="mb-6">
                                <label class="form-label" for="basic-default-company">Lokasi</label>
                                <input type="text" class="form-control" name="Lokasi"
                                    value="{{ old($chopper->Lokasi, $chopper->Lokasi) }}" />
                            </div>

                            <div class="mb-6">
                                <label class="form-label" for="basic-default-company">Luas Aktif</label>
                                <input type="text" class="form-control" name="LuasAktif"
                                    value="{{ old($chopper->LuasAktif, $chopper->LuasAktif) }}" />
                            </div>

                            <div class="mb-6">
                                <label class="form-label" for="basic-default-company">Sat</label>
                                <input type="text" class="form-control" name="Sat"
                                    value="{{ old($chopper->Sat, $chopper->Sat) }}" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-company">Ext Tanaman</label>
                                <input type="text" class="form-control" name="ExsTanaman"
                                    value="{{ old($chopper->ExsTanaman, $chopper->ExsTanaman) }}" />
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-company">% Tanah Hancur</label>
                                <input type="text" class="form-control" name="% Tanaman Hancur"
                                    value="{{ old($chopper['% Tanaman Hancur'], $chopper['% Tanaman Hancur']) }}" />
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-company">% Bonggol Tercacah</label>
                                <input type="text" class="form-control" name="% Bonggol Tercacah"
                                    value="{{ old($chopper['% Bonggol Tercacah'], $chopper['% Bonggol Tercacah']) }}" />
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-company">% Aplikasi Rapat</label>
                                <input type="text" class="form-control" name="% Aplikasi Rapat"
                                    value="{{ old($chopper['% Aplikasi Rapat'], $chopper['% Aplikasi Rapat']) }}" />
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-company">Total (%)</label>
                                <input type="text" class="form-control" name="Total (%)"
                                    value="{{ old($chopper['Total (%)'], $chopper['Total (%)']) }}" />
                            </div>
                        </div>

                        {{-- Button dikanan --}}
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
