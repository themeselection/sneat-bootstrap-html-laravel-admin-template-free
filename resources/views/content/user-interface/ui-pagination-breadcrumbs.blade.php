@extends('layouts/contentNavbarLayout')

@section('title', 'Pagination and breadcrumbs - UI elements')

@section('content')
<div class="row gy-6">
    <div class="col-lg-12">
        <div class="card">
            <h5 class="card-header">Pagination</h5>
            <!-- Basic Pagination -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <small class="fw-medium">Basic</small>
                        <div class="demo-inline-spacing">
                            <!-- Basic Pagination -->
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item first">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-left icon-sm"></i></a>
                                    </li>
                                    <li class="page-item prev">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevron-left icon-sm"></i></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">2</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="javascript:void(0);">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">5</a>
                                    </li>
                                    <li class="page-item next">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevron-right icon-sm"></i></a>
                                    </li>
                                    <li class="page-item last">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-right icon-sm"></i></a>
                                    </li>
                                </ul>
                            </nav>
                            <!--/ Basic Pagination -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pagination Sizes -->
    <div class="col-lg-12">
        <div class="card">
            <h5 class="card-header">Sizes & Alignments</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <small class="fw-medium">Sizes</small>
                        <div class="demo-inline-spacing">
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm">
                                    <li class="page-item prev">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-left icon-xs"></i></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">2</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="javascript:void(0);">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">5</a>
                                    </li>
                                    <li class="page-item next">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-right icon-xs"></i></a>
                                    </li>
                                </ul>
                            </nav>
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item prev">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-left icon-sm"></i></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">2</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="javascript:void(0);">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">5</a>
                                    </li>
                                    <li class="page-item next">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-right icon-sm"></i></a>
                                    </li>
                                </ul>
                            </nav>
                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-lg">
                                    <li class="page-item prev">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-left icon-md"></i></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">2</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="javascript:void(0);">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">5</a>
                                    </li>
                                    <li class="page-item next">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-right icon-md"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <small class="fw-medium">Alignments</small>
                        <div class="demo-inline-spacing">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item prev">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-left icon-sm"></i></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">2</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="javascript:void(0);">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">5</a>
                                    </li>
                                    <li class="page-item next">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-right icon-sm"></i></a>
                                    </li>
                                </ul>
                            </nav>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item prev">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-left icon-sm"></i></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">2</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="javascript:void(0);">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">5</a>
                                    </li>
                                    <li class="page-item next">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-right icon-sm"></i></a>
                                    </li>
                                </ul>
                            </nav>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item prev">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-left icon-sm"></i></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">2</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="javascript:void(0);">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">5</a>
                                    </li>
                                    <li class="page-item next">
                                        <a class="page-link" href="javascript:void(0);"><i class="icon-base bx bx-chevrons-right icon-sm"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Pagination Sizes -->

    <!-- Breadcrumb -->
    <div class="col-lg-12">
        <div class="card">
            <h5 class="card-header">Breadcrumbs</h5>
            <div class="card-body">
                <!-- Basic Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Library</a>
                        </li>
                        <li class="breadcrumb-item active">Data</li>
                    </ol>
                </nav>
                <!-- Basic Breadcrumb -->
                <!-- Custom style1 Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom-icon">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Home</a>
                            <i class="breadcrumb-icon icon-base bx bx-chevron-right align-middle"></i>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Library</a>
                            <i class="breadcrumb-icon icon-base bx bx-chevron-right align-middle"></i>
                        </li>
                        <li class="breadcrumb-item active">Data</li>
                    </ol>
                </nav>
                <!--/ Custom style1 Breadcrumb -->
                <!-- Custom style2 Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-custom-icon mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Home</a>
                            <i class="breadcrumb-icon icon-base bx bx-right-arrow-circle align-middle"></i>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Library</a>
                            <i class="breadcrumb-icon icon-base bx bx-right-arrow-circle align-middle"></i>
                        </li>
                        <li class="breadcrumb-item active">Data</li>
                    </ol>
                </nav>
                <!--/ Custom style2 Breadcrumb -->
            </div>
        </div>
    </div>
    <!--/ Breadcrumb -->
</div>
@endsection