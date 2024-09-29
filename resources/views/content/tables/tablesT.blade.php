@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Data Pengamatan</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Lokasi</th>
                            <th>sat</th>
                        </tr>
                        @foreach($data_chopper as $item)
                        <tr>
                            <td>{{ $item['Lokasi'] }}</td>
                            <td>{{ $item['Sat'] }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
