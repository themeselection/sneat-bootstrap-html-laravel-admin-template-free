@extends('layouts/contentNavbarLayout')

@section('title', 'Tooltips and popovers - UI elements')

<!-- Page Script -->
@section('page-script')
@vite(['resources/assets/js/ui-popover.js'])
@endsection

@section('content')
<div class="row gy-6">
    <!-- Tooltips -->
    <div class="col-lg-12">
        <div class="card">
            <h5 class="card-header">Tooltips</h5>
            <div class="card-body">
                <div class="small fw-medium">Directions</div>
                <div class="row demo-vertical-spacing">
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,6" data-bs-placement="right" data-bs-html="true" title="<i class='icon-base bx bx-trending-up icon-xs' ></i> <span>Tooltip on right</span>">Right</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,6" data-bs-placement="top" data-bs-html="true" title="<i class='icon-base bx bx-bell icon-xs' ></i> <span>Tooltip on top</span>">Top</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,6" data-bs-placement="bottom" data-bs-html="true" title="<i class='icon-base bx bx-heart icon-xs' ></i> <span>Tooltip on bottom</span>">Bottom</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,6" data-bs-placement="left" data-bs-html="true" title="<i class='icon-base bx bx-dollar icon-xs' ></i> <span>Tooltip on left</span>">Left</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Tooltips -->

    <!-- Popovers -->
    <div class="col-lg-12">
        <div class="card">
            <h5 class="card-header">Popovers</h5>
            <div class="card-body">
                <div class="small fw-medium">Directions</div>
                <div class="row demo-vertical-spacing">
                    <div class="col">
                        <button type="button" class="btn btn-primary text-nowrap" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="right" data-bs-html="true" data-bs-content="<p>This is a very beautiful popover, show some love.</p> <div class='d-flex justify-content-between'><button type='button' class='btn btn-sm btn-label-secondary'>Skip</button><button type='button' class='btn btn-sm btn-primary'>Read More</button></div>" title="Popover Title">Popover on right</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary text-nowrap" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="top" data-bs-html="true" data-bs-content="<p>This is a very beautiful popover, show some love.</p> <div class='d-flex justify-content-between'><button type='button' class='btn btn-sm btn-label-secondary'>Skip</button><button type='button' class='btn btn-sm btn-primary'>Read More</button></div>" title="Popover Title">Popover on top</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary text-nowrap" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="bottom" data-bs-html="true" data-bs-content="<p>This is a very beautiful popover, show some love.</p> <div class='d-flex justify-content-between'><button type='button' class='btn btn-sm btn-label-secondary'>Skip</button><button type='button' class='btn btn-sm btn-primary'>Read More</button></div>" title="Popover Title">Popover on bottom</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary text-nowrap" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="left" data-bs-html="true" data-bs-content="<p>This is a very beautiful popover, show some love.</p> <div class='d-flex justify-content-between'><button type='button' class='btn btn-sm btn-label-secondary'>Skip</button><button type='button' class='btn btn-sm btn-primary'>Read More</button></div>" title="Popover Title">Popover on left</button>
                    </div>
                </div>
            </div>
            <hr class="m-0" />
            <div class="card-body">
                <div class="small fw-medium">Custom popover</div>

                <div class="demo-inline-spacing">
                    <button type="button" class="btn btn-primary" data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="right" data-bs-custom-class="custom-popover" data-bs-content="This is a very beautiful popover, show some love." title="Popover Title">custom-popover</button>
                </div>
            </div>
        </div>
    </div>
    <!--/ Popovers -->
</div>
@endsection
