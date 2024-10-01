@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')

    <!-- Striped Rows -->
    <div class="card">
        <h5 class="card-header">Tabel Data Pengamatan</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Pengamatan</th>
                        <th>Nama</th>
                        <th>Users</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td><span>Chopper</span></td>
                        <td>Alem Ardemi</td>
                        <td>
                            <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Sudarsono">
                                    <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Jumiatun">
                                    <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Edi Purwanto">
                                    <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        <td><span class="badge bg-label-primary me-1">In Progress</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Agregat Tanah</span></td>
                        <td>Barera Putra</td>
                        <td>
                            <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Sudarsono">
                                    <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Jumiatun">
                                    <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Edi Purwanto">
                                    <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        <td><span class="badge bg-label-success me-1">Cross Check</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Foliar</span></td>
                        <td>Tamara Dhia</td>
                        <td>
                            <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Sudarsono">
                                    <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Jumiatun">
                                    <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Edi Purwanto">
                                    <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        <td><span class="badge bg-label-info me-1">Reworking</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>Panen</span></td>
                        <td>Sumantow</td>
                        <td>
                            <ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Sudarsono">
                                    <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Jumiatun">
                                    <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="Edi Purwanto">
                                    <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar"
                                        class="rounded-circle">
                                </li>
                            </ul>
                        </td>
                        <td><span class="badge bg-label-warning me-1">Gagal</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Striped Rows -->

    <hr class="my-12">

@endsection
