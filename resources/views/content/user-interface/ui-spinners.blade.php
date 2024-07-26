@extends('layouts/contentNavbarLayout')

@section('title', 'Spinners - UI elements')


@section('content')
<!-- Style -->
<div class="card mb-6">
  <h5 class="card-header pb-0">Style</h5>
  <div class="row row-bordered g-0">
    <div class="col-md p-6">
      <div class="text-light small fw-medium">Border</div>

      <div class="demo-inline-spacing">
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border text-secondary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border text-success" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border text-danger" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border text-warning" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border text-info" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border text-light" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border text-dark" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
    <div class="col-md p-6">
      <div class="text-light small fw-medium">Growing</div>

      <div class="demo-inline-spacing">
        <div class="spinner-grow" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-danger" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-warning" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-info" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-light" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-dark" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Style -->

<!-- Size -->
<div class="card mb-6">
  <h5 class="card-header pb-0">Size</h5>
  <div class="row row-bordered g-0">
    <!-- Large -->
    <div class="col-md p-6">
      <div class="text-light small fw-medium">Large</div>
      <div class="demo-inline-spacing">
        <div class="spinner-border spinner-border-lg text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border spinner-border-lg text-secondary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>

    <!-- Medium -->
    <div class="col-md p-6">
      <div class="text-light small fw-medium">Medium</div>
      <div class="demo-inline-spacing">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border text-secondary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>

    <!-- Small -->
    <div class="col-md p-6">
      <div class="text-light small fw-medium">Small</div>
      <div class="demo-inline-spacing">
        <div class="spinner-border spinner-border-sm text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-border spinner-border-sm text-secondary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Size -->

@endsection
